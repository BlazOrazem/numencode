<?php

namespace Admin\Repositories;

use Analytics;
use Carbon\Carbon;

class DashboardRepository
{
    public function loadAnalytics()
    {
        // Weekly analytics
        $weekAnalyticsData = Analytics::getVisitorsAndPageViews(7)->toArray();

        list($startDate, $endDate) = $this->calculateNumberOfDays(7);
        $weekVisitorCounter = Analytics::performQuery($startDate, $endDate, 'ga:users')->totalsForAllResults;
        $weekPageviewCounter = Analytics::performQuery($startDate, $endDate, 'ga:pageviews')->totalsForAllResults;
        $weekAvgSessionDuration = Analytics::performQuery($startDate, $endDate, 'ga:avgSessionDuration')->totalsForAllResults;
        $weekNewVisitors = Analytics::performQuery($startDate, $endDate, 'ga:percentNewSessions')->totalsForAllResults;

        js([
            'weekVisitorCounter' => (int)ceil(reset($weekVisitorCounter)),
            'weekPageviewCounter' => (int)ceil(reset($weekPageviewCounter)),
            'weekAvgSessionDuration' => gmdate("H:i:s", (int)ceil(reset($weekAvgSessionDuration))),
            'weekVisitorsNewPercent' => (int)ceil(reset($weekNewVisitors)),
            'weekVisitorsReturnPercent' => 100 - (int)ceil(reset($weekNewVisitors)),
        ]);

        js(['weekLabels' => array_map(function ($item) {
            return strtoupper($item['date']->format('l'));
        }, $weekAnalyticsData)]);

        js(['weekVisitors' => array_map(function ($item) {
            return $item['visitors'];
        }, $weekAnalyticsData)]);

        js(['weekPageViews' => array_map(function ($item) {
            return $item['pageViews'];
        }, $weekAnalyticsData)]);

        // Monthly analytics
        $monthAnalyticsData = Analytics::getVisitorsAndPageViews(30)->toArray();

        list($startDate, $endDate) = $this->calculateNumberOfDays(30);
        $monthVisitorCounter = Analytics::performQuery($startDate, $endDate, 'ga:users')->totalsForAllResults;
        $monthPageviewCounter = Analytics::performQuery($startDate, $endDate, 'ga:pageviews')->totalsForAllResults;
        $monthAvgSessionDuration = Analytics::performQuery($startDate, $endDate, 'ga:avgSessionDuration')->totalsForAllResults;
        $monthNewVisitors = Analytics::performQuery($startDate, $endDate, 'ga:percentNewSessions')->totalsForAllResults;

        js([
            'monthVisitorCounter' => (int)ceil(reset($monthVisitorCounter)),
            'monthPageviewCounter' => (int)ceil(reset($monthPageviewCounter)),
            'monthAvgSessionDuration' => gmdate("H:i:s", (int)ceil(reset($monthAvgSessionDuration))),
            'monthVisitorsNewPercent' => (int)ceil(reset($monthNewVisitors)),
            'monthVisitorsReturnPercent' => 100 - (int)ceil(reset($monthNewVisitors)),
        ]);

        js(['monthLabels' => array_map(function ($item) {
            return strtoupper($item['date']->format('d'));
        }, $monthAnalyticsData)]);

        js(['monthVisitors' => array_map(function ($item) {
            return $item['visitors'];
        }, $monthAnalyticsData)]);

        js(['monthPageViews' => array_map(function ($item) {
            return $item['pageViews'];
        }, $monthAnalyticsData)]);

        // Yearly analytics
        $yearAnalyticsData = Analytics::getVisitorsAndPageViews(365, 'yearMonth')->toArray();

        list($startDate, $endDate) = $this->calculateNumberOfDays(365);
        $yearVisitorCounter = Analytics::performQuery($startDate, $endDate, 'ga:users')->totalsForAllResults;
        $yearPageviewCounter = Analytics::performQuery($startDate, $endDate, 'ga:pageviews')->totalsForAllResults;
        $yearAvgSessionDuration = Analytics::performQuery($startDate, $endDate, 'ga:avgSessionDuration')->totalsForAllResults;
        $yearNewVisitors = Analytics::performQuery($startDate, $endDate, 'ga:percentNewSessions')->totalsForAllResults;

        js([
            'yearVisitorCounter' => (int)ceil(reset($yearVisitorCounter)),
            'yearPageviewCounter' => (int)ceil(reset($yearPageviewCounter)),
            'yearAvgSessionDuration' => gmdate("H:i:s", (int)ceil(reset($yearAvgSessionDuration))),
            'yearVisitorsNewPercent' => (int)ceil(reset($yearNewVisitors)),
            'yearVisitorsReturnPercent' => 100 - (int)ceil(reset($yearNewVisitors)),
        ]);

        js(['yearLabels' => array_map(function ($item) {
            return strtoupper($item['yearMonth']->format('M Y'));
        }, $yearAnalyticsData)]);

        js(['yearVisitors' => array_map(function ($item) {
            return $item['visitors'];
        }, $yearAnalyticsData)]);

        js(['yearPageViews' => array_map(function ($item) {
            return $item['pageViews'];
        }, $yearAnalyticsData)]);

        js(['active_visitors' => (int)Analytics::getActiveUsers()]);
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
