<?php

Route::group(array('middleware' => 'auth'), function(){
	
	Route::get('security/modules/search', array(
		'as'			=> 'security.modules.search',
		'uses' 		=> 'ModuleController@getSearch'
	));

	Route::get('security/modules/export', array(
		'as'			=> 'security.modules.export',
		'uses' 		=> 'ModuleController@getExport'
	));

	Route::get('security/modules/import_file', array(
		'as'			=> 'security.modules.import_file',
		'uses' 		=> 'ModuleController@getSelectImportFile'
	));

	Route::post('security/modules/import', array(
		'as'			=> 'security.modules.import',
		'uses' 		=> 'ModuleController@postImport'
	));

	Route::get('security/modules/getAllModulesActive', array(
		'as'			=> 'security.modules.getAllModulesActive',
		'uses' 		=> 'ModuleController@getAllModulesActive'
	));

	Route::get('security/modules/getAllModulesActivebyPage', array(
		'as'			=> 'security.modules.getAllModulesActivebyPage',
		'uses' 		=> 'ModuleController@getAllModulesActivebyPage'
	));

	Route::resource('security/modules', 'ModuleController', array(
	    'names' => array(
			'index'   => 'security.modules.index',
			'create'  => 'security.modules.create',
			'store'   => 'security.modules.store',
			'show'    => 'security.modules.show',
			'edit'    => 'security.modules.edit',
			'update'  => 'security.modules.update',
			'destroy' => 'security.modules.destoy'
	    )
	));
	
});