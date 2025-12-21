<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginActivity extends Model
{
    use HasFactory;

    // Note: 'created_at' is used as the event time, so we disable 'updated_at'
    const UPDATED_AT = null;

    protected $fillable = [
        'user_id',
        'event_name', // e.g., 'Admin Login', 'Failed Attempt'
        'ip_address',
        'location',
        'status',     // e.g., 'Success', 'Denied'
        'user_agent',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
