<?php

namespace Admin\Http;

use Analytics;

class DashboardController extends BaseController
{
    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
//        $analyticsData = Analytics::getVisitorsAndPageViews(7);
//        dd($analyticsData);

        return view('admin::pages.dashboard');
    }
}
