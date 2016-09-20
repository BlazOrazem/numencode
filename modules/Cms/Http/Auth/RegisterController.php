<?php

namespace Cms\Http\Auth;

use Validator;
use Numencode\Models\User;
use Cms\Http\BaseController;
use Cms\Repositories\UserRepository;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'nickname' => 'max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'nickname' => $data['nickname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'avatar' => $data['avatar'] ? UserRepository::makeAvatarFromFile($data['avatar']) : null,
            'avatar_thumbnail' => $data['avatar'] ? UserRepository::makeAvatarFromFile($data['avatar'], true) : null,
            'is_verified' => config('login.verification') ? false : true,
        ]);
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('theme::auth.register');
    }
}
