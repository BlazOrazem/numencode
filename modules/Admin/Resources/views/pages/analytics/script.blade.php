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
            if ($(this).hasClass('btn-base')) {
                $(this).removeClass('btn-base');
            }
            if (!$(this).hasClass('btn-info')) {
                $(this).addClass('btn-info');
            }
        });

        $(this).removeClass('btn-info').addClass('btn-base');

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
            trackColor: '#2196f3',
            size: 115,
            lineWidth: 15,
            scaleLength: 0
        });

        if (typeof vars.active_visitors != 'undefined') {
            $('.activeVisitors').html(vars.active_visitors);
        }
    });
</script>