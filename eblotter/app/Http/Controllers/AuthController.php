<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Models\User;
use Auth;

class AuthController extends Controller
{
    // Redirect the user to Google's authentication page
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Handle the callback from Google
    public function handleGoogleCallback()
    {
        try {
            // Get the authenticated Google user
            $googleUser = Socialite::driver('google')->user();

            // Find or create the user in your database
            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'role' => session('role', 'employee'),  // Default to 'employee' if no role set
                ]
            );

            // Log the user in
            Auth::login($user);

            // Redirect to the appropriate page based on the user's role
            return redirect()->route($user->role === 'employee' ? 'employee.sections' : 'student.details')
                         ->with('field', session('selectedField', 'Unknown Field'));

        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Unable to login with Google.');
        }
    }

    // Handle the traditional login (username/password)
    public function login(Request $request)
    {
        // Validate login credentials
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Attempt to log the user in using the provided credentials
        if (Auth::attempt(['email' => $credentials['username'], 'password' => $credentials['password']])) {
            $user = Auth::user();

            // Redirect based on the user's role after successful login
            return redirect()->route($user->role === 'employee' ? 'employee.sections' : 'student.details')
                             ->with('field', session('selectedField', 'Unknown Field'));
        }

        // If login fails, redirect back with an error message
        return back()->withErrors(['login' => 'The provided credentials are incorrect.']);
    }
}
