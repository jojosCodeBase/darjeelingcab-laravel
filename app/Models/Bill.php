<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'bill_date',
        'bill_no',
        'vehicle_details',
        'payment_status',
        'description',
        'dates',
        'price',
        'amount',
        'sub_total',
        'discount',
        'total_amount'
    ];

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
