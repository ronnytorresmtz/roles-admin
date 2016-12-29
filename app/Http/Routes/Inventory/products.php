<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('inventory/products', 'ProgramController', array(
	    'names' => array(
			'index'   => 'inventory.products.index',
			'create'  => 'inventory.products.create',
			'store'   => 'inventory.products.store',
			'show'    => 'inventory.products.show',
			'edit'    => 'inventory.products.edit',
			'update'  => 'inventory.products.update',
			'destroy' => 'inventory.products.destoy'
	    )
	));

	
});

