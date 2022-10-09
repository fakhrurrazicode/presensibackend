const mix = require("laravel-mix");

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

mix.js("resources/js/app.js", "public/js")
    .sass("resources/sass/app.scss", "public/css")
    .copy("node_modules/bootstrap-table/dist", "public/vendors/bootstrap-table")
    .copy("node_modules/font-awesome", "public/vendors/font-awesome")
    .copy("node_modules/sweetalert2/dist", "public/vendors/sweetalert2")
    .copy("node_modules/animate.css/", "public/vendors/animate.css")
    .copy("node_modules/chart.js/", "public/vendors/chart.js")
    .sourceMaps();
