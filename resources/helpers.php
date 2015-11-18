<?php

use Numencode\Utils\Flash;

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
        $flash = app(Flash::class);

        if (func_num_args() == 0) {
            return $flash;
        }

        return $flash->info($title, $message);
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
