<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function settings()
    {
        $user = auth()->user();
        $currentSignature = hash('sha256', request()->userAgent() . request()->ip());

        $trustedDevices = $user->trustedDevices()
            ->orderBy('last_active_at', 'desc')
            ->get()
            ->sortByDesc(function ($device) use ($currentSignature) {
                // This returns true (1) for current device and false (0) for others,
                // putting the current device at the top.
                return $device->browser_fingerprint === $currentSignature;
            });

        return view('admin.settings', [
            'trustedDevices' => $trustedDevices,
            'loginHistory' => $user->loginActivities()->latest()->take(10)->get(),
        ]);
    }
}
