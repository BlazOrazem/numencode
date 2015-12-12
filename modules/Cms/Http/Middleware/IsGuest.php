<?php

namespace Cms\Http\Middleware;

use Closure;
use Illuminate\Auth\Guard;
use Illuminate\Http\Request;

class IsGuest
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new IsGuest middleware instance.
     *
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Check if user is guest or else redirect to a homepage.
     *
     * @param Request $request
     * @param callable $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($this->auth->check()) {
            return redirect('/');
        }

        return $next($request);
    }
}
