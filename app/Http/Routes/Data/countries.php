<?php

Route::group(array('middleware' => 'auth'), function(){
	// modules Routes
	Route::post('data/countries/deleteButton', array(

		'as'			=> 'data.countries.deleteButton',
		'uses' 			=> 'CountryController@postDeleteButton'
	));

	Route::post('data/countries/editButton', array (

		'as'			=> 'data.countries.editButton',
		'uses' 			=> 'CountryController@postEditButton'
	));

	Route::post('data/countries/viewButton', array(

		'as'			=> 'data.countries.viewButton',
		'uses' 			=> 'CountryController@postViewButton'
	));

	Route::get('data/countries/search', array(

		//'middleware'	=> 'auth',
		'as'			=> 'data.countries.search',
		'uses' 			=> 'CountryController@getSearch'
	));

	Route::get('data/countries/export', array(

		//'middleware'	=> 'auth',
		'as'			=> 'data.countries.export',
		'uses' 			=> 'CountryController@getExport'
	));

	Route::get('data/countries/import_file', array(

		//'middleware'	=> 'auth',
		'as'			=> 'data.countries.import_file',
		'uses' 			=> 'CountryController@getSelectImportFile'
	));

	Route::post('data/countries/import', array(

		'as'			=> 'data.countries.import',
		'uses' 			=> 'CountryController@postImport'
	));


	//Route::resource('data/countries', 'CountryController');
	Route::resource('data/countries', 'CountryController', array(
	    'names' => array(
			'index'   => 'data.countries.index',
			'create'  => 'data.countries.create',
			'store'   => 'data.countries.store',
			'show'    => 'data.countries.show',
			'edit'    => 'data.countries.edit',
			'update'  => 'data.countries.update',
			'destroy' => 'data.countries.destoy'
	    )
	));


	
});

