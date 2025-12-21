<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'invoice_no', -- removing this as this is system generated
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
            if (empty($invoice->invoice_no)) {
                $year = date('Y');
                $prefix = "DC-INV-$year-";

                // Find the last invoice number from this year
                $lastInvoice = self::where('invoice_no', 'like', $prefix . '%')
                    ->orderBy('id', 'desc')
                    ->first();

                if ($lastInvoice) {
                    // FIX: Use $lastInvoice->invoice_no instead of $invoice->invoice_no
                    $lastNumber = intval(substr($lastInvoice->invoice_no, strrpos($lastInvoice->invoice_no, '-') + 1));
                    $newNumber = $lastNumber + 1;
                } else {
                    $newNumber = 101;
                }

                $invoice->invoice_no = $prefix . $newNumber;

                // LOGGING the final generated number
                \Log::info("Generated New Invoice Number: " . $invoice->invoice_no, [
                    'context' => 'Model Observer',
                    'user_id' => auth()->id() ?? 'system'
                ]);
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
