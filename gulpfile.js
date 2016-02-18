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

    var adminResources = 'modules/Admin/Resources/assets/';
    //mix.less([
    //    adminResources + 'styles/app.less',
    //    adminResources + 'styles/jstree/default/style.less'
    //], './public/css/admin-app.css')
    //.styles([
    //    '/node_modules/font-awesome/css/font-awesome.min.css',
    //    '/node_modules/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css',
    //    '/node_modules/sweetalert/dist/sweetalert.css',
    //    '/node_modules/metismenu/dist/metisMenu.min.css',
    //    '/node_modules/morris.js/morris.css',
    //    '/node_modules/datatables-lite/css/jquery.dataTables.min.css',
    //    '/node_modules/datatables-lite/css/dataTables.bootstrap.css',
    //    '/node_modules/datatables-lite/css/responsive.dataTables.min.css'
    //], 'public/css/admin-libs.css')
    mix.scripts([
        adminResources + 'scripts/tasks.js',
        //adminResources + 'scripts/app.js',
        //adminResources + 'scripts/vue.ajax.js',
        //adminResources + 'scripts/vue.init.js'
    ], './public/js/admin-app.js')
    .scripts([
        '/node_modules/jquery/dist/jquery.min.js',
        '/node_modules/bootstrap-less/js/bootstrap.min.js',
        '/node_modules/vue/dist/vue.js',
        '/node_modules/vue-resource/dist/vue-resource.js',
        '/node_modules/sweetalert/dist/sweetalert.min.js',
        '/node_modules/metismenu/dist/metisMenu.min.js',
        '/node_modules/raphael/raphael-min.js',
        '/node_modules/morris.js/morris.min.js',
        '/node_modules/jstree/dist/jstree.min.js',
        '/node_modules/jstree/dist/jstree.min.js',
        '/node_modules/datatables-lite/js/jquery.dataTables.min.js',
        '/node_modules/datatables-lite/js/dataTables.bootstrap.min.js',
        '/node_modules/datatables-lite/js/dataTables.responsive.min.js'
    ], './public/js/admin-libs.js');

    /*
     |--------------------------------------------------------------------------
     | CMS Assets
     |--------------------------------------------------------------------------
     |
     | Gulp watcher for cms assets, trigger with "gulp watch".
     |
     */

    //var cmsResources = 'modules/Cms/Resources/assets/';
    //mix.less([
    //    cmsResources + 'styles/app.less'
    //], './public/css/app.css')
    //.styles([
    //    '/node_modules/font-awesome/css/font-awesome.min.css',
    //    '/node_modules/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css',
    //    '/node_modules/sweetalert/dist/sweetalert.css'
    //], 'public/css/libs.css')
    //.scripts([
    //    cmsResources + 'scripts/app.js'
    //], './public/js/app.js')
    //.scripts([
    //    '/node_modules/jquery/dist/jquery.min.js',
    //    '/node_modules/bootstrap-less/js/bootstrap.min.js',
    //    '/node_modules/sweetalert/dist/sweetalert.min.js'
    //], './public/js/libs.js');

    /*
     |--------------------------------------------------------------------------
     | Version the Assets
     |--------------------------------------------------------------------------
     |
     | Version the CSS and JS files to avoid caching issues.
     |
     */

    //mix.version([
    //    'public/css/admin-app.css',
    //    'public/css/admin-libs.css',
    //    'public/css/app.css',
    //    'public/css/libs.css'
    //]);

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
