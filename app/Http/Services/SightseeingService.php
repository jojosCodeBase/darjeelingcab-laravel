<?php

namespace App\Http\Services;

use App\Models\SightseeingPackage;
use Illuminate\Http\Request;

class SightseeingService
{
    public function index()
    {
        $packages = SightseeingPackage::all();
        return view('admin.fare-estimator.sightseeing', compact('packages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'town_key' => 'required|alpha_dash', // unique check removed to allow updateOrCreate logic
            'package_name' => 'required|string',
            'description' => 'nullable',
            'fares' => 'required|array',
            'spots_raw' => 'required|string',
            'duration' => 'required'
        ]);

        // Convert spots from multiline string to array
        $spotsArray = collect(explode("\n", str_replace("\r", "", $request->spots_raw)))
            ->map(fn($item) => trim($item))
            ->filter()
            ->values()
            ->toArray();

        // Save or Update
        SightseeingPackage::updateOrCreate(
            ['town_key' => $request->town_key],
            [
                'package_name' => $request->package_name,
                'description' => $request->description,
                'fares' => $request->fares, // Automatic JSON cast by Model
                'spots' => $spotsArray,     // Automatic JSON cast by Model
                'duration' => $request->duration,
            ]
        );

        return back()->with('success', 'Sightseeing package updated!');
    }

    public function destroy($id)
    {
        SightseeingPackage::findOrFail($id)->delete();
        return back()->with('success', 'Package deleted successfully.');
    }
}