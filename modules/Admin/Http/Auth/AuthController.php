<?php

namespace Admin\Http\Auth;

use Illuminate\Http\Request;
use Admin\Http\BaseController;
use Illuminate\Support\Facades\Auth;
use Admin\Http\Requests\LoginRequest;
use Admin\Repositories\ManagerRepository;

class AuthController extends BaseController
{
    /**
     * Where to redirect after successful registration or login.
     *
     * @var string
     */
    protected $redirectPath = '/admin';

    /**
     * The auth guard.
     *
     * @var $guard
     */
    protected $guard = 'admin';

    /**
     * Page with login form.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function getLogin(Request $request)
    {
        $view = view('admin::auth.login');

        if (isset($_GET['ref'])) {
            $view->with('ref', strip_tags($_GET['ref']));
        }

        return $view;
    }

    /**
     * Create manager login.
     *
     * @param LoginRequest $request
     * @param ManagerRepository $repository
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postLogin(LoginRequest $request, ManagerRepository $repository)
    {
        $manager = $request->resolveManager();

        $repository->login($manager, $request->remember);

        flash()->success(trans('messages.login.title', ['name' => $manager->name]), trans('messages.login.content'));

        return isset($request->ref) ? redirect(route($request->ref)) : redirect($this->redirectPath);
    }

    /**
     * Logout manager.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getLogout()
    {
        Auth::guard($this->guard)->logout();

        flash()->success(trans('messages.logout.title'), trans('messages.logout.content'));

        event('manager.logged_out');

        return redirect(route('admin.login'));
    }
}
