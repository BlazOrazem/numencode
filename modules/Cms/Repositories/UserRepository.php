<?php

namespace Cms\Repositories;

use Image;
use Numencode\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Laravel\Socialite\AbstractUser as SocialUser;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Auth\Passwords\TokenRepositoryInterface;

class UserRepository
{
    /**
     * Avatar upload folder path.
     *
     * @var string
     */
    protected $avatarPath = 'uploads/avatars';

    /**
     * Avatar file name.
     *
     * @var string
     */
    protected $avatar;

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * User tokens.
     *
     * @var object
     */
    private $tokens;

    /**
     * Create a new user repository instance.
     *
     * @param Guard $auth
     * @param TokenRepositoryInterface $tokens
     */
    public function __construct(Guard $auth, TokenRepositoryInterface $tokens)
    {
        $this->auth = $auth;
        $this->tokens = $tokens;
    }

    /**
     * Find a user by email address.
     *
     * @param $email
     * @return object|bool
     */
    public function getByEmail($email)
    {
        return User::where('email', $email)->first() ?: false;
    }

    /**
     * Find a user by login data.
     *
     * @param $email
     * @param $password
     * @return object|null
     */
    public function getByLogin($email, $password)
    {
        if ($user = $this->getByEmail($email)) {
            return password_verify($password, $user['password']) ? $user : null;
        }

        return null;
    }

    /**
     * Login user.
     *
     * @param User $user
     * @param bool $remember
     */
    public function login(User $user, $remember = false)
    {
        $this->auth->login($user, $remember);

        flash()->success(trans('messages.login.title', ['name' => $user->name]), trans('messages.login.content'));

        event('user.logged_in', $user);
    }

    /**
     * Find an existing user or create a new one with social provider.
     *
     * @param SocialUser $socialUser
     * @param $socialProvider
     * @return object
     */
    public function createSocialUser(SocialUser $socialUser, $socialProvider)
    {
        if ($user = $this->getByEmail($socialUser->email)) {
            $this->mergeSocialUser($user, $socialUser, $socialProvider);

            return $user;
        }

        return $this->createFromSocialUser($socialUser, $socialProvider);
    }

    /**
     * Merge social user with an existing user.
     *
     * @param User $user
     * @param SocialUser $socialUser
     * @param $provider
     */
    protected function mergeSocialUser(User $user, SocialUser $socialUser, $provider)
    {
        $user->nickname = $user->nickname ?: $socialUser->nickname;
        $user->avatar = $user->avatar ?: $this->makeAvatarFromUrl($socialUser->avatar);
        $user->avatar_thumbnail = $user->avatar_thumbnail ?: $this->makeAvatarFromUrl($socialUser->avatar, true);
        $user->social_provider_type = $provider;
        $user->social_provider_id = $socialUser->getId();
        $user->is_verified = true;
        $user->save();

        event('user.merged', [$user, $provider]);
    }

    /**
     * Create a new user from social provider.
     *
     * @param SocialUser $socialUser
     * @param $socialProvider
     * @return object
     */
    protected function createFromSocialUser(SocialUser $socialUser, $socialProvider)
    {
        $user = $this->create([
            'name' => $socialUser->name,
            'nickname' => $socialUser->nickname,
            'email' => $socialUser->email,
            'password' => '',
            'avatar' => $this->makeAvatarFromUrl($socialUser->avatar),
            'avatar_thumbnail' => $this->makeAvatarFromUrl($socialUser->avatar, true),
            'social_provider_type' => $socialProvider,
            'social_provider_id' => $socialUser->getId(),
            'is_verified' => true,
        ]);

        event('user.registered', $user);

        return $user;
    }

    /**
     * Create a new user form request.
     *
     * @param Request $request
     * @return object
     */
    public function createFromRequest(Request $request)
    {
        return $this->create([
            'name' => $request->name,
            'nickname' => $request->nickname,
            'email' => $request->email,
            'password' => $request->password,
            'avatar' => $request->avatar ? $this->makeAvatarFromFile($request->avatar) : null,
            'avatar_thumbnail' => $request->avatar ? $this->makeAvatarFromFile($request->avatar, true) : null,
            'is_verified' => config('login.verification') ? false : true,
        ]);
    }

    /**
     * Create a new user object.
     *
     * @param array $data
     * @return object
     */
    public function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'nickname' => $data['nickname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'avatar' => $data['avatar'],
            'avatar_thumbnail' => $data['avatar_thumbnail'],
            'social_provider_type' => isset($data['social_provider_type']) ? $data['social_provider_type'] : null,
            'social_provider_id' => isset($data['social_provider_id']) ? $data['social_provider_id'] : null,
            'is_verified' => $data['is_verified'],
        ]);

        event('user.registered', $user);

        return $user;
    }

    /**
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
            $user->avatar_thumbnail = $this->makeAvatarFromFile($request->avatar, true);
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
     * Create avatar image from uploaded file.
     *
     * @param UploadedFile $file
     * @param bool $isThumbnail
     * @return string
     */
    protected function makeAvatarFromFile(UploadedFile $file, $isThumbnail = false)
    {
        $image = Image::make($file);

        $this->avatar = sha1(time() . $file->getClientOriginalName());

        return $this->saveAvatarFile($image, $isThumbnail);
    }

    /**
     * Create avatar image from given image URL.
     *
     * @param $avatarUrl
     * @param bool $isThumbnail
     * @return string
     */
    protected function makeAvatarFromUrl($avatarUrl, $isThumbnail = false)
    {
        $avatarUrl = fix_avatar_url($avatarUrl);

        $image = Image::make(file_get_contents($avatarUrl));

        $this->avatar = sha1($avatarUrl);

        return $this->saveAvatarFile($image, $isThumbnail);
    }

    /**
     * Save avatar image file.
     *
     * @param $image
     * @param bool $isThumbnail
     * @return string
     */
    protected function saveAvatarFile($image, $isThumbnail = false)
    {
        if ($isThumbnail) {
            $image->fit(40, 40)->encode('jpg', 100);
        } else {
            $image->resize(800, 600, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode('jpg', 100);
        }

        $filePath = $this->avatarPath . '/' . ($isThumbnail ? 'tn-' . $this->avatar : $this->avatar) . '.jpg';

        $image->save($filePath);

        return $filePath;
    }

    /**
     * Delete user's avatar files.
     *
     * @param User $user
     */
    protected function deleteAvatarFile(User $user)
    {
        unlink($user->avatar);
        unlink($user->avatar_thumbnail);
    }

    /**
     * Reset user's password.
     *
     * @param User $user
     * @return null
     */
    public function resetPassword(User $user)
    {
        $token = $this->tokens->create($user);

        return event('user.reset_password', [$user, $token]);
    }

    /**
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
