<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'party_type',
        'full_name',
        'phone_no',
        'address',
        'booking_date',
        'persons',
        'vehicle_type',
        'days',
        'pickup_point',
        'drop_point',
    ];
}
