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

// mix.scripts('resources/js/app.js', 'public/js')
//     .postCss('resources/css/app.css', 'public/css', [
//         //
//     ]);

mix.copy('resources/js/app.js', 'public/js');
mix.copy('resources/css/app.css', 'public/css');
mix.copy('resources/assets/music', 'public/assets/music');
mix.copy('resources/assets/images', 'public/assets/images');
mix.copy('resources/favicon.ico', 'public/favicon.ico');

