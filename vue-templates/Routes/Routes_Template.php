<?php

Route::group(array('middleware' => 'auth'), function(){
	
	Route::get('menuTemplate/modelTemplates/search', array(
		'as'			=> 'menuTemplate.modelTemplates.search',
		'uses' 		=> 'ucfirstModelTemplateController@getSearch'
	));

	Route::get('menuTemplate/modelTemplates/export', array(
		'as'			=> 'menuTemplate.modelTemplates.export',
		'uses' 		=> 'ucfirstModelTemplateController@getExport'
	));

	Route::get('menuTemplate/modelTemplates/import_file', array(
		'as'			=> 'menuTemplate.modelTemplates.import_file',
		'uses' 		=> 'ucfirstModelTemplateController@getSelectImportFile'
	));

	Route::post('menuTemplate/modelTemplates/import', array(
		'as'			=> 'menuTemplate.modelTemplates.import',
		'uses' 		=> 'ucfirstModelTemplateController@postImport'
	));

	Route::get('menuTemplate/modelTemplates/getAllucfirstModelTemplatesActive', array(
		'as'			=> 'menuTemplate.modelTemplates.getAllucfirstModelTemplatesActive',
		'uses' 		=> 'ucfirstModelTemplateController@getAllucfirstModelTemplatesActive'
	));

	Route::get('menuTemplate/modelTemplates/getAllucfirstModelTemplatesActivebyPage', array(
		'as'			=> 'menuTemplate.modelTemplates.getAllucfirstModelTemplatesActivebyPage',
		'uses' 		=> 'ucfirstModelTemplateController@getAllucfirstModelTemplatesActivebyPage'
	));

	Route::resource('menuTemplate/modelTemplates', 'ucfirstModelTemplateController', array(
	    'names' => array(
			'index'   => 'menuTemplate.modelTemplates.index',
			'create'  => 'menuTemplate.modelTemplates.create',
			'store'   => 'menuTemplate.modelTemplates.store',
			'show'    => 'menuTemplate.modelTemplates.show',
			'edit'    => 'menuTemplate.modelTemplates.edit',
			'update'  => 'menuTemplate.modelTemplates.update',
			'destroy' => 'menuTemplate.modelTemplates.destoy'
	    )
	));
	
});