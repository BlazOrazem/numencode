let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Set some path variables
 |--------------------------------------------------------------------------
 */
let rootPath = '../../../../../';
let publicPath = rootPath + 'public/';
let adminThemePath = publicPath + 'themes/admin/';

/*
 |--------------------------------------------------------------------------
 | Application Styles and Scripts
 |--------------------------------------------------------------------------
 */
mix.sass('../sass/style.scss', adminThemePath + 'css/app.css');

mix.scripts([
    '../js/http.js',
    '../js/app.js',
    '../js/form.js',
    '../js/init.js'
], adminThemePath + 'js/app.js');

/*
 |--------------------------------------------------------------------------
 | CSS Libraries
 |--------------------------------------------------------------------------
 */
mix.less('../jstree/style.less', adminThemePath + 'css/jstree.css');

mix.styles([
    'node_modules/bootstrap/dist/css/bootstrap.min.css',
    'node_modules/material-design-iconic-font/dist/css/material-design-iconic-font.min.css',
    'node_modules/animate.css/animate.min.css',
    'node_modules/metismenu/dist/metisMenu.min.css',
    'node_modules/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css',
    'node_modules/node-waves/dist/waves.min.css',
    'node_modules/toastr/build/toastr.min.css',
    'node_modules/datatables/media/css/jquery.dataTables.min.css',
    'node_modules/bootstrap-select/dist/css/bootstrap-select.min.css',
    'node_modules/bootstrap-sweetalert/dist/sweetalert.css',
    'node_modules/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css',
    'node_modules/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.min.css',
    'node_modules/cropperjs/dist/cropper.min.css'
], adminThemePath + 'css/libs.css');

/*
 |--------------------------------------------------------------------------
 | Javascript Libraries
 |--------------------------------------------------------------------------
 */
mix.scripts([
    'node_modules/jquery/dist/jquery.min.js',
    'node_modules/bootstrap/dist/js/bootstrap.js',
    'node_modules/vue/dist/vue.min.js',
    'node_modules/vue-resource/dist/vue-resource.min.js',
    'node_modules/metismenu/dist/metisMenu.js',
    'node_modules/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js',
    'node_modules/node-waves/dist/waves.min.js',
    'node_modules/toastr/build/toastr.min.js',
    'node_modules/datatables/media/js/jquery.dataTables.min.js',
    'node_modules/datatables.net-responsive/js/dataTables.responsive.min.js',
    'node_modules/moment/min/moment.min.js',
    'node_modules/chart.js/Chart.min.js',
    'node_modules/flot/jquery.flot.js',
    'node_modules/flot/jquery.flot.resize.js',
    'node_modules/jquery.flot.tooltip/js/jquery.flot.tooltip.min.js',
    'node_modules/easy-pie-chart/dist/jquery.easypiechart.min.js',
    'node_modules/jstree/dist/jstree.min.js',
    'node_modules/bootstrap-select/dist/js/bootstrap-select.min.js',
    'node_modules/bootstrap-sweetalert/dist/sweetalert.min.js',
    'node_modules/jquery-ui-sortable/jquery-ui.min.js',
    'node_modules/tinymce/tinymce.min.js',
    'node_modules/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js',
    'node_modules/x-editable/dist/inputs-ext/wysihtml5/wysihtml5.js',
    'node_modules/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.all.min.js',
    'node_modules/nestable/jquery.nestable.js',
    'node_modules/cropperjs/dist/cropper.min.js',
    'node_modules/jquery-cropper/dist/jquery-cropper.min.js'
], adminThemePath + 'js/libs.js');

/*
 |--------------------------------------------------------------------------
 | Copy some assets for old browsers support
 |--------------------------------------------------------------------------
 */
mix.copy('node_modules/html5shiv/dist/html5shiv.min.js', adminThemePath + 'js/html5shiv.min.js');
mix.copy('node_modules/respond.js/dest/respond.min.js', adminThemePath + 'js/respond.min.js');

/*
 |--------------------------------------------------------------------------
 | Copy some fonts
 |--------------------------------------------------------------------------
 */
mix.copy('node_modules/material-design-iconic-font/dist/fonts', adminThemePath + 'fonts');
mix.copy('node_modules/bootstrap/fonts', adminThemePath + 'fonts');
mix.copy('node_modules/bootstrap/fonts', publicPath + 'fonts');

/*
 |--------------------------------------------------------------------------
 | Copy some scripts used within the admin theme
 |--------------------------------------------------------------------------
 */
mix.copy('images', adminThemePath + 'images');
mix.copy('../jstree/images', adminThemePath + 'images/jstree');
mix.copy('node_modules/x-editable/dist/bootstrap3-editable/img', adminThemePath + 'img');

/*
 |--------------------------------------------------------------------------
 | Copy Laravel File Manager public files from vendor to public folder
 |--------------------------------------------------------------------------
 */
mix.copy(rootPath + 'vendor/unisharp/laravel-filemanager/public', publicPath + 'vendor/laravel-filemanager');
