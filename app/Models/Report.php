<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    public static function calculatePrice(int $customer_id, $pricePerPerson, $beveragePrice): float|int
    {
//        $pricePerPerson = 219;

        $totalPrice = 0.0;
        $customer = Customer::find($customer_id);
        $beveragePrice = $beveragePrice * $customer->number_people;
        $totalPrice += $customer->number_people * $pricePerPerson + $beveragePrice;

        $orders = Order::all()->where('customer_id', $customer_id);
        foreach($orders as $order){
            $food_orders = FoodOrder::all()->where('order_id', $order->id);
            foreach ($food_orders as $food_order){
                $totalPrice += Food::find($food_order->food_id)->price;
            }
        }

        return $totalPrice;
    }

//    public static function getAddFood(int $customer_id){
//        $orders = Order::all()->where('customer_id', $customer_id);
//        foreach ($orders as $order){
//
//        }
//    }
}
