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
        $analyticsData = Analytics::getVisitorsAndPageViews(6);
//        dd($analyticsData);

        $dates = [];
        foreach ($analyticsData as $item) {
            $dates[$item['date']->format('l')] = [
                'visitors' => $item['visitors'],
                'pageViews' => $item['pageViews'],
            ];
        }

        $this->js(['dates' => $dates]);
//        dd($dates);

        return view('admin::pages.dashboard');
    }
}
