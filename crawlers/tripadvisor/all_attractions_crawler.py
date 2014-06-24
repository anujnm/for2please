from bs4 import BeautifulSoup
import requests
import re
import csv
import string


def get_data_from_page(url):
  result = {}
  try:
    r = requests.get(url)
    data = r.text

    soup = BeautifulSoup(data)

    name = sanitize(soup.find(id='HEADING').get_text(strip=True))
    heading_group = soup.find(id='HEADING_GROUP')
    address= sanitize(heading_group.address.find_all('span', class_='format_address')[0].get_text(strip=True))

    listing_main = soup.find(id='listing_main')
    rating_element = listing_main.find('img', class_='sprite-rating_no_fill')
    if (rating_element):
      rating = sanitize(rating_element['alt'])
    else:
      rating = ''

    email_group = heading_group.find('div', class_='grayEmail')
    email = ''
    if email_group:
      email_element = email_group.next_sibling.next_sibling
      click_attribute = email_element['onclick']
      click_split = string.split(click_attribute, ',')
      for piece in click_split:
        if '@' not in piece:
          continue
        else:
          email = piece
    try:
      category_list_div = listing_main.find('div', class_='col2of2').find('div', 'listing_details')
      if category_list_div is None:
        category = ''
      else:
        category_list = listing_main.find('div', class_='col2of2').find('div', 'listing_details').contents[1].get_text()
        category = string.split(category_list, ':')[1].encode('UTF-8')
    except IndexError:
      category = ''

    result['name'] = name
    result['url'] = url
    result['rating'] = rating
    result['address'] = address
    result['email_address'] = email
    result['category'] = category
  except requests.exceptions.ConnectionError as e:
    pass

  # Phone
  # Email
  # Category List
  return result


def get_data_from_attraction_page(url):
  result = get_data_from_page(url)
  return result


def sanitize(text):
  return re.sub('[^a-zA-Z0-9\.,]', ' ', text.encode('UTF-8'))


def get_urls_from_listing_page(url):
  r = requests.get(url)
  data = r.text
  result = []
  soup = BeautifulSoup(data)
  list=soup.find(id='ATTRACTION_OVERVIEW').find_all('div', class_='listing')
  for list_item in list:
    quality_div = list_item.find('div', class_='quality')
    if quality_div:
      url = quality_div.a['href'].encode('UTF-8')
      url = 'http://tripadvisor.com' + url
      result.append(url)
  return result


def get_row_for_print_to_file(row):
  return [row['name'], row['email_address'], row['url'], row['rating'], row['address'], row['category']]


list_page_list = ['http://www.tripadvisor.in/Attractions-g181716-Activities-Richmond_British_Columbia.html',
                  'http://www.tripadvisor.in/Attractions-g181716-Activities-oa30-Richmond_British_Columbia.html']

fname='Richmond/All Attractions.csv'
with open(fname, 'wb') as outf:
  outcsv = csv.writer(outf)
  outcsv.writerow(['Name', 'Email', 'URL', 'Rating', 'Address', 'Category'])

for list_page_url in list_page_list:
  attraction_page_urls = get_urls_from_listing_page(list_page_url)
  for url in attraction_page_urls:
    attraction_data = get_data_from_attraction_page(url)
    with open(fname, 'a') as outf:
      outcsv = csv.writer(outf)
      outcsv.writerow(get_row_for_print_to_file(attraction_data))
