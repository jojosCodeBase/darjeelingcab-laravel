<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SightSeeingPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'town_key',
        'package_name',
        'description',
        'fares',
        'spots',
        'duration',
    ];

    protected $casts = [
        'fares' => 'array',
        'spots' => 'array'
    ];
}
