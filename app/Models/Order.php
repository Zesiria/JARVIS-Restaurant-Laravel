<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    /**
     * @return mixed
     */
    public function getCustomerId()
    {
        return $this->customer_id;
    }

    /**
     * @param mixed $customer_id
     */
    public function setCustomerId($customer_id): void
    {
        $this->customer_id = $customer_id;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    private function setStatus($status): void
    {
        $this->status = $status;
    }

    public function accept(){
        $this->setStatus("IN PROCESS");
    }

    public function serve(){
        $this->setStatus("COMPLETED");
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function foodorder(): HasMany
    {
        return $this->hasMany(FoodOrder::class);
    }
}
