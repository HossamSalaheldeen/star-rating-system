const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .scripts('resources/js/rating.js', 'public/js/rating.min.js')
    .scripts('resources/js/vendors/create.js', 'public/js/vendors/create.min.js')
    .scripts('resources/js/vendors/edit.js', 'public/js/vendors/edit.min.js')
    .styles('resources/css/timeline.css','public/css/timeline.min.css')
    .styles('resources/css/rating.css','public/css/rating.min.css')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);
