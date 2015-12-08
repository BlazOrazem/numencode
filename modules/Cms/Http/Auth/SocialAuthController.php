<?php

namespace Cms\Http\Auth;

use Cms\Http\BaseController;
use Illuminate\Http\Request;
use Cms\Repositories\UserRepository;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends BaseController
{
    /**
     * Supported social providers.
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
    protected $redirect = null;

    /**
     * Login or register a user with social provider.
     *
     * @param Request $request
     * @param UserRepository $repository
     * @param $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getLogin(Request $request, UserRepository $repository, $provider)
    {
        $this->assertProvider($provider);

        $providerCode = $request->has('code') || $request->has('oauth_token');

        if (!$providerCode) {
            return $this->getAuthorizationFirst($provider);
        }

        $user = $repository->createSocialUser($this->getSocialUser($provider), $provider);

        $repository->login($user, true);

        return redirect('/');
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
    public function getSocialUser($provider)
    {
        return Socialite::driver($provider)->user();
    }
}
