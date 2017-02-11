var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Configuration
 |--------------------------------------------------------------------------
 |
 | Override some of the Elixir default configuration.
 |
 */

/* Set the Assets path to project root folder */
elixir.config.assetsPath = "./";

/* Set the Css source folder */
elixir.config.css.folder = '';

/* Set the Less source folder */
elixir.config.css.less.folder = '';

/* Set the Sass source folder */
elixir.config.css.sass.folder = '';

/* Set the JavaScripts source folder */
elixir.config.js.folder = '';

/* Source maps should be available */
elixir.config.sourcemaps = true;

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix the Elixir.
 |
 */
elixir(function(mix) {

    /*
     |--------------------------------------------------------------------------
     | Admin Assets
     |--------------------------------------------------------------------------
     |
     | Gulp watcher for admin assets, trigger with "gulp watch".
     |
     */

    var publicPath = '../../../../../public/themes/admin/';

    /*
     |--------------------------------------------------------------------------
     | Application Styles and Scripts
     |--------------------------------------------------------------------------
     */
    mix.sass([
        '../sass/style.scss'
    ], publicPath + 'css/app.css');

    //mix.scripts([
    //    '../js/http.js',
    //    '../js/app.js',
    //    '../js/form.js',
    //    '../js/init.js'
    //], publicPath + 'js/app.js');

    /*
     |--------------------------------------------------------------------------
     | CSS Libraries
     |--------------------------------------------------------------------------
     */
    //mix.less([
    //    '../jstree/style.less'
    //], publicPath + 'css/jstree.css')
    //.styles([
    //    'bower_components/bootstrap/dist/css/bootstrap.min.css',
    //    'bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css',
    //    'bower_components/animate.css/animate.min.css',
    //    'bower_components/metisMenu/dist/metisMenu.min.css',
    //    'bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css',
    //    'bower_components/Waves/dist/waves.min.css',
    //    'bower_components/toastr/toastr.css',
    //    'bower_components/DataTables/media/css/jquery.dataTables.min.css',
    //    'bower_components/bootstrap-select/dist/css/bootstrap-select.css',
    //    'bower_components/bootstrap-sweetalert/lib/sweet-alert.css'
    //], publicPath + 'css/libs.css');

    /*
     |--------------------------------------------------------------------------
     | Javascript Libraries
     |--------------------------------------------------------------------------
     */
    //mix.scripts([
    //    'bower_components/jquery/dist/jquery.min.js',
    //    'bower_components/bootstrap/dist/js/bootstrap.min.js',
    //    'bower_components/vue/dist/vue.js',
    //    'bower_components/vue-resource/dist/vue-resource.js',
    //    'bower_components/metisMenu/dist/metisMenu.min.js',
    //    'bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.js',
    //    'bower_components/Waves/dist/waves.min.js',
    //    'bower_components/toastr/toastr.js',
    //    'bower_components/datatables/media/js/jquery.dataTables.min.js',
    //    'bower_components/datatables.net-responsive/js/dataTables.responsive.js',
    //    'bower_components/moment/min/moment.min.js',
    //    'bower_components/Chart.js/Chart.js',
    //    'bower_components/flot/jquery.flot.js',
    //    'bower_components/flot/jquery.flot.resize.js',
    //    'bower_components/flot.tooltip/js/jquery.flot.tooltip.js',
    //    'bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.js',
    //    'bower_components/jstree/dist/jstree.js',
    //    'bower_components/bootstrap-select/dist/js/bootstrap-select.js',
    //    'bower_components/bootstrap-sweetalert/lib/sweet-alert.js'
    //], publicPath + 'js/libs.js');

	/*
	 |--------------------------------------------------------------------------
	 | Copy some Assets
	 |--------------------------------------------------------------------------
	 */
    //mix.copy('bower_components/html5shiv/dist/html5shiv.min.js', publicPath + 'js/html5shiv.min.js');
    //mix.copy('bower_components/respondJs/dest/respond.min.js', publicPath + 'js/respond.min.js');
    //mix.copy('bower_components/material-design-iconic-font/dist/fonts', publicPath + 'fonts');
    //mix.copy('bower_components/DataTables/media/images', publicPath + 'images');
    //mix.copy('../jstree/images', publicPath + 'images/jstree');

    /*
     |--------------------------------------------------------------------------
     | Testing
     |--------------------------------------------------------------------------
     |
     | Gulp watcher for tests, trigger with "gulp tdd".
     |
     */
    //mix.phpUnit();
});
