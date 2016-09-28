<?php

namespace Admin\Http;

use Numencode\Http\Controller;
use Illuminate\Support\Facades\Auth;
use Laracasts\Utilities\JavaScript\JavaScriptFacade;

class BaseController extends Controller
{
    /**
     * Create a new BaseController instance.
     */
    public function __construct()
    {
        view()->share('admin', Auth::guard('admin')->user());
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
