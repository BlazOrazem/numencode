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
     | CMS Assets
     |--------------------------------------------------------------------------
     |
     | Gulp watcher for cms assets, trigger with "gulp watch".
     |
     */

    var cmsResources = './modules/Cms/Resources/assets/';
	var publicPath = './public/themes/default/';

    mix.less([
        cmsResources + 'styles/app.less'
    ], publicPath + 'css/app.css')
    .styles([
        '/node_modules/font-awesome/css/font-awesome.min.css',
        '/node_modules/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css',
        '/node_modules/sweetalert/dist/sweetalert.css'
    ], publicPath + 'css/libs.css')
    .scripts([
        cmsResources + 'scripts/app.js'
    ], publicPath + 'js/app.js')
    .scripts([
        '/node_modules/jquery/dist/jquery.min.js',
        '/node_modules/bootstrap-less/js/bootstrap.min.js',
        '/node_modules/sweetalert/dist/sweetalert.min.js'
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
		publicPath + 'js/app.js',
		publicPath + 'js/libs.js'
    ]);

	/*
	 |--------------------------------------------------------------------------
	 | Copy some Assets
	 |--------------------------------------------------------------------------
	 */
	mix.copy('./bower_components/html5shiv/dist/html5shiv.min.js', publicPath + 'js/html5shiv.min.js');
	mix.copy('./bower_components/respondJs/dest/respond.min.js', publicPath + 'js/respond.min.js');
	mix.copy('./node_modules/font-awesome/fonts', './public/build/themes/default/fonts');

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
