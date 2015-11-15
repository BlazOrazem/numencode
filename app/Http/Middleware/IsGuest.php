<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Guard;
use Illuminate\Http\Request;

class IsGuest
{
    private $guard;

    /**
     * Create a new IsGuest middleware instance.
     *
     * @param Guard $guard
     */
    public function __construct(Guard $guard)
    {
        $this->guard = $guard;
    }

    /**
     * Check if user is a guest or else redirect to a homepage.
     *
     * @param Request $request
     * @param callable $next
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($this->guard->check()) {
            return redirect('/');
        }

        return $next($request);
    }
}
