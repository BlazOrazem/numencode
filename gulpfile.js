var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

/**
 * Override some of the Elixir default configuration
 */

// Set the Assets path to project root folder
elixir.config.assetsPath = "./";

// Set the Css source folder
elixir.config.css.folder = '';

// Set the Less source folder
elixir.config.css.less.folder = '';

// Set the JavaScripts source folder
elixir.config.js.folder = '';

/**
 * Mix Elixir
 */
elixir(function(mix) {
    /**
     *  Gulp watcher for admin assets, trigger with "gulp watch".
     */
    var adminResources = 'modules/Admin/Resources/assets/';
    mix.less([
        adminResources + 'styles/app.less'
    ], './public/css/admin-app.css')
    .styles([
        '/node_modules/font-awesome/css/font-awesome.min.css',
        '/node_modules/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css',
        '/node_modules/sweetalert/dist/sweetalert.css',
        '/node_modules/metismenu/dist/metisMenu.min.css',
        '/node_modules/morris.js/morris.css'
    ], 'public/css/admin-libs.css')
    .scripts([
        adminResources + 'scripts/app.js',
        adminResources + 'scripts/morris-data.js'
    ], './public/js/admin-app.js')
    .scripts([
        '/node_modules/jquery/dist/jquery.min.js',
        '/node_modules/bootstrap-less/js/bootstrap.min.js',
        '/node_modules/sweetalert/dist/sweetalert.min.js',
        '/node_modules/metismenu/dist/metisMenu.min.js',
        '/node_modules/raphael/raphael-min.js',
        '/node_modules/morris.js/morris.min.js'
    ], './public/js/admin-libs.js');

    /**
     *  Gulp watcher for cms assets, trigger with "gulp watch".
     */
    var cmsResources = 'modules/Cms/Resources/assets/';
    mix.less([
        cmsResources + 'styles/app.less'
    ], './public/css/app.css')
    .styles([
        '/node_modules/font-awesome/css/font-awesome.min.css',
        '/node_modules/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css',
        '/node_modules/sweetalert/dist/sweetalert.css'
    ], 'public/css/libs.css')
    .scripts([
        cmsResources + 'scripts/app.js'
    ], './public/js/app.js')
    .scripts([
        '/node_modules/jquery/dist/jquery.min.js',
        '/node_modules/bootstrap-less/js/bootstrap.min.js',
        '/node_modules/sweetalert/dist/sweetalert.min.js'
    ], './public/js/libs.js');

    /**
     * Version the Css files (avoid caching issues).
     */
    mix.version([
        'public/css/admin-app.css',
        'public/css/admin-libs.css',
        'public/css/app.css',
        'public/css/libs.css'
    ]);

    /**
     * Gulp watcher for tests, trigger with "gulp tdd".
     */
    mix.phpUnit();
});
