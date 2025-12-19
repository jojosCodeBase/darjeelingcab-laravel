<?php

namespace App\Http\Controllers;

use App\Models\TourEnquiries;
use Illuminate\Http\Request;

class TourEnquiriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.tour_enquiries.index');
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
    public function show(TourEnquiries $tourEnquiries)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TourEnquiries $tourEnquiries)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TourEnquiries $tourEnquiries)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TourEnquiries $tourEnquiries)
    {
        //
    }
}
