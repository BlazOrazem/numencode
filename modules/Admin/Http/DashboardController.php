<?php

namespace Admin\Http;

class DashboardController extends BaseController
{
    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin::pages.home');
    }
}
