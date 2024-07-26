<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class OAuthController extends Controller
{
	public function index(): RedirectResponse
	{
		return Socialite::driver('google')->redirect();
	}

	public function callback(): RedirectResponse
	{
		$authUser = Socialite::driver('google')->user();

		$user = User::where('email', $authUser->getEmail())->first();

		if (!$user) {
			$user = User::create([
				'name' => $authUser->name,
				'email' => $authUser->email,
			]);

			event(new Registered($user));
		}

		Auth::login($user, true);

		return redirect()->intended('/');
	}
}
