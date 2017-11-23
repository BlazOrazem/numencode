<?php

namespace Admin\Repositories;

use Analytics;
use Spatie\Analytics\Period;

class DashboardRepository
{
    public function loadAnalytics()
    {
        // Weekly analytics
        $weekAnalyticsData = Analytics::fetchTotalVisitorsAndPageViews(Period::days(7))->toArray();
        $weekVisitorCounter = Analytics::performQuery(Period::days(7), 'ga:users')->totalsForAllResults;
        $weekPageviewCounter = Analytics::performQuery(Period::days(7), 'ga:pageviews')->totalsForAllResults;
        $weekAvgSessionDuration = Analytics::performQuery(Period::days(7), 'ga:avgSessionDuration')->totalsForAllResults;
        $weekNewVisitors = Analytics::performQuery(Period::days(7), 'ga:percentNewSessions')->totalsForAllResults;

        js([
            'weekVisitorCounter'        => (int)ceil(reset($weekVisitorCounter)),
            'weekPageviewCounter'       => (int)ceil(reset($weekPageviewCounter)),
            'weekAvgSessionDuration'    => gmdate("H:i:s", (int)ceil(reset($weekAvgSessionDuration))),
            'weekVisitorsNewPercent'    => (int)ceil(reset($weekNewVisitors)),
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
        $monthAnalyticsData = Analytics::fetchTotalVisitorsAndPageViews(Period::months(1))->toArray();
        $monthVisitorCounter = Analytics::performQuery(Period::months(1), 'ga:users')->totalsForAllResults;
        $monthPageviewCounter = Analytics::performQuery(Period::months(1), 'ga:pageviews')->totalsForAllResults;
        $monthAvgSessionDuration = Analytics::performQuery(Period::months(1), 'ga:avgSessionDuration')->totalsForAllResults;
        $monthNewVisitors = Analytics::performQuery(Period::months(1), 'ga:percentNewSessions')->totalsForAllResults;

        js([
            'monthVisitorCounter'        => (int)ceil(reset($monthVisitorCounter)),
            'monthPageviewCounter'       => (int)ceil(reset($monthPageviewCounter)),
            'monthAvgSessionDuration'    => gmdate("H:i:s", (int)ceil(reset($monthAvgSessionDuration))),
            'monthVisitorsNewPercent'    => (int)ceil(reset($monthNewVisitors)),
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
        $yearAnalyticsData = Analytics::fetchTotalVisitorsAndPageViews(Period::years(1))->toArray();
        $yearVisitorCounter = Analytics::performQuery(Period::years(1), 'ga:users')->totalsForAllResults;
        $yearPageviewCounter = Analytics::performQuery(Period::years(1), 'ga:pageviews')->totalsForAllResults;
        $yearAvgSessionDuration = Analytics::performQuery(Period::years(1), 'ga:avgSessionDuration')->totalsForAllResults;
        $yearNewVisitors = Analytics::performQuery(Period::years(1), 'ga:percentNewSessions')->totalsForAllResults;

        js([
            'yearVisitorCounter'        => (int)ceil(reset($yearVisitorCounter)),
            'yearPageviewCounter'       => (int)ceil(reset($yearPageviewCounter)),
            'yearAvgSessionDuration'    => gmdate("H:i:s", (int)ceil(reset($yearAvgSessionDuration))),
            'yearVisitorsNewPercent'    => (int)ceil(reset($yearNewVisitors)),
            'yearVisitorsReturnPercent' => 100 - (int)ceil(reset($yearNewVisitors)),
        ]);

        js(['yearLabels' => array_values(array_unique(array_map(function ($item) {
            return strtoupper($item['date']->format('M Y'));
        }, $yearAnalyticsData)))]);

        $yearVisitors = $yearPageViews = [];
        foreach ($yearAnalyticsData as $item) {
            $yearVisitors[$item['date']->format('M Y')] = isset($yearVisitors[$item['date']->format('M Y')]) ? $yearVisitors[$item['date']->format('M Y')] : 0;
            $yearVisitors[$item['date']->format('M Y')] += $item['visitors'];

            $yearPageViews[$item['date']->format('M Y')] = isset($yearPageViews[$item['date']->format('M Y')]) ? $yearPageViews[$item['date']->format('M Y')] : 0;
            $yearPageViews[$item['date']->format('M Y')] += $item['pageViews'];
        }

        js(['yearVisitors' => array_values($yearVisitors)]);

        js(['yearPageViews' => array_values($yearPageViews)]);

        js(['active_visitors' => (int)Analytics::getAnalyticsService()->data_realtime->get('ga:' . env('ANALYTICS_VIEW_ID'), 'rt:activeVisitors')->totalsForAllResults['rt:activeVisitors']]);
    }
}
