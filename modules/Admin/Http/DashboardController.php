<?php

namespace Admin\Http;

use Analytics;
use Carbon\Carbon;

class DashboardController extends BaseController
{
    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
//        $data = Analytics::getTopKeywords();
//        $data = Analytics::getTopReferrers();
//        $data = Analytics::getMostVisitedPages();
//        $data = Analytics::getActiveUsers();

        // Sessions
//        list($startDate, $endDate) = $this->calculateNumberOfDays(6);
//        $data = Analytics::performQuery($startDate, $endDate, 'ga:sessions')->totalsForAllResults;
//        $data = Analytics::performQuery($startDate, $endDate, 'ga:sessions', ['dimensions' => 'ga:userType']);
//        dd($data);

        // New sessions pie chart (new visitor / returning visitor)
//        list($startDate, $endDate) = $this->calculateNumberOfDays(6);
//        $data = Analytics::performQuery($startDate, $endDate, 'ga:percentNewSessions')->totalsForAllResults;
//        dd($data);


        $analyticsData = Analytics::getVisitorsAndPageViews(6)->toArray();

        $this->js(['weekDays' => array_map(function ($item) {
            return strtoupper($item['date']->format('l'));
        }, $analyticsData)]);

        $this->js(['visitors' => array_map(function ($item) {
            return $item['visitors'];
        }, $analyticsData)]);

        $this->js(['pageViews' => array_map(function ($item) {
            return $item['pageViews'];
        }, $analyticsData)]);

        return view('admin::pages.dashboard');
    }

    protected function calculateNumberOfDays($numberOfDays)
    {
        $endDate = Carbon::today();
        $startDate = Carbon::today()->subDays($numberOfDays);

        return [$startDate, $endDate];
    }
}
