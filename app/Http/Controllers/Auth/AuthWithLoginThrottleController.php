<?php

namespace Numencode\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\ThrottlesLogins;

class AuthWithLoginThrottleController extends AuthController
{
    use ThrottlesLogins;
}
