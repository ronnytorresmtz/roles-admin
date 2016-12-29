<?php

Route::group(array('middleware' => 'auth'), function(){
	// modules Routes
	Route::post('menuTemplate/modelTemplates/deleteButton', array(

		'as'			=> 'menuTemplate.modelTemplates.deleteButton',
		'uses' 			=> 'ucfirstModelTemplateController@postDeleteButton'
	));

	Route::post('menuTemplate/modelTemplates/editButton', array (

		'as'			=> 'menuTemplate.modelTemplates.editButton',
		'uses' 			=> 'ucfirstModelTemplateController@postEditButton'
	));

	Route::post('menuTemplate/modelTemplates/viewButton', array(

		'as'			=> 'menuTemplate.modelTemplates.viewButton',
		'uses' 			=> 'ucfirstModelTemplateController@postViewButton'
	));

	Route::get('menuTemplate/modelTemplates/search', array(

		//'middleware'	=> 'auth',
		'as'			=> 'menuTemplate.modelTemplates.search',
		'uses' 			=> 'ucfirstModelTemplateController@getSearch'
	));

	Route::get('menuTemplate/modelTemplates/export', array(

		//'middleware'	=> 'auth',
		'as'			=> 'menuTemplate.modelTemplates.export',
		'uses' 			=> 'ucfirstModelTemplateController@getExport'
	));

	Route::get('menuTemplate/modelTemplates/import_file/{selectTemplateIDSelected}', array(

		//'middleware'	=> 'auth',
		'as'			=> 'menuTemplate.modelTemplates.import_file',
		'uses' 			=> 'ucfirstModelTemplateController@getSelectImportFile'
	));

	Route::post('menuTemplate/modelTemplates/import', array(

		'as'			=> 'menuTemplate.modelTemplates.import',
		'uses' 			=> 'ucfirstModelTemplateController@postImport'
	));

	Route::get('menuTemplate/modelTemplates/selectTemplateSelected/{selectTemplateSelected}', array(
			   
		'as'			=> 'menuTemplate.modelTemplates.selectTemplate_selected',
		'uses' 			=> 'ucfirstModelTemplateController@getucfirstSelectTemplateSelected'
	));

	//Route::resource('menuTemplate/modelTemplates', 'ucfirstModelTemplateController');
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

