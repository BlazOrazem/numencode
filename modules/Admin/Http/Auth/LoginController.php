<?php

namespace Admin\Http\Auth;

use Illuminate\Http\Request;
use Admin\Http\BaseController;
use Illuminate\Support\Facades\Auth;
use Admin\Http\Requests\LoginRequest;
use Admin\Repositories\ManagerRepository;

class LoginController extends BaseController
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
     * @param Request $request Request
     *
     * @return \Illuminate\View\View
     */
    public function getLogin(Request $request)
    {
        $view = view('admin::auth.login', ['season' => $this->getSeason()]);

        if (isset($_GET['ref'])) {
            $view->with('ref', strip_tags($_GET['ref']));
        }

        return $view;
    }

    /**
     * Create manager login.
     *
     * @param LoginRequest      $request    Login request
     * @param ManagerRepository $repository Manager repository
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postLogin(LoginRequest $request, ManagerRepository $repository)
    {
        $manager = $request->resolveManager();

        $repository->login($manager, $request->remember);

        flash()->success(
            trans('admin::managers.login.title', ['name' => $manager->name]),
            trans('admin::managers.login.content')
        );

        return isset($request->ref) ? redirect($request->ref) : redirect($this->redirectPath);
    }

    /**
     * Logout manager.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getLogout()
    {
        Auth::guard($this->guard)->logout();

        flash()->success(
            trans('admin::managers.logout.title'),
            trans('admin::managers.logout.content')
        );

        return redirect()->route('admin.login');
    }

    /**
     * Get season name for current day.
     *
     * @return string
     */
    protected function getSeason()
    {
        $seasonDates = [
            '/12/20'=>'winter',
            '/09/20'=>'autumn',
            '/06/20'=>'summer',
            '/03/20'=>'spring',
            '/01/01'=>'winter',
        ];

        foreach ($seasonDates AS $key => $value) {
            if (strtotime("now") >= strtotime(date("Y") . $key)) {
                return $value;
            }
        }

        return 'default';
    }
}
