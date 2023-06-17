<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'customer_id',
        'payment_amount',
        'payment_date',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
