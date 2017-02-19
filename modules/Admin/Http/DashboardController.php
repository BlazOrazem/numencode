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
        // Weekly analytics
        $weekAnalyticsData = Analytics::getVisitorsAndPageViews(7)->toArray();

        list($startDate, $endDate) = $this->calculateNumberOfDays(7);
        $weekVisitorCounter = Analytics::performQuery($startDate, $endDate, 'ga:users')->totalsForAllResults;
        $weekPageviewCounter = Analytics::performQuery($startDate, $endDate, 'ga:pageviews')->totalsForAllResults;
        $weekAvgSessionDuration = Analytics::performQuery($startDate, $endDate, 'ga:avgSessionDuration')->totalsForAllResults;
        $weekNewVisitors = Analytics::performQuery($startDate, $endDate, 'ga:percentNewSessions')->totalsForAllResults;

        $this->js([
            'weekVisitorCounter' => (int)ceil(reset($weekVisitorCounter)),
            'weekPageviewCounter' => (int)ceil(reset($weekPageviewCounter)),
            'weekAvgSessionDuration' => gmdate("H:i:s", (int)ceil(reset($weekAvgSessionDuration))),
            'weekVisitorsNewPercent' => (int)ceil(reset($weekNewVisitors)),
            'weekVisitorsReturnPercent' => 100 - (int)ceil(reset($weekNewVisitors)),
        ]);

        $this->js(['weekLabels' => array_map(function ($item) {
            return strtoupper($item['date']->format('l'));
        }, $weekAnalyticsData)]);

        $this->js(['weekVisitors' => array_map(function ($item) {
            return $item['visitors'];
        }, $weekAnalyticsData)]);

        $this->js(['weekPageViews' => array_map(function ($item) {
            return $item['pageViews'];
        }, $weekAnalyticsData)]);

        // Monthly analytics
        $monthAnalyticsData = Analytics::getVisitorsAndPageViews(30)->toArray();

        list($startDate, $endDate) = $this->calculateNumberOfDays(30);
        $monthVisitorCounter = Analytics::performQuery($startDate, $endDate, 'ga:users')->totalsForAllResults;
        $monthPageviewCounter = Analytics::performQuery($startDate, $endDate, 'ga:pageviews')->totalsForAllResults;
        $monthAvgSessionDuration = Analytics::performQuery($startDate, $endDate, 'ga:avgSessionDuration')->totalsForAllResults;
        $monthNewVisitors = Analytics::performQuery($startDate, $endDate, 'ga:percentNewSessions')->totalsForAllResults;

        $this->js([
            'monthVisitorCounter' => (int)ceil(reset($monthVisitorCounter)),
            'monthPageviewCounter' => (int)ceil(reset($monthPageviewCounter)),
            'monthAvgSessionDuration' => gmdate("H:i:s", (int)ceil(reset($monthAvgSessionDuration))),
            'monthVisitorsNewPercent' => (int)ceil(reset($monthNewVisitors)),
            'monthVisitorsReturnPercent' => 100 - (int)ceil(reset($monthNewVisitors)),
        ]);

        $this->js(['monthLabels' => array_map(function ($item) {
            return strtoupper($item['date']->format('d'));
        }, $monthAnalyticsData)]);

        $this->js(['monthVisitors' => array_map(function ($item) {
            return $item['visitors'];
        }, $monthAnalyticsData)]);

        $this->js(['monthPageViews' => array_map(function ($item) {
            return $item['pageViews'];
        }, $monthAnalyticsData)]);

        // Yearly analytics
        $yearAnalyticsData = Analytics::getVisitorsAndPageViews(365, 'yearMonth')->toArray();

        list($startDate, $endDate) = $this->calculateNumberOfDays(365);
        $yearVisitorCounter = Analytics::performQuery($startDate, $endDate, 'ga:users')->totalsForAllResults;
        $yearPageviewCounter = Analytics::performQuery($startDate, $endDate, 'ga:pageviews')->totalsForAllResults;
        $yearAvgSessionDuration = Analytics::performQuery($startDate, $endDate, 'ga:avgSessionDuration')->totalsForAllResults;
        $yearNewVisitors = Analytics::performQuery($startDate, $endDate, 'ga:percentNewSessions')->totalsForAllResults;

        $this->js([
            'yearVisitorCounter' => (int)ceil(reset($yearVisitorCounter)),
            'yearPageviewCounter' => (int)ceil(reset($yearPageviewCounter)),
            'yearAvgSessionDuration' => gmdate("H:i:s", (int)ceil(reset($yearAvgSessionDuration))),
            'yearVisitorsNewPercent' => (int)ceil(reset($yearNewVisitors)),
            'yearVisitorsReturnPercent' => 100 - (int)ceil(reset($yearNewVisitors)),
        ]);

        $this->js(['yearLabels' => array_map(function ($item) {
            return strtoupper($item['yearMonth']->format('M Y'));
        }, $yearAnalyticsData)]);

        $this->js(['yearVisitors' => array_map(function ($item) {
            return $item['visitors'];
        }, $yearAnalyticsData)]);

        $this->js(['yearPageViews' => array_map(function ($item) {
            return $item['pageViews'];
        }, $yearAnalyticsData)]);
    
        $this->js(['manager_tasks' => $this->admin()->tasks]);

        return view('admin::pages.dashboard', [
            'activeVisitors' => (int)Analytics::getActiveUsers(),
        ]);
    }

    /**
     * Template elements overview
     *
     * @return \Illuminate\View\View
     */
    public function elements()
    {
        return view('admin::pages.tpl_elements');
    }

    /**
     * Calculate start and end date for given number of days.
     *
     * @param $numberOfDays
     * @return array
     */
    protected function calculateNumberOfDays($numberOfDays)
    {
        $endDate = Carbon::today();
        $startDate = Carbon::today()->subDays($numberOfDays);

        return [$startDate, $endDate];
    }
}
