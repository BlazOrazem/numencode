<?php

namespace Admin\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * The auth guard.
     *
     * @var $guard
     */
    protected $guard = 'admin';

    /**
     * Check if manager has the permission/s although always allow manager to edit his own profile.
     *
     * Multiple permissions can be sent to the handle() method, divided with the pipe character:
     * Route::get('demo', 'DemoController@index')->middleware('permission:view_demo|edit_demo');
     *
     * @param  Request $request
     * @param  Closure $next
     * @param  string  $permission
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        $permissions = explode('|', $permission);

        if (count($permissions) > 1) {
            foreach ($permissions as $permission) {
                if (Auth::guard($this->guard)->user()->can($permission)) {
                    return $next($request);
                }
            }
            return $this->revoke();
        } else {
            if (!Auth::guard($this->guard)->user()->can($permission) && Auth::guard($this->guard)->user()->id != $request->segment(3)) {
                return $this->revoke();
            }
        }

        return $next($request);
    }

    /**
     * Revoke unauthorized action.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function revoke()
    {
        $this->flashError();
        return redirect()->route('admin.dashboard');
    }

    /**
     * Flash error message for unauthorized action.
     */
    protected function flashError()
    {
        flash()->error(
            trans('admin::messages.error'),
            trans('admin::messages.error_auth')
        );
    }
}
