<?php

namespace App\Http\Controllers\Auth;

use App\AuthenticateUser;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use App\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    protected $supportedProviders = [
        'facebook',
        'twitter',
        'google',
        'github',
    ];

    protected $redirect = null;

    protected $users;

    protected $guard;

    public function __construct(UserRepository $users, Guard $guard)
    {
        $this->users = $users;
        $this->guard = $guard;
    }

    public function getLogin(Request $request, $provider)
    {
        $this->assertProvider($provider);

        if($request->redirect) {
            session(['redirect' => $request->redirect]);
        }

        return Socialite::driver($provider)->redirect();
    }

    protected function assertProvider($provider)
    {
        if(!in_array($provider, $this->supportedProviders)) {
            abort(404, 'Unsupported provider [' . $provider . ']');
        }
    }

    /**
     * Register/login user via social network app.
     *
     * @param AuthenticateUser $authenticateUser
     * @param SocialiteProvider $socialiteProvider
     * @param Request $request
     * @param $provider Socialite provider name.
     * @return mixed
     */
    public function loginWithProvider(AuthenticateUser $authenticateUser, Request $request, $provider)
    {
        if (!$socialiteProvider->isValid($provider)) {
            abort(404);
        }

        return $authenticateUser->execute($request->has('code') || $request->has('oauth_token'), $provider, $this);
    }
}
