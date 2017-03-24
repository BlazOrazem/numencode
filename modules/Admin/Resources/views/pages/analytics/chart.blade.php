<div class="row">
    <div class="col-lg-12">
        <div class="content-box">
            <div class="head head-with-btns clearfix">
                <h5 class="content-title text-color pull-left">Website analytics</h5>
                <div class="functions-btns pull-right">
                    <button type="button" class="btn btn-base analytics-switch" data-period="week">
                        Week
                    </button>
                    <button type="button" class="btn btn-info analytics-switch" data-period="month">
                        Month
                    </button>
                    <button type="button" class="btn btn-info analytics-switch" data-period="year">
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