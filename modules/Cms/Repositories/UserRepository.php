<?php

namespace Cms\Repositories;

use Numencode\Models\User;
use Illuminate\Http\Request;
use Cms\Http\Auth\AvatarController;
use Laravel\Socialite\AbstractUser as SocialiteUser;

class UserRepository
{
    /**
     * Find an existing user or create a new one with social provider.
     *
     * @param SocialiteUser $socialiteUser
     * @param $provider
     * @return object
     */
    public function createSocialiteUser(SocialiteUser $socialiteUser, $provider)
    {
        if ($user = User::where('email', $socialiteUser->email)->first()) {
            return $this->mergeSocialiteUser($user, $socialiteUser, $provider);
        }

        return $this->createFromSocialiteUser($socialiteUser, $provider);
    }

    /**
     * Create a new user from social provider.
     *
     * @param SocialiteUser $socialiteUser
     * @param $provider
     * @return User
     */
    protected function createFromSocialiteUser(SocialiteUser $socialiteUser, $provider)
    {
        return User::create([
            'name' => $socialiteUser->name,
            'nickname' => $socialiteUser->nickname,
            'email' => $socialiteUser->email,
            'password' => '',
            'avatar' => isset($socialiteUser->avatar) && !empty($socialiteUser->avatar) ?
                AvatarController::makeAvatarFromUrl($socialiteUser->avatar) : null,
            'social_provider_type' => $provider,
            'social_provider_id' => $socialiteUser->getId(),
            'is_verified' => true,
        ]);
    }

    /**
     * Merge Socialite user with an existing user.
     *
     * @param User $user
     * @param SocialiteUser $socialiteUser
     * @param $provider
     * @return User
     */
    protected function mergeSocialiteUser(User $user, SocialiteUser $socialiteUser, $provider)
    {
        $user->nickname = $user->nickname ?: $socialiteUser->nickname;
        $user->avatar = $user->avatar ?: (isset($socialiteUser->avatar) && !empty($socialiteUser->avatar) ?
            AvatarController::makeAvatarFromUrl($socialiteUser->avatar) : null);
        $user->social_provider_type = $provider;
        $user->social_provider_id = $socialiteUser->getId();
        $user->is_verified = true;
        $user->save();

        return $user;
    }

    /**
     * TODO refactoring
     * Update user's profile.
     *
     * @param User $user
     * @param Request $request
     */
    public function updateUser(User $user, Request $request)
    {
        if ($request->email != $user->email) {
            $user->email = $request->email;
            $user->token = str_random(30);
            $user->is_verified = false;
        }
        
        if ($request->avatar) {
            if ($user->avatar) {
                $this->deleteAvatarFile($user);
            }

            $user->avatar = $this->makeAvatarFromFile($request->avatar);
        }

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->name = $request->name;
        $user->nickname = $request->nickname;
        $user->save();

        event('user.update_profile', $user);
    }

    /**
     * TODO refactoring
     * Change user's password.
     *
     * @param User $user
     * @param $password
     * @return null
     */
    public function changePassword(User $user, $password)
    {
        $user->password = bcrypt($password);
        $user->save();

        return event('user.reset_password_changed', [$user]);
    }
}
