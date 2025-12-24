<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Invoice;
use App\Models\Visit;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\WebsiteVisit;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $total_customers = Customer::count();
        $total_bookings = Booking::count();
        $published_blogs = Blog::where('status', 'published')->count();
        $total_amount = Invoice::all()->sum('total_amount');

        $total_revenue = ($total_amount * 10) / 100; // this is the 10% of all invoices amount, i.e. the commission taken from each booking

        $website_visits = Visit::first()->count;

        return view('admin.dashboard', compact('total_customers', 'total_bookings', 'total_revenue', 'published_blogs', 'website_visits'));
    }
}
