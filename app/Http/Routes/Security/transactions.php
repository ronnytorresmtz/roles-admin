<?php

Route::group(array('middleware' => 'auth'), function(){
	
	Route::get('security/transactions/search', array(
		'as'			=> 'security.transactions.search',
		'uses' 		=> 'TransactionController@getSearch'
	));

	Route::get('security/transactions/export', array(
		'as'			=> 'security.transactions.export',
		'uses' 		=> 'TransactionController@getExport'
	));

	Route::get('security/transactions/import_file', array(
		'as'			=> 'security.transactions.import_file',
		'uses' 		=> 'TransactionController@getSelectImportFile'
	));

	Route::post('security/transactions/import', array(
		'as'			=> 'security.transactions.import',
		'uses' 		=> 'TransactionController@postImport'
	));

	Route::get('security/transactions/getAllTransactionsActive', array(
		'as'			=> 'security.transactions.getAllTransactionsActive',
		'uses' 		=> 'TransactionController@getAllTransactionsActive'
	));

	Route::get('security/transactions/getAllTransactionsActivebyPage', array(
		'as'			=> 'security.transactions.getAllTransactionsActivebyPage',
		'uses' 		=> 'TransactionController@getAllTransactionsActivebyPage'
	));

	Route::resource('security/transactions', 'TransactionController', array(
	    'names' => array(
			'index'   => 'security.transactions.index',
			'create'  => 'security.transactions.create',
			'store'   => 'security.transactions.store',
			'show'    => 'security.transactions.show',
			'edit'    => 'security.transactions.edit',
			'update'  => 'security.transactions.update',
			'destroy' => 'security.transactions.destoy'
	    )
	));
	
});