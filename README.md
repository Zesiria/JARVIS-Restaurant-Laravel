# วิธีเพิ่มข้อมูลเริ่มต้น
```angular2html
1. สร้างไฟล์ Json
2. เขียน script python เหมือนไฟล์ post_food_items.py
```
___

# วิธีรัน (post json object)
```angular2html
$ sail up -d
$ sail artisan migrate:fresh
$ python3 seed_data.py
```

---

# Adding users (temporary)
```angular2html
$ sail artisan db:seed --class=UserSeeder
```
