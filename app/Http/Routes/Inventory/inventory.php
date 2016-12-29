<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('inventory/inventory', 'ProgramController', array(
	    'names' => array(
			'index'   => 'inventory.inventory.index',
			'create'  => 'inventory.inventory.create',
			'store'   => 'inventory.inventory.store',
			'show'    => 'inventory.inventory.show',
			'edit'    => 'inventory.inventory.edit',
			'update'  => 'inventory.inventory.update',
			'destroy' => 'inventory.inventory.destoy'
	    )
	));

	
});

