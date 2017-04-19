<?php

namespace Admin\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Translation
{
    /**
     * The available languages.
     *
     * @array $languages
     */
    protected $languages = ['en','sl'];

    /**
     * Handle application locale.
     *
     * @param Request  $request Request
     * @param callable $next    Closure
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('locale')) {
            Session::put('locale', config('app.fallback_locale'));
        }

        app()->setLocale(Session::get('locale'));

        return $next($request);
    }
}
