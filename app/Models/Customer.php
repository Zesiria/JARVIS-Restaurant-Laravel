<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public function table(){
        return $this->belongsTo(Table::class);
    }

    public function order(){
        return $this->hasMany(Order::class);
    }
}
