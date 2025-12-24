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
        $tour_enquiries = TourEnquiries::orderByDesc('created_at')->get();
        
        $counts = [
            'new_enquiries' => $tour_enquiries->where('status', 'new')->count(),
            'quote_sent' => $tour_enquiries->where('status', 'quote_sent')->count(),
            'confirmed' => $tour_enquiries->where('status', 'confirmed')->count(),
        ];

        return view('admin.tour_enquiries.index', compact('tour_enquiries', 'counts'));
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
    public function update(Request $request, TourEnquiries $tourEnquiry)
    {
        try {
            $request->validate(['status' => 'required:in,quote_sent,confirmed']);

            $tourEnquiry->status = $request->input('status');
            $tourEnquiry->save();

            return response()->json("Tour Enquiry Updated Successfully");
        } catch (\Exception $e) {
            return response()->json("Some error occured", 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TourEnquiries $tourEnquiries)
    {
        //
    }
}
