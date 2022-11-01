<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function PHPUnit\Framework\throwException;

class Table extends Model
{
    use HasFactory;

    public function customer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function setCustomerId(int $customer_id){
        if(Customer::findCustomerById($customer_id))
            $this->customer_id = $customer_id;
        else
            throw new Exception("Please Generate Customer");
    }

    public function setStatus(bool $status){
        $this->status = $status;
    }

    public function setSize(int $size){
        if($size <= 0 or $size > 10)
            throw new Exception("Size must between 1 - 10");
        else
            $this->size = $size;
    }

    public function getId(){
        return $this->id;
    }

    public function getCustomerId(){
        return $this->customer_id;
    }

    public function getStatus(){
        return $this->status;
    }

    public function getSize(){
        return $this->size;
    }

    public static function findTableById(int $tableId){
        return Table::find($tableId);
    }

    public function checkOut(){
        $this->customer_id = null;
        $this->setStatus(true);
    }

    public function checkIn($customer_id){
        $this->setCustomerId($customer_id);
        $this->setStatus(true);
    }

}
