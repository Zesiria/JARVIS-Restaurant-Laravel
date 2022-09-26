import requests
import json

with open('database/json/food.json', 'r', encoding="utf-8") as file:
    food_list = json.load(file)

for food in food_list:
    print(food)
    response = requests.post('http://localhost/api/foods', json=food)
    print(response.status_code)

with open('database/json/customers.json', 'r', encoding="utf-8") as file:
    customer_list = json.load(file)

for customer in customer_list:
    print(customer)
    response = requests.post('http://localhost/api/customers', json=customer)
    print(response.status_code)

with open('database/json/tables.json', 'r', encoding="utf-8") as file:
    table_list = json.load(file)

for table in table_list:
    print(table)
    response = requests.post('http://localhost/api/tales', json=table)
    print(response.status_code)
