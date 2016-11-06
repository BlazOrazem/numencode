<?php

/**
 * Creates an URL to route alias
 *
 * @param string $alias
 * @param array $parameters
 * @param null $locale
 * @param bool $absolute
 *
 * @throws BindingResolutionException
 * @return string
 */
if (!function_exists('getRoute'))
{
    function getRoute($alias, $locale = null)
    {
        $url = app()->make(\Illuminate\Contracts\Routing\UrlGenerator::class);

        if (!$locale) {
            $locale = app()->getLocale();
        }

        try {
            $route = $url->route($locale . ':' . $alias);
        }
        catch(InvalidArgumentException $e) {
            $route = $url->route($alias);
        }

        return $route;
    }
}

/**
 * Flash message handler.
 *
 * @param string|null $title
 * @param string|null $message
 * @return Numencode\Utils\Flash
 */
if (!function_exists('flash'))
{
    function flash($title = null, $message = null)
    {
        $flash = app(\Numencode\Utils\Flash::class);

        if (func_num_args() == 0) {
            return $flash;
        }

        return $flash->info($title, $message);
    }
}

/**
 * Report error notice to user.
 *
 * @return array
 */
if (!function_exists('reportError'))
{
    function reportError()
    {
        return [
            'title' => trans('admin::messages.error'),
            'msg' => trans('admin::messages.error_notice'),
        ];
    }
}

/**
 * Return URL for the large avatar image, given from any social network.
 *
 * @param string $avatarUrl
 * @return string
 */
if (!function_exists('fix_avatar_url'))
{
    function fix_avatar_url($avatarUrl)
    {
        // Facebook
        if(preg_match("/(graph.facebook.com)/i", $avatarUrl)){
            $avatarUrl = str_replace('?type=normal', '?width=1920', $avatarUrl);
        }

        // Twitter
        if(preg_match("/(pbs.twimg.com)/i", $avatarUrl)){
            $avatarUrl = str_replace('_normal.jpg', '.jpg', $avatarUrl);
        }

        // Google
        if(preg_match("/(googleusercontent.com)/i", $avatarUrl)){
            $avatarUrl = rtrim($avatarUrl, '?sz=50');
        }

        return $avatarUrl;
    }
}
