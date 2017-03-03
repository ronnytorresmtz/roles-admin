<?php

Route::group(array('middleware' => 'auth'), function(){
	// users Routes
	Route::post('security/users/deleteButton', array(

		'as'			=> 'security.users.deleteButton',
		'uses' 			=> 'UserController@postDeleteButton'
	));

	Route::post('security/users/editButton', array (

		'as'			=> 'security.users.editButton',
		'uses' 			=> 'UserController@postEditButton'
	));

	Route::post('security/users/viewButton', array(

		'as'			=> 'security.users.viewButton',
		'uses' 			=> 'UserController@postViewButton'
	));

	Route::get('security/users/search', array(

		//'middleware'	=> 'auth',
		'as'			=> 'security.users.search',
		'uses' 			=> 'UserController@getSearch'
	));

	Route::get('security/users/export', array(

		//'middleware'	=> 'auth',
		'as'			=> 'security.users.export',
		'uses' 			=> 'UserController@getExport'
	));

	Route::get('security/users/import_file', array(

		//'middleware'	=> 'auth',
		'as'			=> 'security.users.import_file',
		'uses' 			=> 'UserController@getSelectImportFile'
	));

	Route::post('security/users/import', array(

		'as'			=> 'security.users.import',
		'uses' 			=> 'UserController@postImport'
	));

	Route::post('security/users/reset', array(

		'as'			=> 'security.users.reset',
		'uses' 			=> 'UserController@postSendTokenToResetPassoword'
	));

	
	Route::resource('security/users', 'UserController', array(
	    'names' => array(
			'index'   => 'security.users.index',
			'create'  => 'security.users.create',
			'store'   => 'security.users.store',
			'show'    => 'security.users.show',
			'edit'    => 'security.users.edit',
			'update'  => 'security.users.update',
			'destroy' => 'security.users.destoy'
	    )
	));


	
});

