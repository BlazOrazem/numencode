<?php

namespace App\Repositories;

use Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
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

    private $auth;

    private $tokens;

    public function __construct(Guard $auth, TokenRepositoryInterface $tokens)
    {
        $this->auth = $auth;
        $this->tokens = $tokens;
    }

    /**
     * Find an existing user or create a new one.
     *
     * @param $userData
     * @return User instance
     */
    public function getByEmailOrCreate($userData)
    {
        // Check if user exists.
        $user = $this->getByEmail($userData->email);

        // Update missing user data.
        if ($user){
            $user->nickname         = $user->nickname ?: $userData->nickname;
            $user->avatar           = $user->avatar ?: $this->makeAvatarFromUrl($userData->avatar);
            $user->avatar_thumbnail = $user->avatar_thumbnail ?: $this->makeAvatarFromUrl($userData->avatar, true);
            $user->save();
            return $user;
        }

        return $this->create((array)$userData, true);
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
        if($user = $this->getByEmail($email)) {
            return password_verify($password, $user['password']) ? $user : null;
        }

        return null;
    }

    /**
     * Make avatar from given image URL.
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
     * DONE
     */




    /**
     * Authenticate user.
     *
     * @param User $user
     * @param bool $remember
     */
    public function login(User $user, $remember = false)
    {
        $this->auth->login($user, $remember);

        event('user.logged_in', $user);
    }

    /**
     * Create a new user from request.
     *
     * @param Request $request
     * @return object
     */
    public function createFromRequest(Request $request)
    {
        return $this->create([
            'name'             => $request->name,
            'nickname'         => $request->nickname,
            'email'            => $request->email,
            'password'         => $request->password,
            'avatar'           => $this->makeAvatarFromFile($request->avatar),
            'avatar_thumbnail' => $this->makeAvatarFromFile($request->avatar, true),
            'is_verified'      => false,
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
            'name'             => $data['name'],
            'nickname'         => $data['nickname'],
            'email'            => $data['email'],
            'password'         => bcrypt($data['password']),
            'avatar'           => $data['avatar'],
            'avatar_thumbnail' => $data['avatar_thumbnail'],
            'is_verified'      => $data['is_verified'],
        ]);

        event('user.registered', $user);

        return $user;
    }

    /**
     * Make avatar from uploaded file.
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
     * Save avatar file.
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

}
