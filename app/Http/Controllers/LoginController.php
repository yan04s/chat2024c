<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Redirect the user to Google’s OAuth page.
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle the callback from Google.
     */
    public function callback()
    {
        try {
            // Get the user information from Google
            $user = Socialite::driver('google')->user();
        } catch (Throwable $e) {
            return redirect('/')->with('error', 'Google authentication failed.');
        }

        // Check if the user already exists in the database
        $existingUser = User::where('email', $user->email)->first();

        if ($existingUser) {
            // Log the user in if they already exist
            Auth::login($existingUser);
        } else {
            // Otherwise, create a new user and log them in
            $newUser = User::updateOrCreate([
                'email' => $user->email
            ], [
                'name' => $user->name,
                'password' => bcrypt('defaultICEpassword'),//bcrypt(Str::random(16)), // Set a random password
                'email_verified_at' => now()
            ]);
            Auth::login($newUser);
        }

        // Redirect the user to the dashboard or any other secure page
        return redirect('/dashboard');
    }

    // Redirect the user to the Facebook authentication page.
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    // Obtain the user information from Facebook.
    public function handleFacebookCallback()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->user();
        } catch (Exception $e) {
            return redirect('login');
        }

        //Log::info(json_encode($facebookUser));
        // Check if the user already exists in the database
        //$user = User::where('facebook_id', $facebookUser->getId())->first();
        $user = User::where('email', $facebookUser->getEmail())->first();

        // If the user does not exist, create a new one.
        if (!$user) {
            $user = User::create([
                'name' => $facebookUser->getName(),
                'email' => $facebookUser->getEmail(),
                'password' => bcrypt('defaultICEpassword'),//bcrypt(Str::random(16)),
                'facebook_id' => $facebookUser->getId(),
                'avatar' => $facebookUser->getAvatar(),
                // Add any other fields you need
            ]);
        }else if ($user->facebook_id == null) {
            $user->update([
                'facebook_id' => $facebookUser->getId(),
                'avatar' => $facebookUser->getAvatar(),
            ]);
        }

        // Log in the user
        Auth::login($user);

        // Redirect to the dashboard or home page
        return redirect()->to('/dashboard');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => [function ($attribute, $value, $fail) {
                $user = Auth::user();
                if (!Hash::check('defaultICEpassword', $user->password) && !$value) {
                    $fail('The current password is required.');
                }
            }],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();

        if ($request->current_password === $request->new_password) {
            return response()->json(['message' => 'New password cannot be the same as the current password.'], 422);
        }elseif (!Hash::check($request->current_password, $user->password) && !Hash::check('defaultICEpassword', $user->password)) {// Verify the current password
            return response()->json(['message' => 'Current password is incorrect.'], 422);
        }

        // Update the password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['message' => 'Password updated successfully.']);
    }

    public function currentPasswordDetection()
    {
        //Log::info(Hash::make('defaultICEpassword')); // sample hash/ bcrypt: $2y$12$88zuArrvUHBCewI/nfM4KOpNCY0IPrIikLfx83HcY3HRxDs/E8qFa
        if(Hash::check('defaultICEpassword', Auth::user()->password)){//defaultICEpassword
            return response()->json(['message' => 'Current password is correct.', 'success' => 200]);
            //return response()->json(['message' => 'Current password is correct.'], 200);
        }else{
            return response()->json(['message' => 'Current password is incorrect.', 'failed' => 422]);
        }
    }

}
