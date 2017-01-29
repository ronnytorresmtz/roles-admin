<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


// Get the split routes files that are in the app/Http/Routes 
$allFiles = File::allFiles(__DIR__ . '\Routes');

foreach ($allFiles as $file) {

	require_once ($file->getPathname());
}



Route::get('/vue', function (){

	return View::make ('vueroute');
});
