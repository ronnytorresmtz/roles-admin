<?php

Route::group(array('middleware' => 'auth'), function(){


	Route::get('security/roles_transactions/export', array(

		//'middleware'	=> 'auth',
		'as'			=> 'security.roles_transactions.export',
		'uses' 			=> 'RoleTransactionController@getExport'
	));

	Route::get('security/roles_transactions/import_file', array(

		//'middleware'	=> 'auth',
		'as'			=> 'security.roles_transactions.import_file',
		'uses' 			=> 'RoleTransactionController@getSelectImportFile'
	));

	Route::post('security/roles_transactions/import', array(

		'as'			=> 'security.roles_transactions.import',
		'uses' 			=> 'RoleTransactionController@postImport'
	));

	Route::get('security/roles_transactions/roleSelected/{roleSelected}', array(
			   
		'as'			=> 'security.roles_transactions.role_selected',
		'uses' 			=> 'RoleTransactionController@getRoleSelected'
	));

	Route::get('security/roles_transactions/moduleSelected/{moduleSelected}', array(
			   
		'as'			=> 'security.roles_transactions.module_selected',
		'uses' 			=> 'RoleTransactionController@getTransactionsByModuleSelected'
	));

	Route::get('security/roles_transactions/transactionActions', array(
			   
		'as'			=> 'security.roles_transactions.transactionActions',
		'uses' 			=> 'RoleTransactionController@getTransactionActionsByTransactionSelected'
	));

	Route::resource('security/roles_transactions', 'RoleTransactionController', array(
	    'names' => array(
			'index'   => 'security.roles_transactions.index',
			'create'  => 'security.roles_transactions.create',
			'store'   => 'security.roles_transactions.store',
			'show'    => 'security.roles_transactions.show',
			'edit'    => 'security.roles_transactions.edit',
			'update'  => 'security.roles_transactions.update',
			'destroy' => 'security.roles_transactions.destoy'
	    )
	));


	
});



