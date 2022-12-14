<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class Food extends Model
{
    use HasFactory;

    public function foodorder(){
        return $this->hasMany(FoodOrder::class);
    }

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getType(){
        return $this->type;
    }

    public function getQuantity(){
        return $this->quantity;
    }

    public function getImgPath(){
        return $this->img_path;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function setType($type){
        if($type != "meat" and $type != "vegetable" and $type != "appetizer")
            throw new Exception("Type of food must be (meat, vegetable, appetizer)");
        $this->type = $type;
    }

    public function setQuantity($quantity){
        if($quantity < 0)
            throw new Exception("quantity must more than or equal 0");
        $this->quantity = $quantity;
    }

    public function setImgPath($img_path){
        $this->img_path = $img_path;
    }

    public static function findFoodById($food_id){
        $food = Food::find($food_id);
        $food->img_path = url($food->img_path);
        return $food;
    }

    public static function getAllFood(){
        return Food::all();
    }

    public function addQuantityFood($amount){
        if($amount <= 0)
            throw new Exception("amount must be positive");
        $this->setQuantity($this->getQuantity() + (int)$amount);
    }

    public function reduceQuantityFood($amount){
        if($amount <= 0)
            throw new Exception("amount must be positive");
        if($amount > $this->getQuantity())
            throw new Exception("amount must be less than " . (string)$this->getQuantity());
        $this->setQuantity($this->getQuantity() - (int)$amount);
    }


}
