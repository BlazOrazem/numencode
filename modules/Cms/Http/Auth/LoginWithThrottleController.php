<?php

namespace Cms\Http\Auth;

use Illuminate\Foundation\Auth\ThrottlesLogins;

class LoginWithThrottleController extends LoginController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller With Login Throttle
    |--------------------------------------------------------------------------
    |
    | Throttle login attempts to your application.
    |
    */

    use ThrottlesLogins;
}
