<?php

Route::group(array('middleware' => 'auth'), function(){
	// institutes Routes
	Route::post('facilities/institutes/deleteButton', array(

		'as'			=> 'facilities.institutes.deleteButton',
		'uses' 			=> 'InstituteController@postDeleteButton'
	));

	Route::post('facilities/institutes/editButton', array (

		'as'			=> 'facilities.institutes.editButton',
		'uses' 			=> 'InstituteController@postEditButton'
	));

	Route::post('facilities/institutes/viewButton', array(

		'as'			=> 'facilities.institutes.viewButton',
		'uses' 			=> 'InstituteController@postViewButton'
	));

	Route::get('facilities/institutes/search', array(

		//'middleware'	=> 'auth',
		'as'			=> 'facilities.institutes.search',
		'uses' 			=> 'InstituteController@getSearch'
	));

	Route::get('facilities/institutes/export', array(

		//'middleware'	=> 'auth',
		'as'			=> 'facilities.institutes.export',
		'uses' 			=> 'InstituteController@getExport'
	));

	Route::get('facilities/institutes/import_file', array(

		//'middleware'	=> 'auth',
		'as'			=> 'facilities.institutes.import_file',
		'uses' 			=> 'InstituteController@getSelectImportFile'
	));

	Route::post('facilities/institutes/import', array(

		'as'			=> 'facilities.institutes.import',
		'uses' 			=> 'InstituteController@postImport'
	));


	//Route::resource('facilities/institutes', 'InstituteController');
	Route::resource('facilities/institutes', 'InstituteController', array(
	    'names' => array(
			'index'   => 'facilities.institutes.index',
			'create'  => 'facilities.institutes.create',
			'store'   => 'facilities.institutes.store',
			'show'    => 'facilities.institutes.show',
			'edit'    => 'facilities.institutes.edit',
			'update'  => 'facilities.institutes.update',
			'destroy' => 'facilities.institutes.destoy'
	    )
	));


	
});

