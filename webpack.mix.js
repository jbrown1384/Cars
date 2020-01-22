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

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');

mix.copy('vendor/font-awesome/css', 'public/css');
mix.copy('vendor/font-awesome/fonts', 'public/fonts');

mix.copy('vendor/bootstrap/css/bootstrap.min.css', 'public/css');
mix.copy('vendor/bootstrap/js/bootstrap.min.js', 'public/js');
mix.copy('vendor/bootstrap/js/bootstrap.min.js', 'public/js');
