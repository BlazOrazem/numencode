<?php

namespace Cms\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Numencode\Models\System\Language;

class Localization
{
    /**
     * Handle application locale.
     *
     * @param Request $request
     * @param callable $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = $this->getLocaleFromRequest($request);
        app()->setLocale($locale ?: config('app.fallback_locale'));

        return $next($request);
    }

    /**
     * Return locale based on requested URI.
     *
     * @param Request $request
     * @return null|string
     */
    public function getLocaleFromRequest(Request $request)
    {
        $locales = Language::getAllLocales()->keys();
        $locale = $request->segment(1);

        return in_array($locale, $locales) ? $locale : null;
    }
}
