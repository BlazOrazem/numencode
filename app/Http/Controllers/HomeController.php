<?php

namespace Numencode\Http\Controllers;

use Numencode\Http\Requests;

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
            return view('pages.home');
        }

        return view('auth.login');
    }
}
