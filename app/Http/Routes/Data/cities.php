<?php

Route::group(array('middleware' => 'auth'), function(){
	// modules Routes
	Route::post('data/cities/deleteButton', array(

		'as'			=> 'data.cities.deleteButton',
		'uses' 			=> 'CityController@postDeleteButton'
	));

	Route::post('data/cities/editButton', array (

		'as'			=> 'data.cities.editButton',
		'uses' 			=> 'CityController@postEditButton'
	));

	Route::post('data/cities/viewButton', array(

		'as'			=> 'data.cities.viewButton',
		'uses' 			=> 'CityController@postViewButton'
	));

	Route::get('data/cities/search', array(

		//'middleware'	=> 'auth',
		'as'			=> 'data.cities.search',
		'uses' 			=> 'CityController@getSearch'
	));

	Route::get('data/cities/export', array(

		//'middleware'	=> 'auth',
		'as'			=> 'data.cities.export',
		'uses' 			=> 'CityController@getExport'
	));

	Route::get('data/cities/import_file/{stateIDSelected}', array(

		//'middleware'	=> 'auth',
		'as'			=> 'data.cities.import_file',
		'uses' 			=> 'CityController@getSelectImportFile'
	));

	Route::post('data/cities/import', array(

		'as'			=> 'data.cities.import',
		'uses' 			=> 'CityController@postImport'
	));

	Route::get('data/cities/stateSelected/{countrySelected}/{stateSelected}', array(
			   
		'as'			=> 'data.cities.state_selected',
		'uses' 			=> 'CityController@getStateSelected'
	));

	Route::get('data/cities/countrySelected/{countrySelected}', array(
			   
		'as'			=> 'data.cities.country_selected',
		'uses' 			=> 'CityController@getStatesByCountrySelected'
	));

	

	//Route::resource('data/cities', 'CityController');
	Route::resource('data/cities', 'CityController', array(
	    'names' => array(
			'index'   => 'data.cities.index',
			'create'  => 'data.cities.create',
			'store'   => 'data.cities.store',
			'show'    => 'data.cities.show',
			'edit'    => 'data.cities.edit',
			'update'  => 'data.cities.update',
			'destroy' => 'data.cities.destoy'
	    )
	));


	
});

