<?php

Route::group(array('middleware' => 'auth'), function(){

	// Dummy Routes needs to be replace
	Route::resource('facilities/warehouses', 'CampusController', array(
	    'names' => array(
			'index'   => 'facilities.warehouses.index',
			'create'  => 'facilities.warehouses.create',
			'store'   => 'facilities.warehouses.store',
			'show'    => 'facilities.warehouses.show',
			'edit'    => 'facilities.warehouses.edit',
			'update'  => 'facilities.warehouses.update',
			'destroy' => 'facilities.warehouses.destoy'
	    )
	));

});

