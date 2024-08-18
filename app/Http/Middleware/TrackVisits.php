<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class TrackVisits
{
    public function handle($request, Closure $next)
    {
        // Check if the user has been counted in this session
        if (!Session::has('hasVisited')) {
            // Increment the overall visit count
            $visit = Visit::firstOrCreate(['id' => 1]); // Always use the first record
            $visit->increment('count');

            // Set a session variable to indicate the user has been counted
            Session::put('hasVisited', true);
        }

        return $next($request);
    }
}
