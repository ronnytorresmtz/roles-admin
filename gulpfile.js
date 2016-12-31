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

require('laravel-elixir-vueify');

elixir(function(mix) {
	
    //mix.browserify('main.js');
    mix.browserify('vueroute.js');
    
});


/****Execute Shell Commands */
/*var gulp = require("gulp");
var shell = require("gulp-shell");
gulp.task('local server', shell.task([
    "php artisan serve",
    "echo Hello"
]));*/
