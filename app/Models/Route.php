<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $fillable = [
        'route_key',
        'source_id',
        'destination_id',
        'sedan_fare',
        'suv_fare',
        'large_suv_fare',
        'distance',
        'duration'
    ];

    public function source(){
        return $this->belongsTo(Location::class, 'source_id');
    }
    public function destination(){
        return $this->belongsTo(Location::class, 'destination_id');
    }
}
