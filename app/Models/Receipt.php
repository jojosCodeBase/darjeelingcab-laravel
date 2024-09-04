<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    protected $fillable = [
        'bill_id',
        'customer_id',
        'amount',
        'balance',
        'payment_method',
        'payment_status',
        'payment_date',
    ];

    // Define the relationship with the Invoice model
    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }

    // Define the relationship with the Customer model
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
