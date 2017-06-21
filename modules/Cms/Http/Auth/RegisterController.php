<?php

namespace Cms\Http\Auth;

use Cms\Http\BaseController;
use Cms\Mail\EmailVerification;
use Numencode\Models\User\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends BaseController
{
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
     * @param array $data Data
     *
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
     * @param array $data User data
     *
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'nickname' => $data['nickname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'avatar' => isset($data['avatar']) ? AvatarController::makeAvatarFromFile($data['avatar']) : null,
            'is_verified' => config('login.verification') ? false : true,
        ]);

        $user->assignRoles(config('numencode.registration_roles'));

        if (config('login.verification')) {
            Mail::to($user)->send(new EmailVerification($user));
        }

        return $user;
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
    
    /**
     * Verify user's email address.
     *
     * @param string $token User's token for email verification.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyEmail($token)
    {
        $user = User::whereToken($token)->first();

        if ($user) {
            $user->verifyEmail();
            $user->assignRoles(config('numencode.verification_roles'));

            flash()->overlay(trans('messages.email_verified.title'),
                trans('messages.email_verified.success', ['email' => $user->email]), 'success'
            );

            if (!$this->guard()->check()) {
                return redirect(get_route('login'));
            }
        } else {
            flash()->overlay(trans('messages.error'), trans('messages.email_verified.error'), 'error');
        }
        
        return redirect($this->redirectTo);
    }
}
