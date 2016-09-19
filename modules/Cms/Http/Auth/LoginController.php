<?php

namespace Cms\Http\Auth;

use Cms\Http\BaseController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends BaseController
{
    use AuthenticatesUsers;

    /**
     * Get login redirect path.
     *
     * @var string
     */
    protected $redirectTo = '/';

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
        flash()->success(trans('messages.login.title', ['name' => $user->name]), trans('messages.login.content'));

        return isset($request->ref) ? redirect(route($request->ref)) : redirect($this->redirectTo);
    }
}
