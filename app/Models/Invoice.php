<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_no',
        'invoice_date',
        'customer_id',
        'booking_id',
        'manual_customer_name',
        'manual_customer_phone',
        'manual_customer_address',
        'description',
        'dates',
        'price',
        'qty',
        'amount',
        'vehicle_details',
        'total_amount',
        'received_amount',
        'balance_due',
        'payment_status',
    ];

    protected $casts = [
        'invoice_date' => 'date'
    ];

    protected static function booted()
    {
        static::creating(function ($invoice) {
            // Only generate if invoice_no is empty
            if (empty($invoice->invoice_no)) {
                $year = date('Y');
                $prefix = "DC-INV-$year-";

                // Find the last invoice number from this year
                $lastInvoice = self::where('invoice_no', 'like', $prefix . '%')
                    ->orderBy('id', 'desc')
                    ->first();

                if ($lastInvoice) {
                    // Extract the number after the last dash
                    // e.g., from DC-INV-2025-101, it takes 101
                    $lastNumber = intval(substr($invoice->invoice_no, strrpos($invoice->invoice_no, '-') + 1));
                    $newNumber = $lastNumber + 1;
                } else {
                    // Start from 101 for the first invoice of the year
                    $newNumber = 101;
                }

                $invoice->invoice_no = $prefix . $newNumber;
            }
        });
    }

    /**
     * Get the customer associated with the invoice (if any).
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the booking associated with the invoice (if any).
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * Helper to get the name regardless of invoice type.
     */
    public function getDisplayNameAttribute()
    {
        return $this->customer_id ? $this->customer->full_name : $this->manual_customer_name;
    }
}
