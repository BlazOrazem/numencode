<?php

namespace Cms\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAllowance
{
    /**
     * The auth guard.
     *
     * @var $guard
     */
    protected $guard = 'web';

    /**
     * Check if user has the permission/s to complete the action.
     *
     * Multiple permissions can be sent to the handle() method, divided with the pipe character:
     * Route::get('demo', 'DemoController@index')->middleware('permission:view_demo|edit_demo');
     *
     * @param Request $request    Request
     * @param Closure $next       Closure
     * @param string  $permission Permission
     *
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

        return redirect()->route('home');
    }

    /**
     * Flash error message for unauthorized action.
     *
     * @return void
     */
    protected function flashError()
    {
        flash()->error(
            trans('theme::messages.error'),
            trans('theme::messages.error')
        );
    }
}
