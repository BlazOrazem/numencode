<?php

namespace Admin\Repositories;

use Illuminate\Http\Request;
use Numencode\Models\Manager;
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
     * @param string $email Managers' email
     *
     * @return object|bool
     */
    public function getByEmail($email)
    {
        return Manager::where('email', $email)->first() ?: false;
    }

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

        flash()->success(trans('messages.login.title', ['name' => $manager->name]), trans('messages.login.content'));
    }

    /**
     * Update manager profile.
     *
     * @param Manager $manager Manager
     * @param Request $request Request
     *
     * @return void
     */
    public function updateManager(Manager $manager, Request $request)
    {
        if ($request->email != $manager->email) {
            $manager->email = $request->email;
        }

//        if ($request->avatar) {
//            if ($manager->avatar) {
//                $this->deleteAvatarFile($manager);
//            }

//            $manager->avatar = $this->makeAvatarFromFile($request->avatar);
//            $manager->avatar_thumbnail = $this->makeAvatarFromFile($request->avatar, true);
//        }

        if ($request->password) {
            $manager->password = bcrypt($request->password);
        }

        $manager->name = $request->name;
        $manager->phone = $request->phone;
        $manager->save();
    }
}
