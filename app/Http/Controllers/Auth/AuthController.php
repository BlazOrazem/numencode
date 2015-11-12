<?php

namespace App\Http\Controllers\Auth;

use Validator;
use App\Models\User;
use App\Utils\AppMailer;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepository;
use App\Http\Requests\RegistrationRequest;
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

    protected $users;

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
     * Login user.
     *
     * @param LoginRequest $request
     * @param UserRepository $repository
     * @return array
     */
    public function postLogin(LoginRequest $request, UserRepository $repository)
    {
        $user = $request->resolvedUser();

        $repository->login($user, $request->remember);

        flash()->success("Welcome " . $user->name . "!", "You have successfully logged in.");

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
     * Verify user's email address.
     *
     * @param $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyEmail($token)
    {
        $user = User::whereToken($token)->first();

        if ($user) {
            $user->confirmEmail();
            flash()->overlay("Email verified", "You successfully verified your email address {$user->email}.", "success");
            Auth::login($user, $remember = false);
        } else {
            flash()->overlay("Error", "This email address has been already confirmed.", "error");
        }

        return redirect('/');
    }

}
