<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('dashboard/inventory', 'ProgramController', array(
	    'names' => array(
			'index'   => 'dashboard.inventory.index',
			'create'  => 'dashboard.inventory.create',
			'store'   => 'dashboard.inventory.store',
			'show'    => 'dashboard.inventory.show',
			'edit'    => 'dashboard.inventory.edit',
			'update'  => 'dashboard.inventory.update',
			'destroy' => 'dashboard.inventory.destoy'
	    )
	));

	
});

