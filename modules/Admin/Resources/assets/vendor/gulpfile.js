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

    var rootPath = '../../../../../';
    var publicPath = '../../../../../public/';
    var adminThemePath = '../../../../../public/themes/admin/';

    /*
     |--------------------------------------------------------------------------
     | Application Styles and Scripts
     |--------------------------------------------------------------------------
     */
    mix.sass([
        '../sass/style.scss'
    ], adminThemePath + 'css/app.css');

    //mix.scripts([
    //    '../js/http.js',
    //    '../js/app.js',
    //    '../js/form.js',
    //    '../js/init.js'
    //], adminThemePath + 'js/app.js');

    /*
     |--------------------------------------------------------------------------
     | CSS Libraries
     |--------------------------------------------------------------------------
     */
    //mix.less([
    //    '../jstree/style.less'
    //], adminThemePath + 'css/jstree.css')
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
    //    'bower_components/bootstrap-sweetalert/lib/sweet-alert.css',
    //    'bower_components/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css',
    //    'bower_components/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.min.css',
    //], adminThemePath + 'css/libs.css');

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
    //    'bower_components/bootstrap-sweetalert/lib/sweet-alert.js',
    //    'bower_components/jquery-ui-sortable-min/jquery-ui-sortable-min.js',
    //    'bower_components/tinymce/tinymce.min.js',
    //    'bower_components/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js',
    //    'bower_components/x-editable/dist/inputs-ext/wysihtml5/wysihtml5.js',
    //    'bower_components/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.all.min.js',
    //    'bower_components/nestable/jquery.nestable.js'
    //], adminThemePath + 'js/libs.js');

	/*
	 |--------------------------------------------------------------------------
	 | Copy some assets for old browsers support
	 |--------------------------------------------------------------------------
	 */
    //mix.copy('bower_components/html5shiv/dist/html5shiv.min.js', adminThemePath + 'js/html5shiv.min.js');
    //mix.copy('bower_components/respondJs/dest/respond.min.js', adminThemePath + 'js/respond.min.js');

    /*
     |--------------------------------------------------------------------------
     | Copy some fonts
     |--------------------------------------------------------------------------
     */
    //mix.copy('bower_components/material-design-iconic-font/dist/fonts', adminThemePath + 'fonts');
    //mix.copy('bower_components/bootstrap/fonts', adminThemePath + 'fonts');
    //mix.copy('bower_components/bootstrap/fonts', publicPath + 'fonts');

    /*
     |--------------------------------------------------------------------------
     | Copy some scripts used within the admin theme
     |--------------------------------------------------------------------------
     */
    //mix.copy('bower_components/DataTables/media/images', adminThemePath + 'images');
    //mix.copy('../jstree/images', adminThemePath + 'images/jstree');
    //mix.copy('bower_components/x-editable/dist/bootstrap3-editable/img', adminThemePath + 'img');

    /*
     |--------------------------------------------------------------------------
     | Copy Laravel File Manager public files from vendor to public folder
     |--------------------------------------------------------------------------
     */
    //mix.copy(rootPath + 'vendor/unisharp/laravel-filemanager/public', publicPath + 'vendor/laravel-filemanager');

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
