<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyVisits extends Model
{
    use HasFactory;
    protected $table = 'monthly_visits';

    protected $fillable = [
        'start_date',
        'end_date',
        'blog_id',
        'visits',
    ];
}
