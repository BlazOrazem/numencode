let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

let resources = 'modules/Cms/Resources/assets';
let publicPath = 'public/themes/default';

mix.sass(resources + '/sass/app.scss', publicPath + '/css')
    .copy('node_modules/html5shiv/dist/html5shiv.min.js', publicPath + '/js')
    .copy('node_modules/respond.js/dest/respond.min.js', publicPath + '/js')
    .js(resources + '/js/app.js', publicPath + '/js')
    .extract(['vue', 'sweetalert2'])
    .sourceMaps()
    .version();
