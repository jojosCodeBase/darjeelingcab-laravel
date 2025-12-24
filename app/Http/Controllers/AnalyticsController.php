<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MonthlyVisits;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    public function index()
    {
        // 1. Basic Stats (Last 30 Days)
        $totalViews = DB::table('request_logs')->count();
        $uniqueVisitors = DB::table('request_logs')->distinct('ip_address')->count();

        // 2. Views Today vs Yesterday
        $viewsToday = DB::table('request_logs')->whereDate('created_at', Carbon::today())->count();
        $viewsYesterday = DB::table('request_logs')->whereDate('created_at', Carbon::yesterday())->count();

        // 3. Top 10 Most Visited Pages
        $topPages = DB::table('request_logs')
            ->select('url', DB::raw('count(*) as total'))
            ->groupBy('url')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();

        // 4. Traffic by Device (Simplified from User Agent)
        $devices = DB::table('request_logs')
            ->select(DB::raw('
                CASE 
                    WHEN user_agent LIKE "%Mobile%" THEN "Mobile" 
                    WHEN user_agent LIKE "%Tablet%" THEN "Tablet" 
                    ELSE "Desktop" 
                END as device_type, 
                count(*) as total'))
            ->groupBy('device_type')
            ->get();

        // 5. Recent Logs for the table
        $logs = DB::table('request_logs')->orderBy('created_at', 'desc')->paginate(15);

        // 6. Top Performing Blogs from MonthlyVisits table
        // We join with blogs to get the titles
        $blogPerformance = MonthlyVisits::join('blogs', 'monthly_visits.blog_id', '=', 'blogs.id')
            ->select(
                'blogs.title',
                'monthly_visits.visits',
                'monthly_visits.start_date',
                'monthly_visits.end_date'
            )
            ->orderBy('monthly_visits.visits', 'desc')
            ->limit(5)
            ->get();

        return view(
            'admin.analytics.index',
            compact(
                'totalViews',
                'uniqueVisitors',
                'viewsToday',
                'viewsYesterday',
                'topPages',
                'devices',
                'logs',
                'blogPerformance'
            )
        );
    }
}