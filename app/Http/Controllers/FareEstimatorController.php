<?php

namespace App\Http\Controllers;

use App\Http\Services\SightseeingService;
use App\Models\Location;
use App\Models\Route;
use Illuminate\Http\Request;

class FareEstimatorController extends Controller
{
    private $sightseeingService;

    public function __construct(SightseeingService $sightseeingService){
        $this->sightseeingService = $sightseeingService;
    }

    public function index()
    {
        $locations = Location::orderBy('display_name')->get();
        $routes = Route::select('routes.*')
            ->join('locations as src', 'routes.source_id', '=', 'src.id')
            ->join('locations as dest', 'routes.destination_id', '=', 'dest.id')
            ->with(['source', 'destination']) // Eager load for Blade display
            ->orderBy('src.display_name', 'asc') // Group by Source Name
            ->orderBy('dest.display_name', 'asc') // Sort destinations within that group
            ->get();
        return view('admin.fare-estimator.index', compact('locations', 'routes'));
    }

    public function storeLocation(Request $request)
    {
        $request->validate([
            'key' => 'required|unique:locations,key',
            'display_name' => 'required'
        ]);

        Location::create($request->all());
        return back()->with('success', 'Location alias added!');
    }

    public function storeRoute(Request $request)
    {
        $request->validate([
            'route_key' => 'required|unique:routes,route_key',
            'sedan_fare' => 'required|numeric',
            'suv_fare' => 'required|numeric',
            'large_suv_fare' => 'required|numeric',
            'source_id' => 'required',
            'destination_id' => 'required',
            'distance' => 'required',
            'duration' => 'required',
        ]);

        if ($request->source_id == $request->destination_id) {
            return back()->withErrors('Route Source and Destination cannot be same !')->withInput();
        }

        Route::updateOrCreate(
            ['route_key' => $request->route_key],
            $request->all()
        );

        return back()->with('success', 'Route pricing updated successfully!');
    }

    public function destroyRoute($id)
    {
        Route::destroy($id);
        return back()->with('success', 'Route deleted.');
    }

    public function sightseeing()
    {
        return $this->sightseeingService->index();
    }
    public function storeSightseeing(Request $request)
    {
        return $this->sightseeingService->store($request);
    }
    public function destroySightseeing($id)
    {
        return $this->sightseeingService->destroy($id);
    }
}
