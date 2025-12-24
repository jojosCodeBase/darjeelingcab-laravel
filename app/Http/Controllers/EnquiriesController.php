<?php

namespace App\Http\Controllers;

use App\Models\Enquiries;
use Illuminate\Http\Request;

class EnquiriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enquiries = Enquiries::orderByDesc('created_at')->get();
        $unread_count = $enquiries->whereNull('read_at')->count();
        return view('admin.enquiries.index', compact('enquiries', 'unread_count'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Enquiries $enquiries)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Enquiries $enquiries)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Enquiries $enquiry)
    {
        $enquiry->read_at = now();
        $enquiry->save();
        
        return back()->withSuccess('Enquiry updated successfully');
    }

    public function readAll()
    {
        Enquiries::whereNull('read_at')->update([
            'read_at' => now()
        ]);

        return back()->withSuccess('All enquiries marked as read');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enquiries $enquiries)
    {
        //
    }
}
