<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Please enter your username.',
            'email.email' => 'Please enter a valid username.',
            'password.required' => 'Please enter your password.',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Username is not registered.',
            ]);
        }

        // Check if the user's email is verified
        if (!$user->hasVerifiedEmail()) {
            return back()->withErrors([
                'email' => 'Your email address is not verified. Please check your mail and then continue.',
            ]);
        }

        $userCredentials = $request->only('email', 'password');

        if (Auth::attempt($userCredentials)) {
            return redirect('/admin/dashboard');
        } else {
            return back()->withErrors([
                'password' => 'Password is incorrect.',
            ]);
        }
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
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
