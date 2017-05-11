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
    <link href="{{ elixir('themes/admin/css/libs.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ elixir('themes/admin/css/jstree.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ elixir('themes/admin/css/app.css') }}" rel="stylesheet" type="text/css">

    <link rel="icon" href="themes/admin/images/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="themes/admin/images/favicon.ico" type="image/x-icon" />

    <!--[if lt IE 9]>
        <script src="themes/admin/js/html5shiv.min.js"></script>
        <script src="themes/admin/js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="fixed-all fixed-sidebar p-blue s-blue n-blue">

<!--Preloader-->
<div id="preloader">
    <div class="refresh-preloader"><div class="preloader"><i>.</i><i>.</i><i>.</i></div></div>
</div>

<div class="wrapper">
    <nav class="navbar navbar-blue">
        <div class="navbar-header container brand-blue">
            <a href="#" class="menu-toggle"><i class="zmdi zmdi-menu"></i></a>
            <a href="{{ route('admin.dashboard') }}" class="logo">numencode<sup>&trade;</sup></a>
            <a href="{{ route('admin.dashboard') }}" class="icon-logo"></a>
        </div>
        <div class="navbar-container clearfix">
            <div class="pull-left">
                <a href="{{ Request::url() }}" class="page-title">@yield('title')</a>
            </div>

            <div class="pull-right">
                <div class="pull-left search-container">
                    <form class="searchbox">
                        <input type="search" placeholder="Search" name="search" class="searchbox-input">
                        <input type="submit" class="searchbox-submit" value="">
                        <span class="searchbox-icon"><span class="zmdi zmdi-search search-icon"></span></span>
                    </form>
                </div>

                <div class="pull-left language-container" id="js-languages">
                    <languages route="{{ route('admin.language') }}" inline-template>
                        <div class="languagebox">
                            <select v-on:change="changed" name="language_locale" v-model="selected.language_locale" class="form-control selectpicker languagebox-select">
                                <option v-for="language in languages" :value="language.locale">@{{ language.label }}</option>
                            </select>
                        </div>
                    </languages>
                </div>

                <ul class="nav pull-right right-menu">
                    <li class="more-options dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown">
                            <i class="zmdi zmdi-account-circle"></i>
                        </a>
                        <div class="more-opt-container dropdown-menu">
                            <a href="{{ route('admin.dashboard') }}"><i class="zmdi zmdi-view-dashboard"></i>Dashboard</a>
                            <a href="{{ route('managers.profile') }}"><i class="zmdi zmdi-account-o"></i>Account</a>
                            <a href="{{ get_route('home') }}" target="_blank"><i class="zmdi zmdi-view-web"></i>Website</a>
                            <a href="{{ route('log.viewer') }}" target="_blank"><i class="zmdi zmdi-developer-board"></i>Log Viewer</a>
                            <a href="#" class="swal-info"><i class="zmdi zmdi-info-outline"></i>About</a>
                            <a href="{{ route('admin.logout') }}" class="btn-logout"><i class="zmdi zmdi-power"></i>Logout</a>
                        </div>
                    </li>
                    {{--
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
                    --}}
                    <li>
                        <a href="{{ route('admin.logout') }}" class="btn-logout">
                            <i class="zmdi zmdi-power"></i>
                        </a>
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

    @include('admin::navigation')

    <div class="side-panel">
        <ul class="nav nav-tabs nav-justified m-0">
            @foreach($menus as $menu)
                <li class="{{ $loop->first ? 'active' : '' }}">
                    <a href="#tab-side-{{ $menu->id }}" data-toggle="tab">
                        <i class="zmdi zmdi-menu"></i>
                        <span class="subtitle">{{ $menu->title }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
        <div class="tab-content">
            @foreach($menus as $menu)
                <div class="tab-pane fade {{ $loop->first ? 'in active' : '' }}" id="tab-side-{{ $menu->id }}">
                    <div class="side-title">{{ $menu->title }}</div>
                    <div class="p-15">
                        <div class="jstree">
                            @include('admin::menus.list', ['collection' => $menu->tree['root'], 'menu' => $menu->tree])
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="container-fluid">
        @yield('content')
    </div>
</div>

@include('admin::footer')

<script>
    Vue.component('languages', {
        props: ['route'],
        data: function() {
            return {
                languages: vars.all_languages,
                selected: {
                    language_locale: vars.selected_language
                }
            }
        },
        methods: {
            changed: function() {
                http.postHtml(this.route, {language: this.selected.language_locale})
                    .success(function() {
                        location.reload();
                    });
            }
        }
    });

    new Vue({
        el: '#js-languages'
    });

    $(".swal-info").on("click", function (e) {
        e.preventDefault();
        swal({
            title: "Numencode CMS",
            text: "Numencode is a web application, based on Laravel framework 5.4, that allows publishing, editing and modifying content, organizing, deleting as well as maintenance from a central interface. Numencode was created by and is maintained by Blaz Orazem.",
            html: true,
            confirmButtonClass: 'btn-base'
        });
    });
</script>

</body>
</html>