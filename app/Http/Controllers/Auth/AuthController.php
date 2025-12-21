<?php

namespace App\Http\Controllers\Auth;

use App\Mail\TwoFactorMail;
use App\Models\TrustedDevice;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Location\Facades\Location;
use hisorange\BrowserDetect\Parser as Browser;
use App\Models\LoginActivity;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Jenssegers\Agent\Facades\Agent; // Optional: for easier browser/OS names

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // 1. Validation
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        // for failed login attempts also location details are required

        $ip_for_local = $request->ip() == '127.0.0.1' ? '150.129.135.101' : $request->ip(); // this is just for testing in localhost
        $location = Location::get($ip_for_local);
        $ip = $request->ip(); // this and the above will be merged in prod.
        $locationString = $location ? $location->cityName . ', ' . $location->regionName : 'Unknown';

        // 2. Pre-Authentication Checks
        if (!$user || !Hash::check($request->password, $user->password)) {
            $this->logActivity($request, $user, 'Failed Attempt', 'Denied', $locationString);
            return back()->withErrors(['password' => 'Invalid credentials.']);
        }

        if (!$user->hasVerifiedEmail()) {
            return back()->withErrors(['email' => 'Email not verified.']);
        }

        // 3. Device Fingerprinting

        $currentSignature = hash('sha256', $request->userAgent() . $ip);

        // 4. Check if Device is Trusted
        $trustedDevice = TrustedDevice::where('user_id', $user->id)
            ->where('browser_fingerprint', $currentSignature)
            ->first();

        if (!$trustedDevice) {
            // NEW DEVICE DETECTED: Start 2FA Flow
            return $this->initiateTwoFactor($request, $user, $ip, $locationString);
        }

        // 5. KNOWN DEVICE: Log in directly
        Auth::login($user);
        $this->logActivity($request, $user, 'Admin Login', 'Success', $locationString);

        // Update last active
        $trustedDevice->update(['last_active_at' => now(), 'ip_address' => $ip]);

        return redirect()->intended('/admin/dashboard');
    }

    protected function initiateTwoFactor(Request $request, $user, $ip, $locationString)
    {
        // Generate 6-digit code
        $code = rand(100000, 999999);

        // Store in session or DB
        $user->two_factor_code = Hash::make($code);
        $user->two_factor_expires_at = now()->addMinutes(15);
        $user->save();

        // Send Email (You need to create the Mailable: SendTwoFactorCode)
        Mail::to('dev.kunsang@gmail.com')->send(new TwoFactorMail($code));

        // Store attempt details in session to use after verification
        session([
            '2fa_user_id' => $user->id,
            '2fa_device_data' => [
                'fingerprint' => hash('sha256', $request->userAgent() . $ip),
                'ip' => $ip,
                'location' => $locationString,
                'browser' => Agent::browser(), // Requires jenssegers/agent
                'platform' => Agent::platform(),
                'device_type' => Agent::isMobile() ? 'mobile' : 'desktop',
            ]
        ]);

        return view('two-factor-auth');

        return redirect()->route('2fa.index')->with('info', 'New device detected. Please verify your email.');
    }

    protected function logActivity(Request $request, $user, $event, $status, $location = 'Unknown')
    {
        LoginActivity::create([
            'user_id' => $user?->id,
            'event_name' => $event,
            'ip_address' => $request->ip(),
            'location' => $location,
            'status' => $status,
            'user_agent' => $request->userAgent(),
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }

    public function logoutDevice(TrustedDevice $device)
    {
        // Ensure the user owns this device record
        abort_if($device->user_id !== auth()->id(), 403);

        // $device->delete();

        return back()->withSuccess('Device access revoked successfully.');
    }

    public function verifyTwoFactor(Request $request)
    {
        $request->validate(['auth_code' => 'required']);
        $user = User::findOrFail(session('2fa_user_id'));

        if (Hash::check($request->auth_code, $user->two_factor_code) && now()->lt($user->two_factor_expires_at)) {

            // 1. Mark device as authorized
            $data = session('2fa_device_data');
            TrustedDevice::create([
                'user_id' => $user->id,
                'browser_fingerprint' => $data['fingerprint'],
                'device_type' => $data['device_type'],
                'platform' => $data['platform'],
                'browser' => $data['browser'],
                'ip_address' => $data['ip'],
                'location' => $data['location'],
                'last_active_at' => now(),
            ]);

            // 2. Clear 2FA columns and Log in
            $user->update(['two_factor_code' => null, 'two_factor_expires_at' => null]);
            Auth::login($user);

            $this->logActivity($request, $user, 'Admin Login', 'Success', $data['location']);
            session()->forget(['2fa_user_id', '2fa_device_data']);

            return redirect('/admin/dashboard');
        }

        return back()->withErrors(['code' => 'Invalid or expired code.']);
    }
}
