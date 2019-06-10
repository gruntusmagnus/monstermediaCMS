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

/*mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');*/

mix.js('resources/js/admin/main.js', 'public/js/admin.js')
    .sass('resources/sass/app.scss', 'public/css');


mix.js('resources/js/profile/main.js', 'public/js/profile.js');

mix.js('resources/js/public/*.js', 'public/js/public.js');
mix.js('resources/js/modules/Catalog/public/views/product/productModal.js','public/js/orderModal.js');

mix.copy('node_modules/perfect-scrollbar/dist/perfect-scrollbar.js', 'public/js/perfect-scrollbar.js');
