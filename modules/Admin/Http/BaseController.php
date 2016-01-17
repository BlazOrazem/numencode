<?php

namespace Admin\Http;

use Numencode\Http\Controller;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    /**
     * Authenticated manager implementation.
     *
     * @var Manager
     */
    protected $manager;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->manager = Auth::guard('admin')->user();

        view()->share('manager', $this->manager);
        view()->share('signedIn', (bool)Auth::guard('admin')->check());
    }
}
