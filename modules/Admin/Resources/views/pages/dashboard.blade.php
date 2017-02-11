@extends('admin::layout')

@section('title')
    Dashboard
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="content-box">
                <div class="head head-with-btns clearfix">
                    <h5 class="content-title text-color pull-left">Website analytics</h5>
                    <div class="functions-btns pull-right">
                        <button type="button" class="btn btn-info analytics-switch" data-period="week">
                            Week
                        </button>
                        <button type="button" class="btn btn-warning analytics-switch" data-period="month">
                            Month
                        </button>
                        <button type="button" class="btn btn-warning analytics-switch" data-period="year">
                            Year
                        </button>
                    </div>
                </div>
                <div class="content analytics-chart analytics-week">
                    <div class="chart-legend chart-legend-week"></div>
                    <div class="chartjs-container full-page-chart">
                        <canvas class="chart-line-week"></canvas>
                    </div>
                </div>
                <div class="content analytics-chart analytics-month" style="display: none;">
                    <div class="chart-legend chart-legend-month"></div>
                    <div class="chartjs-container full-page-chart">
                        <canvas class="chart-line-month"></canvas>
                    </div>
                </div>
                <div class="content analytics-chart analytics-year" style="display: none;">
                    <div class="chart-legend chart-legend-year"></div>
                    <div class="chartjs-container full-page-chart">
                        <canvas class="chart-line-year"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="content-box p-20 base-bg white f-s-16 text-center">
                <div>
                    <p>Logged in as<br /><strong>{{ $admin->name }}</strong></p>
                    <span class="current-date"></span>
                </div>
                <span class="time" style="font-size: 50px; font-weight: 400; letter-spacing: 0; margin-top: 27px; line-height: 50px;"></span>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="content-box">
                <div class="head clearfix">
                    <h5 class="content-title text-color text-center" style="width: 100%;">Website visitors</h5>
                </div>
                <div class="content">
                    <div class="visitors-chart text-right" data-percent="0"></div>
                    <div class="p-absolute t-50 l-20">
                        <p class="zero-m">New visitors</p>
                        <p class="zero-m success-color f-20 visitorsNew">0%</p>
                    </div>
                    <div class="p-absolute b-20 l-20">
                        <p class="zero-m">Returning<br />visitors</p>
                        <p class="zero-m base-color f-20 visitorsReturn">0%</p>
                    </div>
                </div>
                <div class="visible-lg visible-md" style="height: 6px;"></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="content-box success-bg white text-center">
                <div class="head clearfix">
                    <h5 class="content-title" style="width: 100%;">Website statistics</h5>
                </div>
                <div class="content" style="padding-top: 12px;">
                    <p class="text-uppercase zero-m">Visitors</p>
                    <p class="f-30 visitorCounter">0</p>
                    <p class="text-uppercase zero-m">Pageviews</p>
                    <p class="zero-m f-30 pageviewCounter">0</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="content-box info-bg white text-center">
                <div class="head clearfix">
                    <h5 class="content-title" style="width: 100%;">Website traffic</h5>
                </div>
                <div class="content" style="padding-top: 12px;">
                    <p class="text-uppercase zero-m">Average session duration</p>
                    <p class="f-30 avgSessionDuration">0</p>
                    <p class="text-uppercase zero-m">Currently active visiors</p>
                    <p class="zero-m f-30">{{ $activeVisitors }}</p>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        // Google Analytics data
        var weekLineChartData = {
            labels : vars.weekLabels,
            datasets : [
                {
                    label: "Page views",
                    fillColor : "rgba(153, 204, 0, 0.5)",
                    strokeColor : "rgba(153, 204, 0, 0.7)",
                    pointColor : "rgba(153, 204, 0, 0.9)",
                    pointStrokeColor : "#fff",
                    pointHighlightFill : "rgba(33, 150, 243, 1)",
                    data : vars.weekPageViews
                },
                {
                    label: "Visitors",
                    fillColor : "rgba(73, 206, 255, 0.5)",
                    strokeColor : "rgba(73, 206, 255, 0.7)",
                    pointColor : "rgba(73, 206, 255, 0.9)",
                    pointStrokeColor : "#fff",
                    pointHighlightFill : "rgba(255, 193, 7, 1)",
                    data : vars.weekVisitors
                }
            ]
        }

        var monthLineChartData = {
            labels : vars.monthLabels,
            datasets : [
                {
                    label: "Page views",
                    fillColor : "rgba(153, 204, 0, 0.5)",
                    strokeColor : "rgba(153, 204, 0, 0.7)",
                    pointColor : "rgba(153, 204, 0, 0.9)",
                    pointStrokeColor : "#fff",
                    pointHighlightFill : "rgba(33, 150, 243, 1)",
                    data : vars.monthPageViews
                },
                {
                    label: "Visitors",
                    fillColor : "rgba(73, 206, 255, 0.5)",
                    strokeColor : "rgba(73, 206, 255, 0.7)",
                    pointColor : "rgba(73, 206, 255, 0.9)",
                    pointStrokeColor : "#fff",
                    pointHighlightFill : "rgba(255, 193, 7, 1)",
                    data : vars.monthVisitors
                }
            ]
        }

        var yearLineChartData = {
            labels : vars.yearLabels,
            datasets : [
                {
                    label: "Page views",
                    fillColor : "rgba(153, 204, 0, 0.5)",
                    strokeColor : "rgba(153, 204, 0, 0.7)",
                    pointColor : "rgba(153, 204, 0, 0.9)",
                    pointStrokeColor : "#fff",
                    pointHighlightFill : "rgba(33, 150, 243, 1)",
                    data : vars.yearPageViews
                },
                {
                    label: "Visitors",
                    fillColor : "rgba(73, 206, 255, 0.5)",
                    strokeColor : "rgba(73, 206, 255, 0.7)",
                    pointColor : "rgba(73, 206, 255, 0.9)",
                    pointStrokeColor : "#fff",
                    pointHighlightFill : "rgba(255, 193, 7, 1)",
                    data : vars.yearVisitors
                }
            ]
        }

        window.onload = function(){
            var ctxWeek = $('.chart-line-week')[0].getContext("2d");
            var myLineWeek = new Chart(ctxWeek).Line(weekLineChartData, {
                scaleShowVerticalLines: false,
                scaleShowLabels: true,
                datasetStrokeWidth : 6,
                pointDotRadius : 6,
                responsive: true,
                legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].pointColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
            });
            $('.chart-legend-week').html(myLineWeek.generateLegend());
            $('.visitorCounter').html(vars.weekVisitorCounter);
            $('.pageviewCounter').html(vars.weekPageviewCounter);
            $('.avgSessionDuration').html(vars.weekAvgSessionDuration);
            $('.visitorsNew').html(vars.weekVisitorsNewPercent + '%');
            $('.visitorsReturn').html(vars.weekVisitorsReturnPercent + '%');
            $('.visitors-chart').data('easyPieChart').update(vars.weekVisitorsNewPercent);
        }

        // Analytics switch
        $('.analytics-switch').on("click", function () {
            $('.analytics-switch').each(function(index) {
                if ($(this).hasClass('btn-info')) {
                    $(this).removeClass('btn-info');
                }
                if (!$(this).hasClass('btn-warning')) {
                    $(this).addClass('btn-warning');
                }
            });

            $(this).removeClass('btn-warning').addClass('btn-info');

            $('div.analytics-chart').hide();

            $('div.analytics-chart.analytics-'+ $(this).data('period')).show();

            if ($(this).data('period') == 'week') {
                var ctxWeek = $('.chart-line-week')[0].getContext("2d");
                var myLineWeek = new Chart(ctxWeek).Line(weekLineChartData, {
                    scaleShowVerticalLines: false,
                    scaleShowLabels: true,
                    datasetStrokeWidth : 6,
                    pointDotRadius : 6,
                    responsive: true,
                    legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].pointColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
                });
                $('.chart-legend-week').html(myLineWeek.generateLegend());
                $('.visitorCounter').html(vars.weekVisitorCounter);
                $('.pageviewCounter').html(vars.weekPageviewCounter);
                $('.avgSessionDuration').html(vars.weekAvgSessionDuration);
                $('.visitorsNew').html(vars.weekVisitorsNewPercent + '%');
                $('.visitorsReturn').html(vars.weekVisitorsReturnPercent + '%');
                $('.visitors-chart').data('easyPieChart').update(vars.weekVisitorsNewPercent);
            }

            if ($(this).data('period') == 'month') {
                var ctxMonth = $('.chart-line-month')[0].getContext("2d");
                var myLineMonth = new Chart(ctxMonth).Line(monthLineChartData, {
                    scaleShowVerticalLines: false,
                    scaleShowLabels: true,
                    datasetStrokeWidth : 6,
                    pointDotRadius : 6,
                    responsive: true,
                    legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].pointColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
                });
                $('.chart-legend-month').html(myLineMonth.generateLegend());
                $('.visitorCounter').html(vars.monthVisitorCounter);
                $('.pageviewCounter').html(vars.monthPageviewCounter);
                $('.avgSessionDuration').html(vars.monthAvgSessionDuration);
                $('.visitorsNew').html(vars.monthVisitorsNewPercent + '%');
                $('.visitorsReturn').html(vars.monthVisitorsReturnPercent + '%');
                $('.visitors-chart').data('easyPieChart').update(vars.monthVisitorsNewPercent);
            }

            if ($(this).data('period') == 'year') {
                var ctxYear = $('.chart-line-year')[0].getContext("2d");
                var myLineYear = new Chart(ctxYear).Line(yearLineChartData, {
                    scaleShowVerticalLines: false,
                    scaleShowLabels: true,
                    datasetStrokeWidth : 6,
                    pointDotRadius : 6,
                    responsive: true,
                    legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].pointColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
                });
                $('.chart-legend-year').html(myLineYear.generateLegend());
                $('.visitorCounter').html(vars.yearVisitorCounter);
                $('.pageviewCounter').html(vars.yearPageviewCounter);
                $('.avgSessionDuration').html(vars.yearAvgSessionDuration);
                $('.visitorsNew').html(vars.yearVisitorsNewPercent + '%');
                $('.visitorsReturn').html(vars.yearVisitorsReturnPercent + '%');
                $('.visitors-chart').data('easyPieChart').update(vars.yearVisitorsNewPercent);
            }
        });

        // Visitors
        $(function() {
            $('.visitors-chart').easyPieChart({
                barColor: "#99cc00",
                trackColor: '#49ceff',
                size: 115,
                lineWidth: 15,
                scaleLength: 0
            });
        });
    </script>
@endsection