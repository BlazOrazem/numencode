<?php

namespace Cms\Http;

class HomeController extends BaseController
{
    /**
     * Display the homepage.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if ($this->user) {
            return view('cms::pages.home');
        }

        return view('cms::auth.login');
    }
}
