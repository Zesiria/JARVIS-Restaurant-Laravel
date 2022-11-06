import requests
import json
import colorama
from colorama import Fore

def print_status(item, title, response):
    print(Fore.WHITE + title + str(item['id']),end=" ")
    if response.status_code == 201 or response.status_code == 200:
        print(Fore.GREEN + "success")
    else:
        print(Fore.RED + response.status_code)

def open_file(path):
    with open(path, 'r', encoding="utf-8") as file:
        items = json.load(file)
    return items

def post(items, http, title):
    title = "Post " + title + " : "
    for item in items:
        response = requests.post(http, json=item)
        print("Status : ", response.status_code)

ls_post = [
{
    "title" : "Food",
    "path" : 'database/json/create_food.json',
    "http" : 'http://localhost/api/foods'
},
{
    "title" : "Table",
    "path" : 'database/json/create_table.json',
    "http" : 'http://localhost/api/tables'
},
{
    "title" : "Review",
    "path" : 'database/json/review.json',
    "http" : 'http://localhost/api/reviews'
}
]

def put(items, http, title):
    title = "Put " + title + " : "
    newHttp = http
    for item in items:
        http = newHttp + str(item['id'])
        response = requests.put(http, json=item)
        print("Status : ", response.status_code)


ls_put = [
{
    "title" : "Table",
    "path" : 'database/json/put_table_by_check-in.json',
    "http" : 'http://localhost/api/tables/',
}
]

for item in ls_post:
    items = open_file(item['path'])
    post(items, item['http'], item['title'])



for item in ls_put:
    items = open_file(item['path'])
    put(items, item['http'], item['title'])


items = open_file('database/json/customer_order_food.json')
post(items, 'http://localhost/api/orders/', "Order")

