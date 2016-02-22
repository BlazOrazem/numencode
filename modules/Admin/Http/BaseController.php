<?php

namespace Admin\Http;

use Numencode\Http\Controller;
use Illuminate\Support\Facades\Auth;
use Laracasts\Utilities\JavaScript\JavaScriptFacade;

class BaseController extends Controller
{
    /**
     * Authenticated manager implementation.
     *
     * @var Manager
     */
    protected $admin;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->admin = Auth::guard('admin')->user();

        view()->share('admin', $this->admin);
        view()->share('signedIn', (bool)Auth::guard('admin')->check());
    }

    /**
     * Pass data to Javascript
     *
     * @param $data
     */
    protected function js($data)
    {
        JavaScriptFacade::put($data);
    }
}
