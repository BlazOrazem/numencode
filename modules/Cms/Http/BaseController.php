<?php

namespace Cms\Http;

use Auth;
use Numencode\Http\Controller;

class BaseController extends Controller
{
    /**
     * Return logged in user.
     *
     * @return \Numencode\Models\User
     */
    public function user()
    {
        return Auth::guard()->user();
    }
}
