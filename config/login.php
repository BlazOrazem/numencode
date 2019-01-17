<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Login With Socialite
    |--------------------------------------------------------------------------
    |
    | Enable authentication with Socialite providers.
    | Available providers are Facebook, Twitter, Google+ and Github.
    |
    | Supported: "true", "false"
    |
    */

    'socialite' => true,

    /*
    |--------------------------------------------------------------------------
    | User Email Verification
    |--------------------------------------------------------------------------
    |
    | Enable user email verification.
    |
    | Supported: "true", "false"
    |
    */

    'verification' => true,

    /*
    |--------------------------------------------------------------------------
    | Login Throttling
    |--------------------------------------------------------------------------
    |
    | Throttle login attempts to your application.
    |
    | Supported: "true", "false"
    |
    */

    'throttle' => true,

    /*
    |--------------------------------------------------------------------------
    | User Avatar Upload Folder Path
    |--------------------------------------------------------------------------
    |
    | Root folder is /public/. Use no leading or trailing slash.
    |
    */

    'avatar_path' => 'uploads/avatars',

    /*
    |--------------------------------------------------------------------------
    | User Avatar Image Dimensions
    |--------------------------------------------------------------------------
    |
    | Dimensions for user avatar image in pixels (px).
    |
    */

    'avatar_width' => 1000,
    'avatar_height' => 1000,

];
