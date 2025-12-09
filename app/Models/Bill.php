<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'customer_id',
        'bill_date',
        'bill_no',
        'vehicle_details',
        'payment_status',
        'description',
        'dates',
        'price',
        'amount',
        'balance_due',
        'received_amount',
        'total_amount'
    ];

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
