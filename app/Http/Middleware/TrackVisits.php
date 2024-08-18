<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Visit;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisits
{
    public function handle($request, Closure $next)
    {
        // Increment the overall visit count
        $visit = Visit::firstOrCreate(['id' => 1]); // Always use the first record
        $visit->increment('count');

        return $next($request);
    }
}
