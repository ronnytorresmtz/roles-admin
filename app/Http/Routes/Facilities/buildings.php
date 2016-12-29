<?php

Route::group(array('middleware' => 'auth'), function(){

	// Dummy Routes needs to be replace
	Route::resource('facilities/buildings', 'CampusController', array(
	    'names' => array(
			'index'   => 'facilities.buildings.index',
			'create'  => 'facilities.buildings.create',
			'store'   => 'facilities.buildings.store',
			'show'    => 'facilities.buildings.show',
			'edit'    => 'facilities.buildings.edit',
			'update'  => 'facilities.buildings.update',
			'destroy' => 'facilities.buildings.destoy'
	    )
	));

});

