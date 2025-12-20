<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'created_by',
        'pax',
        'start_date',
        'end_date',
        'day_date',
        'destination',
        'vehicle_type',
        'vehicle_no',
        'driver_name',
    ];

    protected static function booted()
    {
        static::creating(function ($booking) {
            if (empty($booking->booking_id)) {
                $year = date('Y');
                $prefix = "DC-BK-$year-";

                $lastBooking = self::where('booking_id', 'like', $prefix . '%')
                    ->orderBy('id', 'desc')
                    ->first();

                if ($lastBooking) {
                    $lastNumber = intval(substr($lastBooking->booking_id, strrpos($lastBooking->booking_id, '-') + 1));
                    $newNumber = $lastNumber + 1;
                } else {
                    $newNumber = 101;
                }

                $booking->booking_id = $prefix . $newNumber;
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
