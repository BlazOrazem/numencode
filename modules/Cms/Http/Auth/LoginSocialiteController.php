<?php

namespace Cms\Http\Auth;

use Cms\Http\BaseController;
use Illuminate\Http\Request;
use Cms\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginSocialiteController extends BaseController
{
    /**
     * Supported socialite providers.
     *
     * @var array
     */
    protected $supportedProviders = [
        'facebook',
        'twitter',
        'google',
        'github',
    ];

    /**
     * Where to redirect after success.
     *
     * @var null
     */
    protected $redirectTo = '/';

    /**
     * Login or register a user with social provider.
     *
     * @param Request $request
     * @param UserRepository $repository
     * @param $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request, UserRepository $repository, $provider)
    {
        $this->assertProvider($provider);

        $providerCode = $request->has('code') || $request->has('oauth_token');

        if (!$providerCode) {
            return $this->getAuthorizationFirst($provider);
        }

        $user = $repository->loginSocialiteUser($this->getSocialiteUser($provider), $provider);

        $this->guard()->login($user);

        flash()->success(trans('messages.login.title', ['name' => $user->name]), trans('messages.login.content'));

        return isset($request->ref) ? redirect(route($request->ref)) : redirect($this->redirectTo);
    }

    /**
     * Validate given provider.
     *
     * @param $provider
     */
    protected function assertProvider($provider)
    {
        if (!in_array($provider, $this->supportedProviders)) {
            abort(404, 'Unsupported provider [' . $provider . ']');
        }
    }

    /**
     * Get user authorization from social provider.
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
    public function getSocialiteUser($provider)
    {
        return Socialite::driver($provider)->user();
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }
}
