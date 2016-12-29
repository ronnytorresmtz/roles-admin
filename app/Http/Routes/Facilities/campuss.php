<?php

Route::group(array('middleware' => array('auth')), function(){
	// modules Routes
	Route::post('facilities/campuss/deleteButton', array(

		'as'			=> 'facilities.campuss.deleteButton',
		'uses' 			=> 'CampusController@postDeleteButton'
	));

	Route::post('facilities/campuss/editButton', array (

		'as'			=> 'facilities.campuss.editButton',
		'uses' 			=> 'CampusController@postEditButton'
	));

	Route::post('facilities/campuss/viewButton', array(

		'as'			=> 'facilities.campuss.viewButton',
		'uses' 			=> 'CampusController@postViewButton'
	));

	Route::get('facilities/campuss/search', array(

		//'middleware'	=> 'auth',
		'as'			=> 'facilities.campuss.search',
		'uses' 			=> 'CampusController@getSearch'
	));

	Route::get('facilities/campuss/export', array(

		'as'			=> 'facilities.campuss.export',
		'uses' 			=> 'CampusController@getExport'
	));

	Route::get('facilities/campuss/import_file/{instituteIDSelected}', array(

		'as'			=> 'facilities.campuss.import_file',
		'uses' 			=> 'CampusController@getSelectImportFile'
	));

	Route::post('facilities/campuss/import', array(

		'as'			=> 'facilities.campuss.import',
		'uses' 			=> 'CampusController@postImport'
	));

	Route::get('facilities/campuss/instituteSelected/{instituteSelected}', array(
			   
		'as'			=> 'facilities.campuss.institute_selected',
		'uses' 			=> 'CampusController@getInstituteSelected'
	));

	Route::resource('facilities/campuss', 'CampusController', array(
	    'names' => array(
			'index'   => 'facilities.campuss.index',
			'create'  => 'facilities.campuss.create',
			'store'   => 'facilities.campuss.store',
			'show'    => 'facilities.campuss.show',
			'edit'    => 'facilities.campuss.edit',
			'update'  => 'facilities.campuss.update',
			'destroy' => 'facilities.campuss.destoy'
	    )
	));


	
});

