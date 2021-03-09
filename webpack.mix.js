const mix = require('laravel-mix');
require('laravel-mix-eslint-config');
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


mix.webpackConfig({
    resolve: {
        extensions: ['.js', '.vue', '.json'],
        alias: {
            'vue$': 'vue/dist/vue.esm.js',
            '@': __dirname + '/resources/js'
        },
    },
    node: {
        fs: 'empty'
    }
})

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/landing/style.scss', 'public/css/style.css').webpackConfig({
        module: {
            rules: [
                {
                    test: /\.scss/,
                    loader: 'import-glob-loader'
                }
            ]
        }
    });
mix.disableNotifications();