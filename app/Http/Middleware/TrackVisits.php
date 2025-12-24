<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Jaybizzle\CrawlerDetect\CrawlerDetect;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

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

        $crawlerDetect = new CrawlerDetect;
        $userAgent = $request->header('User-Agent');

        // 1. Filter Bots
        if (!$crawlerDetect->isCrawler($userAgent)) {

            // 2. Create a unique key for this User + Page
            // We hash the URL to keep the cache key short and clean
            $cacheKey = 'track:' . md5($request->ip() . $request->fullUrl());

            // 3. Check if this specific request was already logged recently
            // We use 'add' because it only returns true if the key doesn't exist
            // Setting the timer to 60 seconds (1 minute) ignores refreshes for that duration
            if (Cache::add($cacheKey, true, now()->addMinutes(30))) {
                DB::table('request_logs')->insert([
                    'ip_address' => $request->ip(),
                    'url' => $request->fullUrl(),
                    'method' => $request->method(),
                    'user_agent' => $userAgent,
                    'created_at' => now(),
                ]);
            }
        }

        return $next($request);
    }
}
