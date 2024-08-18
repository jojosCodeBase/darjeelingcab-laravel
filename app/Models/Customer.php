<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_type',
        'full_name',
        'phone_no',
        'email',
        'address',
    ];

    public function bookings(){
        return $this->hasMany(Booking::class, 'customer_id');
    }
}
