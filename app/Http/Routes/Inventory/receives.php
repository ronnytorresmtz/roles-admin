<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('inventory/receives', 'ProgramController', array(
	    'names' => array(
			'index'   => 'inventory.receives.index',
			'create'  => 'inventory.receives.create',
			'store'   => 'inventory.receives.store',
			'show'    => 'inventory.receives.show',
			'edit'    => 'inventory.receives.edit',
			'update'  => 'inventory.receives.update',
			'destroy' => 'inventory.receives.destoy'
	    )
	));

	
});

