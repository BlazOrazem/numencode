<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no" />

    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#49CEFF">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#49CEFF" />
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <meta name="description" content="NumencodeCMS">
    <meta name="author" content="Numencode.com">
    <meta name="_token" content="{{ csrf_token() }}">

    <title>Admin Dashboard</title>

    <base href="{{ env('app_url') }}">
    <link href="{{ elixir('themes/admin/css/app.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ elixir('themes/admin/css/common.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ elixir('themes/admin/css/libs.css') }}" rel="stylesheet" type="text/css">

    <!--
    <link rel="icon" href="img/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
    -->

    <!--[if lt IE 9]>
        <script src="themes/admin/js/html5shiv.min.js"></script>
        <script src="themes/admin/js/respond.min.js"></script>
    <![endif]-->
</head>


<body class="fixed-all fixed-sidebar fixed-all">
<!--Preloader-->
<div id="preloader">
    <div class="refresh-preloader"><div class="preloader"><i>.</i><i>.</i><i>.</i></div></div>
</div>


<div class="wrapper">
    <nav class="navbar navbar-blue">
        <div class="navbar-header container brand-blue">
            <a href="#" class="menu-toggle"><i class="zmdi zmdi-menu"></i></a>
            <a href="index.html" class="logo"><img src="themes/admin/img/logo.png" alt="Logo Pacificonis"></a>
            <a href="index.html" class="icon-logo"></a>
        </div>
        <div class="navbar-container clearfix">
            <div class="pull-left">
                <a href="#" class="page-title text-uppercase">Dashboard</a>
            </div>

            <div class="pull-right">
                <div class="pull-left search-container">
                    <form class="searchbox">
                        <input type="search" placeholder="Search" name="search" class="searchbox-input">
                        <input type="submit" class="searchbox-submit" value="">
                        <span class="searchbox-icon"><span class="zmdi zmdi-search search-icon"></span></span>
                    </form>
                </div>

                <ul class="nav pull-right right-menu">
                    <li class="more-options dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown">
                            <i class="zmdi zmdi-account-circle"></i>
                        </a>

                        <div class="more-opt-container dropdown-menu">
                            <a href="#"><i class="zmdi zmdi-account-o"></i>Account<span class="badge badge-warning">3</span></a>
                            <a href="#"><i class="zmdi zmdi-storage"></i>Storage <span class="badge badge-danger">2</span></a>
                            <a href="#"><i class="zmdi zmdi-calendar-note"></i>Calendar <span class="badge badge-success">2</span></a>
                            <a href="#"><i class="zmdi zmdi-chart-donut"></i>Analytics <span class="badge badge-success">7</span></a>
                            <a href="#"><i class="zmdi zmdi-balance"></i>Balance <span class="badge badge-info">5</span></a>
                            <a href="#"><i class="zmdi zmdi-run"></i>Exit</a>
                        </div>
                    </li>
                    <li class="notification dropdown">
                        <a class="dropdown-toggle">
                            <i class="zmdi zmdi-notifications"></i>
                            <span class="badge badge-primary">8</span>
                        </a>

                        <div class="dropdown-menu">
                            <h4 class="text-center info-color m-0">You have 19 new notifications</h4>
                            <div class="notification-container">
                                <a href="#"><i class="zmdi zmdi-email warning-color m-r-5"></i> You have 16 messages <span class="pull-right">4 minutes ago</span></a>
                                <a href="#"><i class="zmdi zmdi-twitter info-color m-r-5"></i> 3 new followers <span class="pull-right">12 minutes ago</span></a>
                                <a href="#"><i class="zmdi zmdi-dropbox info-color m-r-5"></i> 7 changed files <span class="pull-right">18 minutes ago</span></a>
                                <a href="#"><i class="zmdi zmdi-instagram warning-color m-r-5"></i> 26 new followers <span class="pull-right">22 minutes ago</span></a>
                                <a href="#"><i class="zmdi zmdi-twitter info-color m-r-5"></i> 8 new followers <span class="pull-right">23 minutes ago</span></a>
                            </div>
                            <a href="#" class="text-uppercase clear-all">Clear all notifications</a>
                            <div class="check-ok">
                                <i class="zmdi zmdi-check"></i>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a class="sidepanel-toggle" href="#">
                            <i class="zmdi zmdi-more-vert"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <aside class="sidebar sidebar-bleachedcedar">
        <ul class="nav metismenu">
            <li class="profile-sidebar-container">
                <div class="profile-sidebar text-center">
                    <div class="profile-userpic">
                        <img src="themes/admin/img/profile_user.jpg" class="img-responsive img-circle center-block" alt="user">
                        <span class="online"></span>
                    </div>
                    <div class="profile-usertitle">
                        <div class="name">
                            Marcus Doe
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <a href="#"><i class="zmdi zmdi-view-dashboard"></i>Dashboard</a>
            </li>
            <li>
                <a href="#"><i class="zmdi zmdi-account"></i>Managers<span class="zmdi arrow"></span></a>
                <ul class="nav nav-inside collapse">
                    <li class="inside-title">Managers</li>
                    <li><a href="index.html">List managers</a></li>
                    <li><a href="dashboard-2.html">Add new manager</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="zmdi zmdi-account-circle"></i>Users</a>
            </li>
            <li>
                <a href="#"><i class="zmdi zmdi-lock"></i>Roles and permissions</a>
            </li>
            <li>
                <a href="#"><i class="zmdi zmdi-format-align-justify"></i>Tasks</a>
            </li>
        </ul>
    </aside>

    <div class="side-panel">
        <ul class="nav nav-tabs nav-justified m-0">
            <li class="active">
                <a href="#tab-side-1" data-toggle="tab"><i class="zmdi zmdi-comment-text"></i></a>
            </li>
            <li>
                <a href="#tab-side-2" data-toggle="tab"><i class="zmdi zmdi-settings"></i></a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="tab-side-1">
                <div class="side-title">Page Structure</div>
                <div class="p-15">

                    <div id="jstree">
                        <ul>
                            <li data-jstree='{"type":"folder"}'>Home
                                <ul>
                                    <li data-jstree='{"type":"folder"}'>Email
                                        <ul>
                                            <li>Inbox</li>
                                            <li>Compose</li>
                                            <li data-jstree='{"type":"folder"}'>View
                                                <ul>
                                                    <li><a href="#">Email One</a></li>
                                                    <li>Email Two</li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>Dashboard</li>
                                    <li>Typography</li>
                                    <li data-jstree='{"type":"folder"}'>User Interface
                                        <ul>
                                            <li>Buttons</li>
                                            <li>Checkboxes</li>
                                            <li>Radios</li>
                                        </ul>
                                    </li>
                                    <li>Pages</li>
                                    <li data-jstree='{"type":"folder"}'>Forms
                                        <ul>
                                            <li>Form Elements</li>
                                            <li>Form Components</li>
                                            <li>Form Examples</li>
                                        </ul>
                                    </li>
                                    <li>Tables</li>
                                    <li>Widgets</li>
                                </ul>
                            </li>
                            <li data-jstree='{"type":"new"}'>Settings</li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="tab-pane fade" id="tab-side-2">
                <table class="table table-settings">
                    <tbody><tr>
                        <td>
                            <h5>Alerts</h5>
                            <p>Sets alerts to get notified when changes occur to get new alerming items</p>
                        </td>
                        <td><div class="checkbox checkbox-primary">
                                <label><input type="checkbox">
                                    <i></i></label>
                            </div></td>
                    </tr>
                    <tr>
                        <td>
                            <h5>Notifications</h5>
                            <p>You will receive notification email for any notifications if you set notification</p>
                        </td>
                        <td>
                            <div class="checkbox checkbox-primary">
                                <label><input type="checkbox" checked>
                                    <i></i></label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5>Messages</h5>
                            <p>You will receive notification on email after setting messages notifications</p>
                        </td>
                        <td>
                            <div class="checkbox checkbox-primary">
                                <label><input type="checkbox">
                                    <i></i></label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5>Warnings</h5>
                            <p>You will get warnning only some specific setttings or alert system</p>
                        </td>
                        <td>
                            <div class="checkbox checkbox-primary">
                                <label><input type="checkbox" checked>
                                    <i></i></label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5>Sidebar</h5>
                            <p>You can hide/show use with sidebar collapsw settings</p>
                        </td>
                        <td>
                            <div class="checkbox checkbox-primary">
                                <label><input type="checkbox" checked>
                                    <i></i></label>
                            </div>
                        </td>
                    </tr>

                    </tbody></table>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="content-box">
                    <div class="head head-with-btns clearfix">
                        <h5 class="content-title text-color pull-left">Total sales statistics</h5>
                        <div class="functions-btns pull-right">
                            <button type="button" class="btn btn-info">
                                Week
                            </button>
                            <button type="button" class="btn btn-warning">
                                Month
                            </button>
                            <button type="button" class="btn btn-warning">
                                Year
                            </button>
                        </div>
                    </div>
                    <div class="content">
                        <div id="js-legend" class="chart-legend"></div>
                        <div class="chartjs-container full-page-chart">
                            <canvas id="chart-line"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="content-box warning-bg white">
                    <div class="head clearfix">
                        <h5 class="content-title pull-left">Orders</h5>
                        <div class="functions-btns pull-right">
                            <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                            <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                            <a class="close-btn" href="#"><i class="zmdi zmdi-close"></i></a>
                        </div>
                    </div>
                    <div class="content">
                        <div id="line-chart-3" class="flot-chart"></div>
                        <p class="text-uppercase zero-m">Total orders</p>
                        <p class="zero-m f-30">45,245,659</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="content-box">
                    <div class="head clearfix">
                        <h5 class="content-title text-color pull-left">Implementation of a plan</h5>
                        <div class="functions-btns pull-right">
                            <a class="refresh-btn text-color" href="#"><i class="zmdi zmdi-refresh"></i></a>
                            <a class="fullscreen-btn text-color" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                            <a class="close-btn text-color" href="#"><i class="zmdi zmdi-close"></i></a>
                        </div>
                    </div>
                    <div class="p-l-20">
                        <button type="button" class="btn btn-info m-b-5">
                            Week
                        </button>
                        <button type="button" class="btn btn-warning m-b-5">
                            Month
                        </button>
                    </div>
                    <div class="content">
                        <div class="easychart text-right" data-percent="55"></div>
                        <div class="p-absolute b-20 l-20">
                            <p class="text-uppercase zero-m">Profit</p>
                            <p class="zero-m danger-color f-30">254,395</p>
                        </div>
                    </div>
                    <!-- Used for demo purposes. Remove if it is needed-->
                    <div class="visible-lg visible-md" style="height: 6px;"></div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="content-box success-bg white">
                    <div class="head clearfix">
                        <h5 class="content-title pull-left">Visitors</h5>
                        <div class="functions-btns pull-right">
                            <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                            <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                            <a class="close-btn" href="#"><i class="zmdi zmdi-close"></i></a>
                        </div>
                    </div>
                    <div class="content">
                        <div id="line-chart-4" class="flot-chart"></div>
                        <p class="text-uppercase zero-m">Total visitors</p>
                        <p class="zero-m f-30">15,654,700</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="content-box info-bg white">
                    <div class="head clearfix">
                        <h5 class="content-title pull-left">Returns</h5>
                        <div class="functions-btns pull-right">
                            <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                            <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                            <a class="close-btn" href="#"><i class="zmdi zmdi-close"></i></a>
                        </div>
                    </div>
                    <div class="content">
                        <div id="line-chart-2" class="flot-chart"></div>
                        <p class="text-uppercase zero-m">Total returns</p>
                        <p class="zero-m f-30">573,935</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="page-footer">© 2016 Copyright</footer>
</div>


<script src="{{ elixir('themes/admin/js/libs.js') }}"></script>

<script>
    var randomScalingFactor = function(){ return Math.round(Math.random()*100)};

    var lineChartData = {
        labels : ["MONDAY","TUESDAY","WEDNESDAY","THURSDAY","FRIDAY","SATURDAY","SUNDAY"],
        datasets : [
            {
                label: "Mens goods",
                fillColor : "rgba(73, 206, 255, 0.5)",
                strokeColor : "rgba(73, 206, 255, 0.7)",
                pointColor : "rgba(73, 206, 255, 0.9)",
                pointStrokeColor : "#fff",
                pointHighlightFill : "rgba(255, 193, 7, 1)",
                data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
            },
            {
                label: "Women goods",
                fillColor : "rgba(255, 187, 51, 0.5)",
                strokeColor : "rgba(255, 187, 51, 0.7)",
                pointColor : "rgba(255, 187, 51, 0.9)",
                pointStrokeColor : "#fff",
                pointHighlightFill : "rgba(244, 67, 54, 1)",
                data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
            },
            {
                label: "Children goods",
                fillColor : "rgba(153, 204, 0, 0.5)",
                strokeColor : "rgba(153, 204, 0, 0.7)",
                pointColor : "rgba(153, 204, 0, 0.9)",
                pointStrokeColor : "#fff",
                pointHighlightFill : "rgba(33, 150, 243, 1)",
                data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
            }
        ]

    }

    window.onload = function(){
        var ctx = document.getElementById("chart-line").getContext("2d");
        var myLine = new Chart(ctx).Line(lineChartData, {
            scaleShowVerticalLines: false,
//        scaleShowLabels: false,
//        maintainAspectRatio: true,
            datasetStrokeWidth : 6,
            pointDotRadius : 6,
            responsive: true,
            legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].pointColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
        });

        document.getElementById('js-legend').innerHTML = myLine.generateLegend();
    }

</script>

<script>
    $(function () {
        /* Make some random data for the Chart*/

        var d1 = [];
        for (var i = 0; i <= 10; i += 1) {
            d1.push([i, parseInt(Math.random() * 100)]);
        }

        var d2 = [];
        for (var i = 0; i <= 10; i += 1) {
            d2.push([i, parseInt(Math.random() * 100)]);
        }

        var d3 = [];
        for (var i = 0; i <= 10; i += 1) {
            d3.push([i, parseInt(Math.random() * 100)]);
        }

        var d4 = [];
        for (var i = 0; i <= 50; i += 1) {
            d4.push([i, parseInt(Math.random() * 100)]);
        }

        /* Chart Options */

        var options = {
            series: {
                shadowSize: 0,
                label: "Qty",
                lines: {
                    show: true,
                    lineWidth: 2
                },
                points: {
                    show: true
                }
            },
            grid: {
                margin: 10,
                show: false,
                hoverable: true,
                clickable: true
            },
            yaxis: {
                max: 100,
                min: 0
            },
            legend: {
                show: false
            },
            tooltip: {
                show: true,
                cssClass: "flot-tooltip",
                defaultTheme: false,
                content: '%y.2',
                shifts: {
                    x: 1,
                    y: -45
                }
            }
        };

        var options2 = {
            series: {
                shadowSize: 5,
                label: "Qty",
                lines: {
                    show: true,
                    lineWidth: 2
                }
            },
            grid: {
                margin: 10,
                show: false,
                hoverable: true,
                clickable: false
            },
            legend: {
                show: false
            },
            tooltip: {
                show: true,
                cssClass: "flot-tooltip",
                defaultTheme: false,
                content: '%y.2',
                shifts: {
                    x: 1,
                    y: -45
                }
            }
        };


        /* Let's create the chart */
        if ($("#line-chart-2")[0]) {
            $.plot($("#line-chart-2"), [
                {data: d2, color: '#fff' }
            ], options);
        }

        if ($("#line-chart-3")[0]) {
            $.plot($("#line-chart-3"), [
                {data: d3, color: '#fff' }
            ], options);
        }

        if ($("#line-chart-4")[0]) {
            $.plot($("#line-chart-4"), [
                {data: d4, color: '#fff' }
            ], options2);
        }

    });
</script>

<script>
    $(function() {
        $('.easychart').easyPieChart({
            barColor: "#F44336",
            trackColor: '#cccccc',
            size: 115,
            lineWidth: 15,
            scaleLength: 0
        });
    });
</script>

<script>


    //Todo
    $(document).on('mouseover', '.list-group .checkbox', function () {
        $('.list-group input:checkbox').each(function () {
            $(this).on("change", function () {
                if ($(this).is(":checked")) {
                    $(this).closest(".list-group-item").addClass("checked-todo").removeClass("list-item");
                } else {
                    $(this).closest(".list-group-item").removeClass("checked-todo");
                }
            });
        });
    });

    $(document).on('click', '.trash', function (e) {
        var clearedCompItem = $(this).closest(".list-group-item").remove();
        e.preventDefault();
    });
</script>

<script src="{{ elixir('themes/admin/js/common.js') }}"></script>

<script>
    if($(window).width() >= 1440){
        $(".side-panel").addClass("open");
        $(".sidepanel-toggle").parent().addClass("open");
        $("body").addClass("small-content");
    }
    else{
        $(".side-panel").removeClass("open");
        $(".sidepanel-toggle").parent().removeClass("open");
        $("body").removeClass("fixed-sidebar-example small-content");
    }

    $(window).resize(function(){
        if($(window).width() >= 1440){
            $(".side-panel").addClass("open");
            $(".sidepanel-toggle").parent().addClass("open");
            $("body").addClass("fixed-sidebar-example small-content");
        }
        else{
            $(".side-panel").removeClass("open");
            $(".sidepanel-toggle").parent().removeClass("open");
            $("body").removeClass("fixed-sidebar-example small-content");
        }
    });

</script>

<script src="{{ elixir('themes/admin/js/app.js') }}"></script>


{{--@include('admin::footer')--}}

</body>
</html>