<?php

Route::group(array('middleware' => 'auth'), function(){
	// modules Routes
	Route::post('settings/configurations/deleteButton', array(

		'as'			=> 'settings.configurations.deleteButton',
		'uses' 			=> 'ConfigurationController@postDeleteButton'
	));

	Route::post('settings/configurations/editButton', array (

		'as'			=> 'settings.configurations.editButton',
		'uses' 			=> 'ConfigurationController@postEditButton'
	));

	Route::post('settings/configurations/viewButton', array(

		'as'			=> 'settings.configurations.viewButton',
		'uses' 			=> 'ConfigurationController@postViewButton'
	));

	Route::get('settings/configurations/search', array(

		//'middleware'	=> 'auth',
		'as'			=> 'settings.configurations.search',
		'uses' 			=> 'ConfigurationController@getSearch'
	));

	Route::get('settings/configurations/export', array(

		//'middleware'	=> 'auth',
		'as'			=> 'settings.configurations.export',
		'uses' 			=> 'ConfigurationController@getExport'
	));

	Route::get('settings/configurations/import_file', array(

		//'middleware'	=> 'auth',
		'as'			=> 'settings.configurations.import_file',
		'uses' 			=> 'ConfigurationController@getSelectImportFile'
	));

	Route::post('settings/configurations/import', array(

		'as'			=> 'settings.configurations.import',
		'uses' 			=> 'ConfigurationController@postImport'
	));


	//Route::resource('settings/configurations', 'ConfigurationController');
	Route::resource('settings/configurations', 'ConfigurationController', array(
	    'names' => array(
			'index'   => 'settings.configurations.index',
			'create'  => 'settings.configurations.create',
			'store'   => 'settings.configurations.store',
			'show'    => 'settings.configurations.show',
			'edit'    => 'settings.configurations.edit',
			'update'  => 'settings.configurations.update',
			'destroy' => 'settings.configurations.destoy'
	    )
	));


	
});

