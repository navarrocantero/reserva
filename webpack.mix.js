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

mix.js('resources/assets/js/app.js', 'public/js')
    .js('resources/assets/js/bootstrap.js', 'public/js')
    .js('resources/assets/js/createHouseRequest.js', 'public/js')
    .js('resources/assets/js/createHouse.js', 'public/js')
    .js('resources/assets/js/pagination.js', 'public/js')
    .js('resources/assets/js/reserveHouse.js', 'public/js')
    .js('resources/assets/js/globalSettings.js', 'public/js')
    .js('resources/assets/js/userupdate/updateUserPassword.js', 'public/js/userupdate/')
    .js('resources/assets/js/userupdate/updateUserHouse.js', 'public/js/userupdate/')
    .js('resources/assets/js/userupdate/updateUserReserve.js', 'public/js/userupdate/')
    .js('resources/assets/js/userupdate/updateUserComment.js', 'public/js/userupdate/')


mix.babel('node_modules/izimodal/js/iziModal.js', 'public/js/iziModal.js')
    .babel('resources/assets/js/gmaps.js', 'public/js/gmaps.js')
    .babel('resources/assets/js/dropzone.js', 'public/js/dropzone.js')
