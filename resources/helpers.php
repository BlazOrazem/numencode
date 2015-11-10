<?php

/**
 * Flash message handler.
 *
 * @param string|null $title
 * @param string|null $message
 * @return App\Utils\Flash
 */
function flash($title = null, $message = null)
{
    $flash = app('App\Utils\Flash');

    if (func_num_args() == 0) {
        return $flash;
    }

    return $flash->info($title, $message);
}

/**
 * Return URL for the large avatar image, given from any social network.
 *
 * @param string $avatarUrl
 * @return string
 */
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
