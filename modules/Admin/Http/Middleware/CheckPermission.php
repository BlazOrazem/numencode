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
     * Check if manager has the permission although always allow manager to edit his own profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $permission
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        if (!Auth::guard($this->guard)->user()->can($permission) && Auth::guard($this->guard)->user()->id != $request->segment(3)) {
            flash()->error(
                trans('admin::messages.error'),
                trans('admin::messages.error_auth')
            );

            return redirect()->route('admin.dashboard');
        }

        return $next($request);
    }
}
