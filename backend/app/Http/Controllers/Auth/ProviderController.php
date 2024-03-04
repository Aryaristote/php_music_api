<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class ProviderController extends Controller{
    public function redirect ($provider) {
        return Socialite::driver($provider)->redirect();
    }

    public function callback ($provider) {

        try{
            $SocialUser = Socialite::driver($provider)->stateless()->user();

            // if(User::where('email', $SocialUser->getEmail())->exists()) {
            //     return redirect('/login')->withErrors(['email' => 'The email address already exists']);
            // }

            $user = User::where([
                'provider' => $provider,
                'provider_id' => $SocialUser->id
            ])->first();

            if(!$user){
                $user = User::create([
                    'name' => $SocialUser->getName(),
                    'email' => $SocialUser->getEmail(),
                    'username' => User::generateUserName($SocialUser->username),
                    'provider' => $provider,
                    'provider_id' => $SocialUser->getId(),
                    'provider_token' => $SocialUser->token,
                    'email_verified_at' => now(),
                ]);
            }

            $existingToken = $user->token;

            if ($existingToken) {
                $tokenValue = $existingToken;
            } else {
                $tokenValue = $user->createToken('token')->plainTextToken;
            }
            Auth::login($user);

            return redirect()->away('http://localhost:3000/discover');

        }catch(\Exception $e){
            return redirect('/');
        }
    }
}
