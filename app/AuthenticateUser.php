<?php

namespace App;

use Socialite;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Auth\Guard;

class AuthenticateUser
{
    private $users;
    private $socialite;
    private $guard;

    /**
     * Create a new authenticate user instance.
     *
     * @param UserRepository $users
     * @param Socialite $socialite
     * @param Guard $guard
     */
    public function __construct(UserRepository $users, Socialite $socialite, Guard $guard)
    {
        $this->users = $users;
        $this->socialite = $socialite;
        $this->guard = $guard;
    }

    /**
     * Authenticate user via social provider.
     *
     * @param $providerCode
     * @param $provider
     * @param AuthenticateUserListener $listener
     * @return mixed
     */
    public function execute($providerCode, $provider, AuthenticateUserListener $listener)
    {
        if (!$providerCode) return $this->getAuthorizationFirst($provider);

        $user = $this->users->getByEmailOrCreate($this->getUser($provider));

        $this->guard->login($user, true);

        return $listener->userHasLoggedIn($user);
    }

    /**
     * Authorize user on social provider.
     *
     * @param $provider
     * @return mixed
     */
    private function getAuthorizationFirst($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from social provider.
     *
     * @param $provider
     * @return mixed
     */
    public function getUser($provider)
    {
        return Socialite::driver($provider)->user();
    }

}
