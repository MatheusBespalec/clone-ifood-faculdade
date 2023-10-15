<?php

namespace App\Http\Controllers;

use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirectToGoogleProvider()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleProvider()
    {
        $googleUser = Socialite::driver('google')->user();
        $user = User::updateOrCreate([
            'google_id' => $googleUser->id,
        ], [
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'google_id' => $googleUser->id,
        ]);
        auth()->login($user);
        return redirect()->route("home");
    }
}
