const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');
mix.disableNotifications()

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
.js('resources/js/appAdmin.js', 'public/js')
.sass('resources/scss/app.scss', 'public/css')
.sass('resources/scss/login.scss', 'public/css')
.sass('resources/scss/sidebar.scss', 'public/css')
.sass('resources/scss/styles.scss', 'public/css')
.options({
    postCss: [ tailwindcss('./tailwind.config.js') ],
})