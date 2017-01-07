<div id="js-legend" class="chart-legend"></div>
<div class="chartjs-container full-page-chart">
    <canvas id="chart-line"></canvas>
</div>

<script>
    $(document).ready(function() {
    // Google Analytics data
    var lineChartData = {
        labels : vars.weekDays,
        datasets : [
            {
                label: "Page views",
                fillColor : "rgba(153, 204, 0, 0.5)",
                strokeColor : "rgba(153, 204, 0, 0.7)",
                pointColor : "rgba(153, 204, 0, 0.9)",
                pointStrokeColor : "#fff",
                pointHighlightFill : "rgba(33, 150, 243, 1)",
                data : vars.pageViews
            },
            {
                label: "Visitors",
                fillColor : "rgba(73, 206, 255, 0.5)",
                strokeColor : "rgba(73, 206, 255, 0.7)",
                pointColor : "rgba(73, 206, 255, 0.9)",
                pointStrokeColor : "#fff",
                pointHighlightFill : "rgba(255, 193, 7, 1)",
                data : vars.visitors
            }
        ]

    }

    window.onload = function(){
        var ctx = document.getElementById("chart-line").getContext("2d");
        var myLine = new Chart(ctx).Line(lineChartData, {
            scaleShowVerticalLines: false,
            scaleShowLabels: true,
            datasetStrokeWidth : 6,
            pointDotRadius : 6,
            responsive: true,
            legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].pointColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
        });

        document.getElementById('js-legend').innerHTML = myLine.generateLegend();
    }

    });
</script>