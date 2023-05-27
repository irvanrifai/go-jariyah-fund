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

mix.js('resources/js/backoffice-script.js', 'public/js')
    .sass('resources/sass/backoffice-style.scss', 'public/css')
    .sourceMaps();

mix.js('resources/js/public/main-script.js', 'public/js/public')
    .sass('resources/sass/public/main-style.scss', 'public/css/public')
    .sourceMaps();

mix.js('resources/js/public/wbs-script.js', 'public/js/public')
    .sass('resources/sass/public/wbs-style.scss', 'public/css/public')
    .sourceMaps();
