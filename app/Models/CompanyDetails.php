<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'company_email',
        'whatsapp_number',
        'phones',
        'address',
        'facebook_url',
        'instagram_url',
        'twitter_url'
    ];
}
