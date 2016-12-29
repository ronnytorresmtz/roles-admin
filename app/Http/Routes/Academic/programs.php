<?php

Route::group(array('middleware' => 'auth'), function(){
	// Programs Routes
	Route::post('academic/programs/deleteButton', array(

		'as'			=> 'academic.programs.deleteButton',
		'uses' 			=> 'ProgramController@postDeleteButton'
	));

	Route::post('academic/programs/editButton', array (

		'as'			=> 'academic.programs.editButton',
		'uses' 			=> 'ProgramController@postEditButton'
	));

	Route::post('academic/programs/viewButton', array(

		'as'			=> 'academic.programs.viewButton',
		'uses' 			=> 'ProgramController@postViewButton'
	));

	//Route::get('academic/programs/search', array(
	Route::get('academic/programs/search', array(

		'middleware'	=> 'auth',
		'as'			=> 'academic.programs.search',
		'uses' 			=> 'ProgramController@getSearch'
	));

	Route::get('academic/programs/export', array(

		'middleware'	=> 'auth',
		'as'			=> 'academic.programs.export',
		'uses' 			=> 'ProgramController@getExport'
	));

	Route::get('academic/programs/import_file', array(

		'middleware'	=> 'auth',
		'as'			=> 'academic.programs.import_file',
		'uses' 			=> 'ProgramController@getSelectImportFile'
	));

	Route::post('academic/programs/import', array(

		'as'			=> 'academic.programs.import',
		'uses' 			=> 'ProgramController@postImport'
	));

	//Route::resource('academic/programs', 'ProgramController');
	Route::resource('academic/programs', 'ProgramController', array(
	    'names' => array(
			'index'   => 'academic.programs.index',
			'create'  => 'academic.programs.create',
			'store'   => 'academic.programs.store',
			'show'    => 'academic.programs.show',
			'edit'    => 'academic.programs.edit',
			'update'  => 'academic.programs.update',
			'destroy' => 'academic.programs.destoy'
	    )
	));

	
});

