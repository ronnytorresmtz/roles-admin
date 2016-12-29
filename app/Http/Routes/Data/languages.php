<?php

Route::group(array('middleware' => 'auth'), function(){
	// modules Routes
	Route::post('data/languages/deleteButton', array(

		'as'			=> 'data.languages.deleteButton',
		'uses' 			=> 'LanguageController@postDeleteButton'
	));

	Route::post('data/languages/editButton', array (

		'as'			=> 'data.languages.editButton',
		'uses' 			=> 'LanguageController@postEditButton'
	));

	Route::post('data/languages/viewButton', array(

		'as'			=> 'data.languages.viewButton',
		'uses' 			=> 'LanguageController@postViewButton'
	));

	Route::get('data/languages/search', array(

		//'middleware'	=> 'auth',
		'as'			=> 'data.languages.search',
		'uses' 			=> 'LanguageController@getSearch'
	));

	Route::get('data/languages/export', array(

		//'middleware'	=> 'auth',
		'as'			=> 'data.languages.export',
		'uses' 			=> 'LanguageController@getExport'
	));

	Route::get('data/languages/import_file', array(

		//'middleware'	=> 'auth',
		'as'			=> 'data.languages.import_file',
		'uses' 			=> 'LanguageController@getSelectImportFile'
	));

	Route::post('data/languages/import', array(

		'as'			=> 'data.languages.import',
		'uses' 			=> 'LanguageController@postImport'
	));


	//Route::resource('data/languages', 'LanguageController');
	Route::resource('data/languages', 'LanguageController', array(
	    'names' => array(
			'index'   => 'data.languages.index',
			'create'  => 'data.languages.create',
			'store'   => 'data.languages.store',
			'show'    => 'data.languages.show',
			'edit'    => 'data.languages.edit',
			'update'  => 'data.languages.update',
			'destroy' => 'data.languages.destoy'
	    )
	));


	
});

