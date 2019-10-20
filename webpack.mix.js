const mix = require('laravel-mix');

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
let productionSourceMaps = true;

mix.sass(resources + '/sass/app.scss', publicPath + '/css')
    .js(resources + '/js/app.js', publicPath + '/js')
    .extract(['sweetalert2', 'vue'])
    .sourceMaps(productionSourceMaps, 'source-map')
    .version();
