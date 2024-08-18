<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;
    protected $fillable = ['blog_id', 'visitor_ip'];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
