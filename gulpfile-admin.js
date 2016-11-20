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

    var adminResources = './modules/Admin/Resources/assets/';
    var publicPath = './public/themes/admin/';

    /*
     |--------------------------------------------------------------------------
     | Styles (SASS, LESS, CSS)
     |--------------------------------------------------------------------------
     */
	mix.sass([
        adminResources + 'scss/style.scss'
    ], publicPath + 'css/app.css')
    .less([
		adminResources + 'jstree/style.less'
	], publicPath + 'css/jstree.css')
    .styles([
        adminResources + 'jstree/style.less',
		adminResources + 'bower_components/bootstrap/dist/css/bootstrap.min.css',
        adminResources + 'bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css',
        adminResources + 'bower_components/animate.css/animate.min.css',
        adminResources + 'bower_components/metisMenu/dist/metisMenu.min.css',
        adminResources + 'bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css',
        adminResources + 'bower_components/Waves/dist/waves.min.css',
        adminResources + 'bower_components/toastr/toastr.css',
        adminResources + 'bower_components/DataTables/media/css/jquery.dataTables.min.css',
		adminResources + 'bower_components/bootstrap-select/dist/css/bootstrap-select.css',
		adminResources + 'bower_components/bootstrap-sweetalert/lib/sweet-alert.css'
    ], publicPath + 'css/libs.css');

    /*
     |--------------------------------------------------------------------------
     | Scripts (Javascript)
     |--------------------------------------------------------------------------
     */
    mix.scripts([
        //adminResources + 'scripts/general.js',
        adminResources + 'scripts/http.js',
        adminResources + 'scripts/app.js',
        adminResources + 'scripts/form.js',
        adminResources + 'scripts/init.js'
    ], publicPath + 'js/app.js')
    .scripts([
		adminResources + 'bower_components/jquery/dist/jquery.min.js',
		adminResources + 'bower_components/bootstrap/dist/js/bootstrap.min.js',
		adminResources + 'bower_components/metisMenu/dist/metisMenu.min.js',
		adminResources + 'bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.js',
		adminResources + 'bower_components/Waves/dist/waves.min.js',
		adminResources + 'bower_components/toastr/toastr.js',
		adminResources + 'bower_components/datatables/media/js/jquery.dataTables.min.js',
		adminResources + 'bower_components/datatables.net-responsive/js/dataTables.responsive.js',
		adminResources + 'bower_components/moment/min/moment.min.js',
		adminResources + 'bower_components/Chart.js/Chart.js',
		adminResources + 'bower_components/flot/jquery.flot.js',
		adminResources + 'bower_components/flot/jquery.flot.resize.js',
		adminResources + 'bower_components/flot.tooltip/js/jquery.flot.tooltip.js',
		adminResources + 'bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.js',
		adminResources + 'bower_components/jstree/dist/jstree.js',
		adminResources + 'bower_components/bootstrap-select/dist/js/bootstrap-select.js',
        adminResources + 'bower_components/bootstrap-sweetalert/lib/sweet-alert.js'
    ], publicPath + 'js/libs.js');

    /*
     |--------------------------------------------------------------------------
     | Version the Assets
     |--------------------------------------------------------------------------
     |
     | Version the CSS and JS files to avoid caching issues.
     |
     */
    mix.version([
        publicPath + 'css/app.css',
        publicPath + 'css/libs.css',
        publicPath + 'css/jstree.css',
        publicPath + 'js/app.js',
        publicPath + 'js/libs.js',
    ]);

	/*
	 |--------------------------------------------------------------------------
	 | Copy some Assets
	 |--------------------------------------------------------------------------
	 */
	//mix.copy(adminResources + 'bower_components/html5shiv/dist/html5shiv.min.js', publicPath + 'js/html5shiv.min.js');
	//mix.copy(adminResources + 'bower_components/respondJs/dest/respond.min.js', publicPath + 'js/respond.min.js');
	//mix.copy(adminResources + 'bower_components/material-design-iconic-font/dist/fonts', publicPath + 'fonts');
	//mix.copy(adminResources + 'bower_components/DataTables/media/images', publicPath + 'images');
	//mix.copy(adminResources + 'jstree/images', publicPath + 'images/jstree');
	//mix.copy(adminResources + 'bower_components/DataTables/media/images', './public/build/themes/admin/images');
	//mix.copy(adminResources + 'bower_components/material-design-iconic-font/dist/fonts', './public/build/themes/admin/fonts');

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
