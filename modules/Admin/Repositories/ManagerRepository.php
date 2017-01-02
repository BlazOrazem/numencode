<?php

namespace Admin\Repositories;

use Numencode\Models\Manager;
use Numencode\Utils\Imageable;
use Illuminate\Support\Facades\Auth;

class ManagerRepository
{
    /**
     * The auth guard.
     *
     * @var $guard
     */
    protected $guard = 'admin';

    /**
     * Find a manager by login data.
     *
     * @param string $email    Managers' email
     * @param string $password Managers' password
     *
     * @return object|null|bool
     */
    public function getByLogin($email, $password)
    {
        if ($manager = $this->getByEmail($email)) {
            return password_verify($password, $manager['password']) ? $manager : null;
        }

        return false;
    }

    /**
     * Find a manager by email address.
     *
     * @param string $email Managers' email
     *
     * @return object|bool
     */
    public function getByEmail($email)
    {
        return Manager::where('email', $email)->first() ?: false;
    }

    /**
     * Login manager.
     *
     * @param Manager $manager  Manager
     * @param bool    $remember Remember login
     *
     * @return void
     */
    public function login(Manager $manager, $remember = false)
    {
        Auth::guard($this->guard)->login($manager, $remember);
    }

    /**
     * Create new manager.
     *
     * @return static Manager
     */
    public function create()
    {
        return Manager::create([
            'name' => request()->name,
            'email' => request()->email,
            'phone' => request()->phone,
            'password' => bcrypt(request()->password),
            'avatar' => !empty(request()->avatar) ? Imageable::createFromFile(
                request()->avatar, 'uploads/admin/avatars', config('login.avatar_width'), config('login.avatar_height')
            ) : null,
        ]);
    }

    /**
     * Update manager profile.
     *
     * @param Manager $manager Manager
     *
     * @return bool
     */
    public function update(Manager $manager)
    {
        if (request()->email != $manager->email) {
            $manager->email = request()->email;
        }

        if (request()->avatar) {
            if ($manager->avatar) {
                Imageable::deleteFile($manager->avatar);
            }

            $manager->avatar = Imageable::createFromFile(
                request()->avatar, 'uploads/admin/avatars', config('login.avatar_width'), config('login.avatar_height')
            );
        }

        if (request()->password) {
            $manager->password = bcrypt(request()->password);
        }

        $manager->name = request()->name;
        $manager->phone = request()->phone;

        return $manager->save();
    }
}
