<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SocialiteController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     */
    public function handleGoogleCallback()
    {
        try {
            // Use stateless() if you are not using session state
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Check if the user already exists in the database
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                // Create a new user if one doesn't exist
                $user = User::create([
                    'name'     => $googleUser->getName(),
                    'email'    => $googleUser->getEmail(),
                    // Set a random password or a default value since the user is using social auth.
                    'password' => Hash::make(uniqid()),
                ]);

                // Assign a default role using Spatie.
                // Make sure you have created the "customer" role in your database.
                $user->assignRole('user');
            }

            // Log the user in
            Auth::login($user, true);

            // Return a view that triggers the parent window function
            return view('auth.google-callback');
        } catch (\Exception $e) {
            return redirect()->route('frontend.home')->with('error', 'Something went wrong. Please try again.');
        }
    }
}
