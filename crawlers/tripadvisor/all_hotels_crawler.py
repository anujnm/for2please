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
    rating_element = heading_group.address.find_all('span', class_='star')
    if (rating_element):
      rating = sanitize(rating_element[0].img['alt'])
    else:
      rating = ''
    if (soup.find(id='HDPR_V1')):
      additional_info = soup.find(id='HDPR_V1')
      address = sanitize(soup.find(id='HDPR_V1').find('div', class_='address').address.get_text(strip=True))

    else:
      address= sanitize(heading_group.address.find_all('span', class_='format_address')[0].get_text(strip=True))

    result['name'] = name
    result['url'] = url
    result['rating'] = rating
    result['address'] = address
  except requests.exceptions.ConnectionError as e:
    pass

  # Phone
  # Email
  # Category List
  return result


def get_email_from_hotel_page(url):
  try:
    hotel_id = string.split(url, '-')[2][1:]
    email_url = 'http://www.tripadvisor.com/EmailHotel?detail=' + hotel_id
    r = requests.get(email_url)
    soup = BeautifulSoup(r.text)
    temp_element = soup.find(id='emailOwnerForm').div.find_all(attrs={"name": "overrideOfferEmail", "type": "hidden"})[0]
    return temp_element.attrs['value']

  except:
    pass
  return ''


def get_data_from_hotel_page(url):
  result = get_data_from_page(url)
  result['email_address'] = get_email_from_hotel_page(url)
  result['category'] = 'Hotel'
  return result


def sanitize(text):
  return re.sub('[^a-zA-Z0-9\.,]', ' ', text.encode('UTF-8'))


def get_urls_from_listing_page(url):
  r = requests.get(url)
  data = r.text
  result = []
  soup = BeautifulSoup(data)
  list=soup.find(id='HAC_RESULTS').find_all('div', class_='listing')
  for list_item in list:
    url = list_item.div.find('div', class_='metaLocationInfo').find('div', class_='quality').a['href'].encode('UTF-8')
    url = 'http://tripadvisor.com' + url
    result.append(url)
  return result


def get_row_for_print_to_file(row):
  return [row['name'], row['email_address'], row['url'], row['rating'], row['address'], row['category']]


def print_data_to_csv(data):
  fname='toronto_hotels_data.csv'
  with open(fname, 'wb') as outf:
    outcsv = csv.writer(outf)
    #outcsv.writerow(['Name', 'URL', 'Rating', 'Address', 'Category List'])
    for key, value in data.items():
      try:
        print value
        outcsv.writerow(get_row_for_print_to_file(hotel))
      except KeyError:
        pass


list_page_list = ['http://www.tripadvisor.in/Hotels-g181716-Richmond_British_Columbia-Hotels.html']

fname = 'Richmond/All Hotels.csv'

with open(fname, 'wb') as outf:
  outcsv = csv.writer(outf)
  outcsv.writerow(['Name', 'Email', 'URL', 'Rating', 'Address', 'Category List'])

for list_page_url in list_page_list:
  hotel_page_urls = get_urls_from_listing_page(list_page_url)
  for url in hotel_page_urls:
    hotel_data = get_data_from_hotel_page(url)
    with open(fname, 'a') as outf:
      outcsv = csv.writer(outf)
      outcsv.writerow(get_row_for_print_to_file(hotel_data))
