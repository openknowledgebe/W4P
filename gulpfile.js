var elixir = require('laravel-elixir');

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

elixir(function(mix) {
    mix.sass('app.scss');
    mix.scriptsIn("resources/assets/js", "public/js/all.js");
    // use the --production flag with gulp to minify
});

elixir(function(mix) {
    mix.version(["js/all.js", "css/app.css"]);
});