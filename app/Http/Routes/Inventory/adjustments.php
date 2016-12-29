<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('inventory/adjustments', 'ProgramController', array(
	    'names' => array(
			'index'   => 'inventory.adjustments.index',
			'create'  => 'inventory.adjustments.create',
			'store'   => 'inventory.adjustments.store',
			'show'    => 'inventory.adjustments.show',
			'edit'    => 'inventory.adjustments.edit',
			'update'  => 'inventory.adjustments.update',
			'destroy' => 'inventory.adjustments.destoy'
	    )
	));

	
});

