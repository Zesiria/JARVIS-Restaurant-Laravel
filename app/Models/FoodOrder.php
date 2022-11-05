<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodOrder extends Model
{
    use HasFactory;

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function food(){
        return $this->belongsTo(Food::class);
    }

    public function getId(){
        return $this->id;
    }

    public function getOrderId(){
        return $this->order_id;
    }

    public function getFoodId(){
        return $this->food_id;
    }

    public function getQuantity(){
        return $this->quantity;
    }

    public function setOrderId($order_id){
        if(!Order::findOrderById($order_id))
            throw new Exception("Order id : " . $order_id . " does not exit");
        $this->order_id = $order_id;
    }

    public function setFoodId($food_id){
        if(!Food::findFoodById($food_id))
            throw new Exception("Food id : " . $food_id . " does not exit");
        $this->food_id = $food_id;
    }

    public function setQuantity($quantity){
        if($quantity <= 0)
            throw new Exception("quantity must be positive");
        $this->quantity = $quantity;
    }

    public static function getAllFoodOrder(){
        return FoodOrder::all();
    }

}
