<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slugged_title',
        'content',
        'author',
        'status',
        'views',
        'thumbnail',
        'image',
        'meta_description',
        'meta_keywords',
        'og_image',
        'twitter_image',
    ];

    // public function monthlyVisits()
    // {
    //     return $this->hasMany(MonthlyVisits::class);
    // }
}
