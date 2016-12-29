<?php

Route::group(array('middleware' => 'auth'), function(){
	// modules Routes
	Route::post('companies/companies/deleteButton', array(

		'as'			=> 'companies.companies.deleteButton',
		'uses' 			=> 'CompanyController@postDeleteButton'
	));

	Route::post('companies/companies/editButton', array (

		'as'			=> 'companies.companies.editButton',
		'uses' 			=> 'CompanyController@postEditButton'
	));

	Route::post('companies/companies/viewButton', array(

		'as'			=> 'companies.companies.viewButton',
		'uses' 			=> 'CompanyController@postViewButton'
	));

	Route::get('companies/companies/search', array(

		//'middleware'	=> 'auth',
		'as'			=> 'companies.companies.search',
		'uses' 			=> 'CompanyController@getSearch'
	));

	Route::get('companies/companies/export', array(

		//'middleware'	=> 'auth',
		'as'			=> 'companies.companies.export',
		'uses' 			=> 'CompanyController@getExport'
	));

	Route::get('companies/companies/import_file', array(

		//'middleware'	=> 'auth',
		'as'			=> 'companies.companies.import_file',
		'uses' 			=> 'CompanyController@getSelectImportFile'
	));

	Route::post('companies/companies/import', array(

		'as'			=> 'companies.companies.import',
		'uses' 			=> 'CompanyController@postImport'
	));


	//Route::resource('companies/companies', 'CompanyController');
	Route::resource('companies/companies', 'CompanyController', array(
	    'names' => array(
			'index'   => 'companies.companies.index',
			'create'  => 'companies.companies.create',
			'store'   => 'companies.companies.store',
			'show'    => 'companies.companies.show',
			'edit'    => 'companies.companies.edit',
			'update'  => 'companies.companies.update',
			'destroy' => 'companies.companies.destoy'
	    )
	));


	
});

