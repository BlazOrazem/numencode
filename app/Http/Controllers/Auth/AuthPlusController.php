<?php

namespace Numencode\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\ThrottlesLogins;

class AuthPlusController extends AuthController
{
    use ThrottlesLogins;
}
