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
        return view('admin.enquiries.index', compact('enquiries'));
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
    public function update(Request $request, Enquiries $enquiries)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enquiries $enquiries)
    {
        //
    }
}
