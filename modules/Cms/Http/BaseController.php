<?php

namespace Cms\Http;

use Numencode\Http\Controller;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    /**
     * Localization.
     *
     * @var locale
     */
    protected $locale;

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

    /**
     * @return mixed
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param mixed $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }
}
