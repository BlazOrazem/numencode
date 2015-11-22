<?php

namespace Cms\Controllers;

use Numencode\Http\Requests;
use Numencode\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Display the homepage.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if ($this->user) {
            return view('theme.pages.home');
        }

        return view('theme.auth.login');
    }
}
