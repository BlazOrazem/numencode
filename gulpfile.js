var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |w
 */

elixir(function(mix) {
    /**
     * Gulp watcher for styles and scripts, trigger with "gulp watch"
     */
    mix.less('app.less')
        .styles([
            'libs/font-awesome.css',
            'libs/awesome-bootstrap-checkbox.css',
            'libs/sweetalert.css'
        ], 'public/css/libs.css')
        .scripts([
            'libs/sweetalert.min.js'
        ], './public/js/libs.js')
        .version([
            'public/css/app.css',
            'public/css/libs.css'
        ]);

    /**
     * Gulp watcher for tests, trigger with "gulp tdd".
     */
    mix.phpUnit();
});