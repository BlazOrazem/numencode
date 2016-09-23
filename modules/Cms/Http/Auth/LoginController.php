<?php

namespace Cms\Http\Auth;

use Cms\Mailers\UserMailer;
use Cms\Http\BaseController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends BaseController
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
     * Create a new LoginController instance.
     *
     * @param UserMailer $mailer
     */
    public function __construct(UserMailer $mailer)
    {
        parent::__construct();

        $this->mailer = $mailer;
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        $view = view('theme::auth.login');

        if (isset($_GET['ref'])) {
            $view->with('ref', strip_tags($_GET['ref']));
        }

        return $view;
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        if (config('login.verification') && !$user->is_verified) {
            $this->mailer->sendEmailVerificationTo($user);
        }

        flash()->success(trans('messages.login.title', ['name' => $user->name]), trans('messages.login.content'));

        return isset($request->ref) ? redirect(route($request->ref)) : redirect($this->redirectTo);
    }

    /**
     * Log the user out of the application.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        flash()->success(trans('messages.logout.title'), trans('messages.logout.content'));

        return redirect('/');
    }
}
