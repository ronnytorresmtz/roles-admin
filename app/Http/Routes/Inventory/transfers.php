<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('inventory/transfers', 'ProgramController', array(
	    'names' => array(
			'index'   => 'inventory.transfers.index',
			'create'  => 'inventory.transfers.create',
			'store'   => 'inventory.transfers.store',
			'show'    => 'inventory.transfers.show',
			'edit'    => 'inventory.transfers.edit',
			'update'  => 'inventory.transfers.update',
			'destroy' => 'inventory.transfers.destoy'
	    )
	));

	
});

