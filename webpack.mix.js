const mix = require('laravel-mix');
// require('laravel-mix-alias');


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

// mix.alias({
//     '@': '/resources/assets/js',
//     '~': '/resources/assets/sass',
//     '@components': '/resources/assets/js/components',
// });

mix.js('resources/js/app.js', 'public/js').vue()
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);
