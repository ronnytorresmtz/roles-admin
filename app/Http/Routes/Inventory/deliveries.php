<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('inventory/deliveries', 'ProgramController', array(
	    'names' => array(
			'index'   => 'inventory.deliveries.index',
			'create'  => 'inventory.deliveries.create',
			'store'   => 'inventory.deliveries.store',
			'show'    => 'inventory.deliveries.show',
			'edit'    => 'inventory.deliveries.edit',
			'update'  => 'inventory.deliveries.update',
			'destroy' => 'inventory.deliveries.destoy'
	    )
	));

	
});

