<?php

Route::group(array('middleware' => 'auth'), function(){
	
	Route::get('security/roles/search', array(
		'as'			=> 'security.roles.search',
		'uses' 		=> 'RoleController@getSearch'
	));

	Route::get('security/roles/export', array(
		'as'			=> 'security.roles.export',
		'uses' 		=> 'RoleController@getExport'
	));

	Route::get('security/roles/import_file', array(
		'as'			=> 'security.roles.import_file',
		'uses' 		=> 'RoleController@getSelectImportFile'
	));

	Route::post('security/roles/import', array(
		'as'			=> 'security.roles.import',
		'uses' 		=> 'RoleController@postImport'
	));

	Route::get('security/roles/getAllRolesActive', array(
		'as'			=> 'security.roles.getAllRolesActive',
		'uses' 		=> 'RoleController@getAllRolesActive'
	));

	Route::get('security/roles/getAllRolesActivebyPage', array(
		'as'			=> 'security.roles.getAllRolesActivebyPage',
		'uses' 		=> 'RoleController@getAllRolesActivebyPage'
	));

	Route::resource('security/roles', 'RoleController', array(
	    'names' => array(
			'index'   => 'security.roles.index',
			'create'  => 'security.roles.create',
			'store'   => 'security.roles.store',
			'show'    => 'security.roles.show',
			'edit'    => 'security.roles.edit',
			'update'  => 'security.roles.update',
			'destroy' => 'security.roles.destoy'
	    )
	));
	
});

