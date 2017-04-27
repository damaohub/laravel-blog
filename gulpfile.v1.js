
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

var baseJs = [
    'vendor/jquery.min.js',
    'vendor/bootstrap.min.js',
    'vendor/holder.min.js'
]

elixir(function(mix) {
    mix
        .copy([
            'node_modules/font-awesome/fonts'
        ], 'public/assets/fonts/font-awesome')
        .copy(['resources/assets/fonts'],'public/assets/fonts/font-logo')

        .sass('base.scss','public/assets/css/base.css')
        .sass('app.scss','public/assets/css/app.css')

        .scripts(baseJs,'public/assets/js/base.js')
        .scripts('app.js','public/assets/js/app.js')

        .version(['assets/css/app.css','assets/js/app.js']);

});
