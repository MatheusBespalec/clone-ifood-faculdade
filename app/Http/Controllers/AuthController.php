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

    public function redirectToFacebookProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookProvider()
    {
        $facebookUser = Socialite::driver('facebook')->user();
        $user = User::updateOrCreate([
            'facebook_id' => $facebookUser->getId(),
        ], [
            'name' => $facebookUser->getName(),
            'email' => $facebookUser->getEmail(),
            'facebook_id' => $facebookUser->getId(),
        ]);
        auth()->login($user);
        return redirect()->route("home");
    }
}
