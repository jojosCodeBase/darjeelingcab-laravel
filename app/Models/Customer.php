<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'cust_id',
        'customer_type',
        'full_name',
        'phone_no',
        'email',
        'address',
        'city',
        'state',
        'notes'
    ];

    protected static function booted()
    {
        static::creating(function ($customer) {
            if (empty($customer->cust_id)) {
                $lastCustomer = self::orderBy('id', 'desc')->first();

                if ($lastCustomer && $lastCustomer->cust_id) {
                    // Get number after the last dash
                    $lastNumber = intval(substr($lastCustomer->cust_id, strrpos($lastCustomer->cust_id, '-') + 1));
                    $newNumber = $lastNumber + 1;
                } else {
                    $newNumber = 101;
                }

                $customer->cust_id = "DC-CUST-" . $newNumber;
            }
        });
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'customer_id');
    }
}
