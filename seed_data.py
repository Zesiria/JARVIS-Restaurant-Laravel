import requests
import json
import colorama
from colorama import Fore

def print_status(item, title, response):
    print(Fore.WHITE + title + str(item['id']),end=" ")
    if response.status_code == 201:
        print(Fore.GREEN + "success")
    else:
        print(Fore.RED + response.status_code)

def open_file(path):
    with open(path, 'r', encoding="utf-8") as file:
        items = json.load(file)
    return items

def seed(items, http, title):
    title = title + " : "
    for item in items:
        response = requests.post(http, json=item)
        print_status(item, title, response)

ls = [
{
    "title" : "Food",
    "path" : 'database/json/food.json',
    "http" : 'http://localhost/api/foods'
},
{
    "title" : "Customer",
    "path" : 'database/json/customers.json',
    "http" : 'http://localhost/api/customers'
},
{
    "title" : "Table",
    "path" : 'database/json/tables.json',
    "http" : 'http://localhost/api/tables'
},
{
    "title" : "Order",
    "path" : 'database/json/orders.json',
    "http" : 'http://localhost/api/orders'
},
{
    "title" : "Food Order",
    "path" : 'database/json/food_orders.json',
    "http" : 'http://localhost/api/food-orders'
},
{
    "title" : "Review",
    "path" : 'database/json/review.json',
    "http" : 'http://localhost/api/reviews'
}
]


for item in ls:
    items = open_file(item['path'])
    seed(items, item['http'], item['title'])

