<?php

Route::group(array('middleware' => 'auth'), function(){
	// modules Routes
	Route::post('academic/plans/deleteButton', array(

		'as'			=> 'academic.plans.deleteButton',
		'uses' 			=> 'PlanController@postDeleteButton'
	));

	Route::post('academic/plans/editButton', array (

		'as'			=> 'academic.plans.editButton',
		'uses' 			=> 'PlanController@postEditButton'
	));

	Route::post('academic/plans/viewButton', array(

		'as'			=> 'academic.plans.viewButton',
		'uses' 			=> 'PlanController@postViewButton'
	));

	Route::get('academic/plans/search', array(

		//'middleware'	=> 'auth',
		'as'			=> 'academic.plans.search',
		'uses' 			=> 'PlanController@getSearch'
	));

	Route::get('academic/plans/export', array(

		//'middleware'	=> 'auth',
		'as'			=> 'academic.plans.export',
		'uses' 			=> 'PlanController@getExport'
	));

	Route::get('academic/plans/import_file', array(

		//'middleware'	=> 'auth',
		'as'			=> 'academic.plans.import_file',
		'uses' 			=> 'PlanController@getSelectImportFile'
	));

	Route::post('academic/plans/import', array(

		'as'			=> 'academic.plans.import',
		'uses' 			=> 'PlanController@postImport'
	));


	//Route::resource('academic/plans', 'PlanController');
	Route::resource('academic/plans', 'PlanController', array(
	    'names' => array(
			'index'   => 'academic.plans.index',
			'create'  => 'academic.plans.create',
			'store'   => 'academic.plans.store',
			'show'    => 'academic.plans.show',
			'edit'    => 'academic.plans.edit',
			'update'  => 'academic.plans.update',
			'destroy' => 'academic.plans.destoy'
	    )
	));


	
});

