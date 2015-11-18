<?php

namespace Numencode\Http\Controllers\Auth;

use Validator;
use Numencode\Models\User;
use Numencode\Utils\AppMailer;
use Illuminate\Http\Request;
use Numencode\Http\Requests\LoginRequest;
use Numencode\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Numencode\Repositories\UserRepository;
use Numencode\Http\Requests\RegistrationRequest;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /**
     * Where to redirect after successful registration or login.
     *
     * @var string
     */
    protected $redirectPath = '/';

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        parent::__construct();

        $this->auth = $auth;

        $this->middleware('guest', ['except' => ['getLogout', 'verifyEmail']]);
    }

    /**
     * Page with login form.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function getLogin(Request $request)
    {
        return view('auth.login');
    }

    /**
     * Create user login.
     *
     * @param LoginRequest $request
     * @param UserRepository $repository
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postLogin(LoginRequest $request, UserRepository $repository)
    {
        $user = $request->resolvedUser();

        $repository->login($user, $request->remember);

        flash()->success(trans('messages.login.title', ['name' => $user->name]), trans('messages.login.content'));

        return redirect('/');
    }

    /**
     * Page with register form.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function getRegister(Request $request)
    {
        return view('auth.register');
    }

    /**
     * Create user registration.
     *
     * @param RegistrationRequest $request
     * @param UserRepository $repository
     * @param AppMailer $mailer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRegister(RegistrationRequest $request, UserRepository $repository, AppMailer $mailer)
    {
        $user = $repository->createFromRequest($request);

        $repository->login($user);

        if (Auth::attempt($this->getCredentials($request))) {
            $mailer->sendEmailVerificationTo($user);
        }

        return redirect('/');
    }

    /**
     * Logout user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getLogout()
    {
        $this->auth->logout();

        flash()->success(trans('messages.logout.title'), trans('messages.logout.content'));

        event('user.logged_out');

        return redirect('/');
    }

    /**
     * Verify user's email address.
     *
     * @param $token
     * @param UserRepository $repository
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyEmail($token, UserRepository $repository)
    {
        $user = User::whereToken($token)->first();

        if ($user) {
            $user->verifyEmail();

            flash()->overlay(trans('messages.email_verified.title'),
                trans('messages.email_verified.success', ['email' => $user->email]), 'success');

            event('user.email_verified');

            $repository->login($user);
        } else {
            flash()->overlay(trans('messages.error'), trans('messages.email_verified.error'), 'error');
        }

        return redirect('/');
    }
}
