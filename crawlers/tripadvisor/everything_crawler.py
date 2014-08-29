from bs4 import BeautifulSoup
import requests
import re
import csv
import string
import sys

def sanitize(text):
  return re.sub('[^a-zA-Z0-9\.,]', ' ', text.encode('UTF-8')).replace(u'\xa0', u' ')


def sanitize_email(text):
  return re.sub('[^a-zA-Z0-9\.,@]', ' ', text.encode('UTF-8')).replace(u'\xa0', u' ')


def get_attractions_urls(url):
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


def get_attraction_data(url):
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
          email = sanitize_email(piece)
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

  return result

def get_attraction_row(row):
  return [row['email_address'], '', row['name'], row['url'], row['rating'], row['address'], row['category'], '']


def get_hotel_urls(url):
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


def get_hotel_data(url):
  result = {}
  try:
    r = requests.get(url)
    data = r.text

    soup = BeautifulSoup(data)

    name = sanitize(soup.find(id='HEADING').get_text(strip=True))
    heading_group = soup.find(id='HEADING_GROUP')
    if heading_group:
      rating_element = heading_group.address.find_all('span', class_='star')
      if (rating_element):
        rating = sanitize(rating_element[0].img['alt'])
      else:
        rating = ''
    else:
      rating = ''
    if (soup.find(id='HDPR_V1')):
      additional_info = soup.find(id='HDPR_V1')
      address = sanitize(soup.find(id='HDPR_V1').find('div', class_='address').address.get_text(strip=True))

    elif heading_group:
      address= sanitize(heading_group.address.find_all('span', class_='format_address')[0].get_text(strip=True))
    else:
      address = ''
    result['name'] = name
    result['url'] = url
    result['rating'] = rating
    result['address'] = address
    result['email_address'] = get_email_from_hotel_page(url)
    result['category'] = 'Hotel'
  except requests.exceptions.ConnectionError as e:
    pass

  return result


def get_email_from_hotel_page(url):
  try:
    hotel_id = string.split(url, '-')[2][1:]
    email_url = 'http://www.tripadvisor.com/EmailHotel?detail=' + hotel_id
    r = requests.get(email_url)
    soup = BeautifulSoup(r.text)
    temp_element = soup.find(id='emailOwnerForm').div.find_all(attrs={"name": "overrideOfferEmail", "type": "hidden"})[0]
    return sanitize_email(temp_element.attrs['value'])

  except:
    return ''


def get_hotel_row(row):
  return [row['email_address'], '', row['name'], row['url'], row['rating'], row['address'], row['category'], '']


def get_restaurant_urls(url):
  r = requests.get(url)
  data = r.text
  result = []
  soup = BeautifulSoup(data)
  list=soup.find(id='EATERY_SEARCH_RESULTS').find_all('div', class_='listing')
  for list_item in list:
    listing = list_item.find('div', class_='quality')
    try:
      url = listing.a['href'].encode('UTF-8')
      url = 'http://tripadvisor.com' + url
      result.append(url)
    except AttributeError:
      pass
  return result


def get_restaurant_data(url):
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
          email = sanitize_email(piece)
    try:
      cuisine_list = listing_main.find('div', class_='col2of2').find('div', 'listing_details').contents[3].get_text()
      cuisines = string.split(cuisine_list, ':')[1].encode('UTF-8')
    except IndexError:
      cuisines = ''

    result['name'] = name
    result['url'] = url
    result['rating'] = rating
    result['address'] = address
    result['email_address'] = email
    result['category'] = 'Restaurant'
    result['cuisines'] = cuisines
  except requests.exceptions.ConnectionError as e:
    pass

  return result


def get_restaurant_row(row):
  return [row['email_address'], '', row['name'], row['url'], row['rating'], row['address'], row['category'], row['cuisines']]

def get_romantic_hotel_urls(url):
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


def get_rhotel_data(url):
  result = {}
  try:
    r = requests.get(url)
    data = r.text

    soup = BeautifulSoup(data)

    name = sanitize(soup.find(id='HEADING').get_text(strip=True))
    heading_group = soup.find(id='HEADING_GROUP')
    if heading_group:
      rating_element = heading_group.address.find_all('span', class_='star')
      if (rating_element):
        rating = sanitize(rating_element[0].img['alt'])
      else:
        rating = ''
    else:
      rating = ''
    if (soup.find(id='HDPR_V1')):
      additional_info = soup.find(id='HDPR_V1')
      address = sanitize(soup.find(id='HDPR_V1').find('div', class_='address').address.get_text(strip=True))

    elif heading_group:
      address= sanitize(heading_group.address.find_all('span', class_='format_address')[0].get_text(strip=True))
    else:
      address = ''

    result['name'] = name
    result['url'] = url
    result['rating'] = rating
    result['address'] = address
    result['email_address'] = get_email_from_rhotel_page(url)
    result['category'] = 'Romantic Hotel'

  except requests.exceptions.ConnectionError as e:
    pass

  return result


def get_email_from_rhotel_page(url):
  try:
    hotel_id = string.split(url, '-')[2][1:]
    email_url = 'http://www.tripadvisor.com/EmailHotel?detail=' + hotel_id
    r = requests.get(email_url)
    soup = BeautifulSoup(r.text)
    temp_element = soup.find(id='emailOwnerForm').div.find_all(attrs={"name": "overrideOfferEmail", "type": "hidden"})[0]
    return sanitize_email(temp_element.attrs['value'])

  except:
    return ''


def get_rhotel_row(row):
  return [row['email_address'], '', row['name'], row['url'], row['rating'], row['address'], row['category'], '']


def get_rrestaurant_urls(url):
  r = requests.get(url)
  data = r.text
  result = []
  soup = BeautifulSoup(data)
  list=soup.find(id='EATERY_SEARCH_RESULTS').find_all('div', class_='listing')
  for list_item in list:
    quality_div = list_item.find('div', class_='quality')
    if quality_div:
      url = quality_div.a['href'].encode('UTF-8')
      url = 'http://tripadvisor.com' + url
      result.append(url)
  return result


def get_rrestaurant_row(row):
  return [row['email_address'], '', row['name'], row['url'], row['rating'], row['address'], row['category'], row['cuisines']]


def get_rrestaurant_data(url):
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
          email = sanitize_email(piece)
    try:
      cuisine_list = listing_main.find('div', class_='col2of2').find('div', 'listing_details').contents[3].get_text()
      cuisines = string.split(cuisine_list, ':')[1].encode('UTF-8')
    except IndexError:
      cuisines = ''

    result['name'] = name
    result['url'] = url
    result['rating'] = rating
    result['address'] = address
    result['email_address'] = email
    result['cuisines'] = cuisines
    result['category'] = 'Romantic Restaurant'
  except requests.exceptions.ConnectionError as e:
    pass

  return result


def get_bb_urls(url):
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


def get_bb_data(url):
  result = {}
  try:
    r = requests.get(url)
    data = r.text

    soup = BeautifulSoup(data)

    name = sanitize(soup.find(id='HEADING').get_text(strip=True))
    heading_group = soup.find(id='HEADING_GROUP')
    if heading_group:
      rating_element = heading_group.address.find_all('span', class_='star')
      if (rating_element):
        rating = sanitize(rating_element[0].img['alt'])
      else:
        rating = ''
    else:
      rating = ''
    if (soup.find(id='HDPR_V1')):
      additional_info = soup.find(id='HDPR_V1')
      address = sanitize(soup.find(id='HDPR_V1').find('div', class_='address').address.get_text(strip=True))

    elif heading_group:
      address = sanitize(heading_group.address.find_all('span', class_='format_address')[0].get_text(strip=True))
    else:
      address = ''
    result['name'] = name
    result['url'] = url
    result['rating'] = rating
    result['address'] = address
    result['email_address'] = get_email_from_bb_page(url)
    result['category'] = 'Bed and Breakfast'
  except requests.exceptions.ConnectionError as e:
    pass

  return result


def get_email_from_bb_page(url):
  try:
    hotel_id = string.split(url, '-')[2][1:]
    email_url = 'http://www.tripadvisor.com/EmailHotel?detail=' + hotel_id
    r = requests.get(email_url)
    soup = BeautifulSoup(r.text)
    temp_element = soup.find(id='emailOwnerForm').div.find_all(attrs={"name": "overrideOfferEmail", "type": "hidden"})[0]
    return sanitize_email(temp_element.attrs['value'])

  except:
    return ''


def get_bb_row(row):
  return [row['email_address'], '', row['name'], row['url'], row['rating'], row['address'], row['category'], '']


def create_attraction_page_url(city_name, city_code, page_number):
  base_url = 'http://www.tripadvisor.in/'
  attraction_section1 = 'Attractions'
  attraction_section2 = 'Activities'
  separator = '-'
  tail_url = '.html'
  if page_number == 0:
    return (base_url + attraction_section1 + separator + city_code + separator + attraction_section2 + separator + city_name + tail_url)
  offset = page_number * 30
  offset_string = 'oa' + str(offset)
  return (base_url + attraction_section1 + separator + city_code + separator + attraction_section2 + separator + offset_string + separator + city_name + tail_url)


def get_attraction_page_urls(city_name, city_code, number_pages):
  attraction_page_urls = []
  for page in range(number_pages):
    attraction_page_urls.append(create_attraction_page_url(city_name, city_code, page))
  return attraction_page_urls


def create_hotel_page_url(city_name, city_code, page_number):
  base_url = 'http://www.tripadvisor.in/'
  hotel_section1 = 'Hotels'
  hotel_section2 = 'Hotels'
  separator = '-'
  tail_url = '.html'
  if page_number == 0:
    return (base_url + hotel_section1 + separator + city_code + separator + city_name + separator + hotel_section2 + tail_url)
  offset = page_number * 30
  offset_string = 'oa' + str(offset)
  return (base_url + hotel_section1 + separator + city_code + separator + offset_string + separator + city_name + separator + hotel_section2 + tail_url)


def get_hotel_page_urls(city_name, city_code, number_pages):
  hotel_page_urls = []
  for page in range(number_pages):
    hotel_page_urls.append(create_hotel_page_url(city_name, city_code, page))
  return hotel_page_urls


def create_restaurant_page_url(city_name, city_code, page_number):
  base_url = 'http://www.tripadvisor.in/'
  restaurant_section1 = 'Restaurants'
  separator = '-'
  tail_url = '.html'
  if page_number == 0:
    return (base_url + restaurant_section1 + separator + city_code + separator + city_name + tail_url)
  offset = page_number * 30
  offset_string = 'oa' + str(offset)
  return (base_url + restaurant_section1 + separator + city_code + separator + offset_string + separator + city_name + tail_url)


def get_restaurant_page_urls(city_name, city_code, number_pages):
  restaurant_page_urls = []
  for page in range(number_pages):
    restaurant_page_urls.append(create_restaurant_page_url(city_name, city_code, page))
  return restaurant_page_urls


def create_rhotel_page_url(city_name, city_code, page_number):
  base_url = 'http://www.tripadvisor.in/'
  hotel_section1 = 'Hotels'
  hotel_section2 = 'Hotels'
  rhotel_section = 'zff3'
  separator = '-'
  tail_url = '.html'
  if page_number == 0:
    return (base_url + hotel_section1 + separator + city_code + separator + rhotel_section + separator + city_name + separator + hotel_section2 + tail_url)
  offset = page_number * 30
  offset_string = 'oa' + str(offset)
  return (base_url + hotel_section1 + separator + city_code + separator + rhotel_section + separator + offset_string + separator + city_name + separator + hotel_section2 + tail_url)


def get_rhotel_page_urls(city_name, city_code, number_pages):
  rhotel_page_urls = []
  for page in range(number_pages):
    rhotel_page_urls.append(create_rhotel_page_url(city_name, city_code, page))
  return rhotel_page_urls


def create_rrestaurant_page_url(city_name, city_code):
  base_url = 'http://www.tripadvisor.in/RestaurantSearch?ajax=1&geo='
  tail_url = '&Action=FILTER&allopt=3&mapProviderFeature=ta-maps-gmaps3'
  return (base_url + city_code[1:] + tail_url)


def create_bb_page_url(city_name, city_code, page_number):
  base_url = 'http://www.tripadvisor.in/'
  hotel_section1 = 'Hotels'
  hotel_section2 = 'Hotels'
  bb_section = 'c2'
  separator = '-'
  tail_url = '.html'
  if page_number == 0:
    return (base_url + hotel_section1 + separator + city_code + separator + bb_section + separator + city_name + separator + hotel_section2 + tail_url)
  offset = page_number * 30
  offset_string = 'oa' + str(offset)
  return (base_url + hotel_section1 + separator + city_code + separator + bb_section + separator + offset_string + separator + city_name + separator + hotel_section2 + tail_url)


def get_bb_page_urls(city_name, city_code, number_pages):
  bb_page_urls = []
  for page in range(number_pages):
    bb_page_urls.append(create_bb_page_url(city_name, city_code, page))
  return bb_page_urls


def create_tourism_page_url(city_name, city_code):
  base_url = 'http://www.tripadvisor.in/'
  tourism_section1 = 'Tourism'
  tourism_section2 = 'Vacactions'
  separator = '-'
  tail_url = '.html'
  return (base_url + tourism_section1 + separator + city_code + separator + city_name + separator + tourism_section2 + tail_url)

def get_number_items(city_name, city_code):
  tourism_page_url = create_tourism_page_url(city_name, city_code)
  r = requests.get(tourism_page_url)
  data = r.text
  soup = BeautifulSoup(data)
  list = soup.find(id='BODYCON').find_all('div', class_='navLinks')[0]
  hotel = list.find_all('li', class_='hotels')[0]
  number_hotels = int((hotel.find_all('span', class_='typeQty')[0]).get_text(strip=True).encode('UTF-8').replace(',', '')[1:-1])
  attractions = list.find_all('li', class_='attractions')[0]
  number_attractions = int((attractions.find_all('span', class_='typeQty')[0]).get_text(strip=True).encode('UTF-8').replace(',', '')[1:-1])
  restaurants = list.find_all('li', class_='restaurants')[0]
  number_restaurants = int((restaurants.find_all('span', class_='typeQty')[0]).get_text(strip=True).encode('UTF-8').replace(',', '')[1:-1])
  return number_hotels, number_attractions, number_restaurants


city_name = sys.argv[1]
city_code = sys.argv[2]
number_rhotel_pages = int(sys.argv[3])
number_bb_pages = int(sys.argv[4])

number_hotels, number_attractions, number_restaurants = get_number_items(city_name, city_code)

number_attraction_pages = int(number_attractions/30) if int(number_attractions/30) <=5 else 5
number_hotel_pages = int(number_hotels/30) if int(number_hotels/30) <=5 else 5
number_restaurant_pages = int(number_restaurants/30) if int(number_restaurants/30) <=5 else 5

attraction_list_pages = get_attraction_page_urls(city_name, city_code, number_attraction_pages)
hotel_list_pages = get_hotel_page_urls(city_name, city_code, number_hotel_pages)
restaurant_list_pages = get_restaurant_page_urls(city_name, city_code, number_restaurant_pages)
rhotel_list_pages = get_rhotel_page_urls(city_name, city_code, number_rhotel_pages)
bb_list_pages = get_bb_page_urls(city_name, city_code, number_bb_pages)

rrestaurant_list_pages = [create_rrestaurant_page_url(city_name, city_code)]


fname = city_name + '.csv'
with open(fname, 'wb') as outf:
  outcsv = csv.writer(outf)
  outcsv.writerow(['Email', 'Contact First Name', 'Name', 'URL', 'Rating', 'Address', 'Category', 'Cuisines'])

# Attractions
#attraction_list_pages = ['http://www.tripadvisor.in/Attractions-g39604-Activities-Louisville_Kentucky.html',
#                         'http://www.tripadvisor.in/Attractions-g39604-Activities-oa30-Louisville_Kentucky.html',
#                         'http://www.tripadvisor.in/Attractions-g39604-Activities-oa60-Louisville_Kentucky.html']

for attraction_list_page_url in attraction_list_pages:
  attraction_page_urls = get_attractions_urls(attraction_list_page_url)
  for url in attraction_page_urls:
    attraction_data = get_attraction_data(url)
    with open(fname, 'a') as outf:
      outcsv = csv.writer(outf)
      outcsv.writerow(get_attraction_row(attraction_data))

# Hotels
#hotel_list_pages = ['http://www.tripadvisor.in/Hotels-g39604-Louisville_Kentucky-Hotels.html',
#                    'http://www.tripadvisor.in/Hotels-g39604-oa30-Louisville_Kentucky-Hotels.html',
#                    'http://www.tripadvisor.in/Hotels-g39604-oa60-Louisville_Kentucky-Hotels.html',
#                    'http://www.tripadvisor.in/Hotels-g39604-oa90-Louisville_Kentucky-Hotels.html']

for hotel_list_page_url in hotel_list_pages:
  hotel_page_urls = get_hotel_urls(hotel_list_page_url)
  for url in hotel_page_urls:
    hotel_data = get_hotel_data(url)
    with open(fname, 'a') as outf:
      outcsv = csv.writer(outf)
      outcsv.writerow(get_hotel_row(hotel_data))

# Restaurants
#restaurant_list_pages = ['http://www.tripadvisor.in/Restaurants-g39604-Louisville_Kentucky.html',
#                         'http://www.tripadvisor.in/Restaurants-g39604-oa30-Louisville_Kentucky.html',
#                         'http://www.tripadvisor.in/Restaurants-g39604-oa60-Louisville_Kentucky.html',
#                         'http://www.tripadvisor.in/Restaurants-g39604-oa90-Louisville_Kentucky.html',
#                         'http://www.tripadvisor.in/Restaurants-g39604-oa120-Louisville_Kentucky.html']

for restaurant_list_page_url in restaurant_list_pages:
  restaurant_page_urls = get_restaurant_urls(restaurant_list_page_url)
  for url in restaurant_page_urls:
    restaurant_data = get_restaurant_data(url)
    with open(fname, 'a') as outf:
      outcsv = csv.writer(outf)
      outcsv.writerow(get_restaurant_row(restaurant_data))

# Romantic Hotels
for romantic_hotels_list_page_url in rhotel_list_pages:
 rhotel_page_urls = get_romantic_hotel_urls(romantic_hotels_list_page_url)
 for url in rhotel_page_urls:
   rhotel_data = get_rhotel_data(url)
   with open(fname, 'a') as outf:
     outcsv = csv.writer(outf)
     outcsv.writerow(get_rhotel_row(rhotel_data))

# Romantic Restaurants
for rrestaurant_list_page_url in rrestaurant_list_pages:
  rrestaurant_page_urls = get_rrestaurant_urls(rrestaurant_list_page_url)
  for url in rrestaurant_page_urls:
    rrestaurant_data = get_rrestaurant_data(url)
    with open(fname, 'a') as outf:
      outcsv = csv.writer(outf)
      outcsv.writerow(get_rrestaurant_row(rrestaurant_data))

# BBs
for bb_list_page_url in bb_list_pages:
  bb_page_urls = get_bb_urls(bb_list_page_url)
  for url in bb_page_urls:
    bb_data = get_bb_data(url)
    with open(fname, 'a') as outf:
      outcsv = csv.writer(outf)
      outcsv.writerow(get_bb_row(bb_data))
