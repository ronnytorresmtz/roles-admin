<?php

Route::group(array('middleware' => 'auth'), function(){
	// modules Routes
	Route::post('data/states/deleteButton', array(

		'as'			=> 'data.states.deleteButton',
		'uses' 			=> 'StateController@postDeleteButton'
	));

	Route::post('data/states/editButton', array (

		'as'			=> 'data.states.editButton',
		'uses' 			=> 'StateController@postEditButton'
	));

	Route::post('data/states/viewButton', array(

		'as'			=> 'data.states.viewButton',
		'uses' 			=> 'StateController@postViewButton'
	));

	Route::get('data/states/search', array(

		//'middleware'	=> 'auth',
		'as'			=> 'data.states.search',
		'uses' 			=> 'StateController@getSearch'
	));

	Route::get('data/states/export', array(

		//'middleware'	=> 'auth',
		'as'			=> 'data.states.export',
		'uses' 			=> 'StateController@getExport'
	));

	Route::get('data/states/import_file/{countryIDSelected}', array(

		//'middleware'	=> 'auth',
		'as'			=> 'data.states.import_file',
		'uses' 			=> 'StateController@getSelectImportFile'
	));

	Route::post('data/states/import', array(

		'as'			=> 'data.states.import',
		'uses' 			=> 'StateController@postImport'
	));

	Route::get('data/states/countrySelected/{countrySelected}', array(
			   
		'as'			=> 'data.states.country_selected',
		'uses' 			=> 'StateController@getCountrySelected'
	));

	//Route::resource('data/states', 'StateController');
	Route::resource('data/states', 'StateController', array(
	    'names' => array(
			'index'   => 'data.states.index',
			'create'  => 'data.states.create',
			'store'   => 'data.states.store',
			'show'    => 'data.states.show',
			'edit'    => 'data.states.edit',
			'update'  => 'data.states.update',
			'destroy' => 'data.states.destoy'
	    )
	));


	
});

