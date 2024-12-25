<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Models\User;
use Auth;
use Log;

class AuthController extends Controller
{
    // Redirect the user to Google's authentication page
    public function redirectToGoogle()
    {
        // Log session data before redirecting to Google
        Log::info('Session data before Google login:', session()->all());

        return Socialite::driver('google')->redirect();
    }

    // Handle the callback from Google
    public function handleGoogleCallback()
    {
        try {
            // Get the user data from Google
            $googleUser = Socialite::driver('google')->user();

            // Log the individual properties of the Google user for debugging
            Log::info('Google User Data:', [
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'avatar' => $googleUser->getAvatar(),
                'google_id' => $googleUser->getId(),
            ]);

            // Log session data before login attempt for debugging
            Log::info('Session data before login attempt:', session()->all());

            // Check if the user already exists in the database or create a new user
            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()], // Match by email
                [
                    'name' => $googleUser->getName(),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'role' => session('role', 'employee'),  // Default role is 'employee' if not set in session
                ]
            );

            // Log the user creation or login attempt
            Log::info('User after login or create:', ['user' => $user]);

            // Log the session data after login attempt
            Log::info('Session data after login attempt:', session()->all());

            // Log the user in
            Auth::login($user);

            // Redirect based on the user's role
            return redirect()->route($user->role === 'employee' ? 'employee.sections' : 'student.details')
                             ->with('field', session('selectedField', 'Unknown Field')); // Pass selectedField from session to the route

        } catch (\Exception $e) {
            // If there is an exception during the login process, redirect to login page with the error message
            Log::error('Google login error: ' . $e->getMessage()); // Log the error message for debugging
            return redirect()->route('login')->with('error', 'Unable to login with Google. ' . $e->getMessage());
        }
    }

    // Traditional login
    public function login(Request $request)
    {
        // Validate the incoming credentials (either email or username + password)
        $credentials = $request->validate([
            'username' => 'required|string',  // Can be email or username
            'password' => 'required|string',
        ]);

        // Attempt login with the provided credentials
        if (Auth::attempt(['email' => $credentials['username'], 'password' => $credentials['password']])) {
            $user = Auth::user();

            // Debugging session data before redirecting (optional, remove after debugging)
            Log::info('Session data after login:', session()->all()); // Log session data for debugging

            // Redirect based on the user's role after successful login
            return redirect()->route($user->role === 'employee' ? 'employee.sections' : 'student.details')
                             ->with('field', session('selectedField', 'Unknown Field')); // Pass selectedField from session to the route
        }

        // If login fails, return back with an error message
        return back()->withErrors(['login' => 'The provided credentials are incorrect.']);
    }


// Logout the user
public function logout(Request $request)
{
    Auth::logout(); // Logs out the current user

    return redirect()->route('login'); // Redirect to the login page
}
public function deleteAccount(Request $request)
{
    try {
        // Get the authenticated user
        $user = Auth::user();
        
        // Delete the user from the database
        $user->delete();

        // Log out the user after deletion
        Auth::logout();

        // Redirect to login page with success message
        return redirect()->route('login')->with('success', 'Your account has been deleted successfully.');
    } catch (\Exception $e) {
        // Log any error for debugging
        Log::error('Error deleting account: ' . $e->getMessage());
        
        // Redirect with error message
        return redirect()->route('home')->with('error', 'There was an error deleting your account.');
    }
}

}
