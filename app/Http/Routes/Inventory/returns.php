<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('inventory/returns', 'ProgramController', array(
	    'names' => array(
			'index'   => 'inventory.returns.index',
			'create'  => 'inventory.returns.create',
			'store'   => 'inventory.returns.store',
			'show'    => 'inventory.returns.show',
			'edit'    => 'inventory.returns.edit',
			'update'  => 'inventory.returns.update',
			'destroy' => 'inventory.returns.destoy'
	    )
	));

	
});

