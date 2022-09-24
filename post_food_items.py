import requests
import json

with open('database/json/food.json', 'r', encoding="utf-8") as file:
    food_list = json.load(file)

for food in food_list:
    print(food)
    response = requests.post('http://localhost/api/food', json=food)
    print(response.status_code)
