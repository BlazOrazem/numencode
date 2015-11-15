<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Guard;
use Illuminate\Http\Request;

class IsAuthenticated
{
    private $guard;

    /**
     * Create a new IsAuthenticated middleware instance.
     *
     * @param Guard $guard
     */
    public function __construct(Guard $guard)
    {
        $this->guard = $guard;
    }

    /**
     * Check if user is authenticated or else display login screen.
     *
     * @param Request $request
     * @param callable $next
     * @return \Illuminate\View\View
     */
    public function handle(Request $request, Closure $next)
    {
        if(!$this->guard->check()) {
            return view('auth.login');
        }

        return $next($request);
    }
}
