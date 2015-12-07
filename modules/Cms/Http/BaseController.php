<?php

namespace Cms\Http;

use Illuminate\Support\Facades\Auth;
use Numencode\Http\Controllers\Controller;

class BaseController extends Controller
{
    /**
     * Authenticated user implementation.
     *
     * @var User
     */
    protected $user;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->user = Auth::user();

        view()->share('user', $this->user);
        view()->share('signedIn', (bool)Auth::check());
    }
}
