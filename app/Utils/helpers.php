<?php

if (! function_exists('getRoute')) {
    /**
     * Creates an URL to route alias
     *
     * @param string      $alias  Uri alias
     * @param string|null $locale Set locale or fallback to default
     *
     * @return mixed
     */
    function getRoute($alias, $locale = null)
    {
        $url = app()->make(\Illuminate\Contracts\Routing\UrlGenerator::class);

        if (!$locale) {
            $locale = app()->getLocale();
        }

        try {
            $route = $url->route($locale . ':' . $alias);
        } catch (InvalidArgumentException $e) {
            $route = $url->route($alias);
        }

        return $route;
    }
}

if (! function_exists('flash')) {
    /**
     * Flash message handler.
     *
     * @param string|null $title   Flash message title
     * @param string|null $message Flash message content
     *
     * @return Numencode\Utils\Flash
     */
    function flash($title = null, $message = null)
    {
        $flash = app(\Numencode\Utils\Flash::class);

        if (func_num_args() == 0) {
            return $flash;
        }

        return $flash->info($title, $message);
    }
}

if (! function_exists('reportError')) {
    /**
     * Report error notice to user.
     *
     * @return array
     */
    function reportError()
    {
        return [
            'title' => trans('admin::messages.error'),
            'msg'   => trans('admin::messages.error_notice'),
        ];
    }
}

if (! function_exists('ajaxSuccess')) {
    /**
     * Standardized successful Ajax response.
     *
     * @return array
     */
    function ajaxSuccess()
    {
        return [
            'success' => true,
        ];
    }
}

if (! function_exists('snake_slug')) {
    /**
     * Generate a URL friendly "snake slug" from a given string.
     *
     * @param string $title Text to be transformed to snake slug
     *
     * @return string
     */
    function snake_slug($title)
    {
        return str_replace('-', '_', \Illuminate\Support\Str::slug($title));
    }
}

if (! function_exists('fix_avatar_url')) {
    /**
     * Return URL for the large avatar image, given from any social network.
     *
     * @param string $avatarUrl Uri for the avatar image
     *
     * @return string
     */
    function fix_avatar_url($avatarUrl)
    {
        // Facebook
        if (preg_match('/(graph.facebook.com)/i', $avatarUrl)) {
            $avatarUrl = str_replace('?type=normal', '?width=1920', $avatarUrl);
        }

        // Twitter
        if (preg_match('/(pbs.twimg.com)/i', $avatarUrl)) {
            $avatarUrl = str_replace('_normal.jpg', '.jpg', $avatarUrl);
        }

        // Google
        if (preg_match('/(googleusercontent.com)/i', $avatarUrl)) {
            $avatarUrl = rtrim($avatarUrl, '?sz=50');
        }

        return $avatarUrl;
    }
}
