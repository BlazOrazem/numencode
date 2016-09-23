<?php

namespace Cms\Http\Auth;

use Illuminate\Foundation\Auth\ThrottlesLogins;

class AuthWithLoginThrottleController extends AuthController
{
    use ThrottlesLogins;
}
