<?php

namespace Admin\Repositories;

use Numencode\Models\User;
use Numencode\Utils\Imageable;

class UserRepository
{
    /**
     * Find a user by email address.
     *
     * @param string $email Users' email
     *
     * @return object|bool
     */
    public function getByEmail($email)
    {
        return User::where('email', $email)->first() ?: false;
    }

    /**
     * Create new user.
     *
     * @return static User
     */
    public function create()
    {
        return User::create([
            'name' => request()->name,
            'nickname' => request()->nickname,
            'email' => request()->email,
            'password' => bcrypt(request()->password),
            'avatar' => !empty(request()->avatar) ? Imageable::createFromFile(
                request()->avatar, 'uploads/avatars', config('login.avatar_width'), config('login.avatar_height')
            ) : null,
        ]);
    }

    /**
     * Update user profile.
     *
     * @param User $user User
     *
     * @return bool
     */
    public function update(User $user)
    {
        if (request()->email != $user->email) {
            $user->email = request()->email;
        }

        if (request()->avatar) {
            if ($user->avatar) {
                Imageable::deleteFile($user->avatar);
            }

            $user->avatar = Imageable::createFromFile(
                request()->avatar, 'uploads/avatars', config('login.avatar_width'), config('login.avatar_height')
            );
        }

        if (request()->password) {
            $user->password = bcrypt(request()->password);
        }

        $user->name = request()->name;
        $user->nickname = request()->nickname;

        return $user->save();
    }
}
