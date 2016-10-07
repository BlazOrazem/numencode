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


<body class="fixed-all fixed-sidebar fixed-all p-blue s-blue n-blue">
<!--Preloader-->
<div id="preloader">
    <div class="refresh-preloader"><div class="preloader"><i>.</i><i>.</i><i>.</i></div></div>
</div>


<div class="wrapper">
    <nav class="navbar navbar-blue">
        <div class="navbar-header container brand-blue">
            <a href="#" class="menu-toggle"><i class="zmdi zmdi-menu"></i></a>
            <a href="index.html" class="logo"><img src="themes/admin/images/logo.png" alt="Logo Pacificonis"></a>
            <a href="index.html" class="icon-logo"></a>
        </div>
        <div class="navbar-container clearfix">
            <div class="pull-left">
                <a href="{{ Request::url() }}" class="page-title text-uppercase">@yield('title')</a>
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
                            <a href="{{ route('admin.logout') }}"><i class="zmdi zmdi-run"></i>Exit</a>
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
                        <img src="{{ $admin->avatar }}" width="86" height="86" class="img-responsive img-circle center-block" alt="{{ $admin->name }}">
                        <span class="online"></span>
                    </div>
                    <div class="profile-usertitle">
                        <div class="name">
                            {{ $admin->name }}
                        </div>
                        <div class="city">
                            <i class="zmdi zmdi-email"></i>{{ $admin->email }}
                        </div>
                    </div>
                    <div class="profile-activity clearfix"></div>
                </div>
            </li>
            <li>
                <a href="{{ route('admin.dashboard') }}"><i class="zmdi zmdi-view-dashboard"></i>Dashboard</a>
            </li>
            <li>
                <a href="#"><i class="zmdi zmdi-account"></i>Managers<span class="zmdi arrow"></span></a>
                <ul class="nav nav-inside collapse">
                    <li class="inside-title">Managers</li>
                    <li><a href="{{ route('managers.index') }}">List managers</a></li>
                    <li><a href="{{ route('managers.create') }}">Add new manager</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="zmdi zmdi-account-circle"></i>Users<span class="zmdi arrow"></span></a>
                <ul class="nav nav-inside collapse">
                    <li class="inside-title">Managers</li>
                    <li><a href="{{ route('users.index') }}">List users</a></li>
                    <li><a href="{{ route('managers.create') }}">Add new user</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ route('roles.index') }}"><i class="zmdi zmdi-lock"></i>Roles and permissions</a>
            </li>
            <li>
                <a href="{{ route('tasks.index') }}"><i class="zmdi zmdi-format-align-justify"></i>Tasks</a>
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
                        @include ('admin::pages.list', ['collection' => $pageTree['root']])
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
        @yield('content')
    </div>

    <footer class="page-footer">© {{ date('Y') }} Copyright</footer>
</div>

@include('admin::footer')

</body>
</html>