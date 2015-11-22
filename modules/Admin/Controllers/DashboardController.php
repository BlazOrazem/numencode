<?php

namespace Admin\Controllers;

use Numencode\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display the homepage.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.pages.home');
    }
}
