<?php

namespace App\Http\Controllers;

use App\Models\CompanyDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $company_details = CompanyDetails::where('user_id', Auth::id())->first();

        return view('admin.settings', [
            'trustedDevices' => $trustedDevices,
            'company_details' => $company_details,
            'loginHistory' => $user->loginActivities()->latest()->take(10)->get(),
        ]);
    }

    public function updateCompanyDetails(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'company_email' => 'required|email|max:255',
            'whatsapp_number' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'phones' => 'required|array|min:1',
            'phones.*' => 'nullable|string|distinct|max:20',
            'facebook_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
        ]);

        // Update the record
        CompanyDetails::where('user_id', Auth::id())->update([
            'company_name' => $validated['company_name'],
            'company_email' => $validated['company_email'],
            'whatsapp_number' => $validated['whatsapp_number'],
            'address' => $validated['address'],
            'phones' => json_encode($validated['phones']), // Store array as JSON
            'facebook_url' => $validated['facebook_url'],
            'instagram_url' => $validated['instagram_url'],
            'twitter_url' => $validated['twitter_url'],
        ]);

        return redirect()->back()->with('success', 'Company details updated successfully!');
    }
}
