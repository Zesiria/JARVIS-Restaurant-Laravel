<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;
    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function foodorder(){
        return $this->hasMany(FoodOrder::class);
    }

    public function getId(){
        return $this->id;
    }

    public function getCustomerId(){
        return $this->customer_id;
    }

    public function setCustomerId($customer_id){
        $this->customer_id = $customer_id;
    }

    public static function findOrderById($order_id){
        return Order::find($order_id);
    }

    public function getStatus(){
        return $this->status;
    }

    private function setStatus($status){
        $this->status = $status;
    }

    public function accept(){
        $this->setStatus("IN PROCESS");
    }

    public function serve(){
        $this->setStatus("COMPLETED");
    }

    public static function getOrderFromCustomer($customer_id){
        return Order::all()->where('customer_id', $customer_id);
    }

    public static function getPendingOrder(){
        return Order::all()
            ->where('created_at', '>=', now()->startOfDay())
            ->where('created_at', '<=', now()->endOfDay());
    }

    public function getCreatedDate(){
        return $this->created_at->format("Y-m-d H:s");
    }

    public static function getAllOrder(){
        return Order::all();
    }


}
