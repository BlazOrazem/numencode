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
 * Admin assets (styles and scripts)
 */

// Set the admin Assets path
var adminResources = 'modules/admin/Resources/assets/';

// Gulp watcher for admin assets, trigger with "gulp watch".
elixir(function(mix) {
    mix.less([
        adminResources + 'styles/app.less'
    ], './public/css/admin-app.css')
    .styles([
        adminResources + 'styles/libs/font-awesome.css',
        adminResources + 'styles/libs/awesome-bootstrap-checkbox.css',
        adminResources + 'styles/libs/sweetalert.css'
    ], 'public/css/admin-libs.css')
    .scripts([
        adminResources + 'scripts/app.js'
    ], './public/js/admin-app.js')
    .scripts([
        adminResources + 'scripts/libs/sweetalert.min.js'
    ], './public/js/admin-libs.js');
});

/**
 * Cms assets (styles and scripts)
 */

// Set the cms Assets path
var cmsResources = 'modules/cms/Resources/assets/';

// Gulp watcher for cms assets, trigger with "gulp watch".
elixir(function(mix) {
    mix.less([
        cmsResources + 'styles/app.less'
    ], './public/css/app.css')
    .styles([
        cmsResources + 'styles/libs/font-awesome.css',
        cmsResources + 'styles/libs/awesome-bootstrap-checkbox.css',
        cmsResources + 'styles/libs/sweetalert.css'
    ], 'public/css/libs.css')
    .scripts([
        cmsResources + 'scripts/app.js'
    ], './public/js/app.js')
    .scripts([
        cmsResources + 'scripts/libs/sweetalert.min.js'
    ], './public/js/libs.js');
});

/**
 * Version the Css files (avoid caching issues)
 */
elixir(function(mix) {
    mix.version([
        'public/css/admin-app.css',
        'public/css/admin-libs.css',
        'public/css/app.css',
        'public/css/libs.css'
    ]);
});

/**
 * Gulp watcher for tests, trigger with "gulp tdd".
 */
elixir(function(mix) {
    mix.phpUnit();
});
