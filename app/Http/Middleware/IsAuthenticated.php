<?php

namespace Numencode\Http\Middleware;

use Closure;
use Illuminate\Auth\Guard;
use Illuminate\Http\Request;

class IsAuthenticated
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new IsAuthenticated middleware instance.
     *
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Check if user is authenticated or else display login screen.
     *
     * @param Request $request
     * @param callable $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$this->auth->check()) {
            return view('theme::auth.login');
        }

        return $next($request);
    }
}
