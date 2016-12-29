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

//Route::get('/', 'WelcomeController@index');




//dd(__DIR__);

Route::group(array('before' => 'setStartTime'), function(){


	// Get the split routes files that are in the app/Http/Routes 
	$allFiles = File::allFiles(__DIR__ . '\Routes');

	foreach ($allFiles as $file) {

		require_once ($file->getPathname());
	}


});


// Get the split routes files that are in the app/Http/Routes 
	



//************************
// Begin pruebas con VUEJS
//************************
Route::get('/calendar', function (){

	return View::make ('vuejs.calendar');
});

Route::get('/grades', function (){

	return View::make ('vuejs.grades');
});

Route::get('/prueba', function (){

	return View::make ('vuejs.prueba');
});

Route::get('/chartjs', function (){

	return View::make ('chartjs');
});

Route::get('/vue', function (){

	return View::make ('vueroute');
});
/*
Route::get('/academic', function (){

	return Program::paginate(10);
});

Route::post('/academic/nuevo', function (){

	$model                      = new Program;
	
	$model->program_id          = Request::input('program_id');
	$model->program_name        = Request::input('program_name');
	$model->program_description = Request::input('program_description');
	$model->save();

	return response()->json(['result'=>'OK']);
});
//************************
// End pruebas con VUEJS
//************************



// Display all SQL executed in Eloquent
/*Event::listen('illuminate.query', function($query)
{
	print_r('<br><br><br><br>');
    print_r($query);
});*/

