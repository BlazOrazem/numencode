<?php

namespace Cms\Http\Auth;

use Validator;
use Numencode\Models\User;
use Cms\Mailers\UserMailer;
use Cms\Http\BaseController;
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
     * Mailer class.
     *
     * @var UserMailer
     */
    protected $mailer;

    /**
     * Create a new RegisterController instance.
     *
     * @param UserMailer $mailer User mailer
     */
    public function __construct(UserMailer $mailer)
    {
        $this->mailer = $mailer;
    }

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
        $user = User::create([
            'name' => $data['name'],
            'nickname' => $data['nickname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'avatar' => isset($data['avatar']) ? AvatarController::makeAvatarFromFile($data['avatar']) : null,
            'is_verified' => config('login.verification') ? false : true,
        ]);

        if (config('login.verification')) {
            $this->mailer->sendEmailVerificationTo($user);
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
     * @param $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyEmail($token)
    {
        $user = User::whereToken($token)->first();

        if ($user) {
            $user->verifyEmail();

            flash()->overlay(trans('messages.email_verified.title'),
                trans('messages.email_verified.success', ['email' => $user->email]), 'success'
            );

            if (!$this->guard()->check()) {
                return redirect(route('login'));
            }
        } else {
            flash()->overlay(trans('messages.error'), trans('messages.email_verified.error'), 'error');
        }
        
        return redirect($this->redirectTo);
    }
}
