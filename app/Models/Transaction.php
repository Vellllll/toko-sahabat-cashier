<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function items(){
        return $this->hasMany(CheckOut::class, 'transaction_number', 'transaction_number');
    }

    public function paymentMethod(){
        return $this->belongsTo(Payment::class, 'payment_method', 'id');
    }

    public function shipperName(){
        return $this->belongsTo(Shipper::class, 'shipper', 'id');
    }
}
