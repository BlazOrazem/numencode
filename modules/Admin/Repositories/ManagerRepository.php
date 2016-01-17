<?php

namespace Admin\Repositories;

use Admin\Models\Manager;
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
     * Find a manager by email address.
     *
     * @param $email
     * @return object|bool
     */
    public function getByEmail($email)
    {
        return Manager::where('email', $email)->first() ?: false;
    }

    /**
     * Find a manager by login data.
     *
     * @param $email
     * @param $password
     * @return object|null
     */
    public function getByLogin($email, $password)
    {
        if ($manager = $this->getByEmail($email)) {
            return password_verify($password, $manager['password']) ? $manager : null;
        }

        return null;
    }

    /**
     * Login manager.
     *
     * @param Manager $manager
     * @param bool $remember
     */
    public function login(Manager $manager, $remember = false)
    {
        Auth::guard($this->guard)->login($manager, $remember);

        flash()->success(trans('messages.login.title', ['name' => $manager->name]), trans('messages.login.content'));

        event('manager.logged_in', $manager);
    }
}
