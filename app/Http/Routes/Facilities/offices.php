<?php

Route::group(array('middleware' => 'auth'), function(){

	// Dummy Routes needs to be replace
	Route::resource('facilities/offices', 'CampusController', array(
	    'names' => array(
			'index'   => 'facilities.offices.index',
			'create'  => 'facilities.offices.create',
			'store'   => 'facilities.offices.store',
			'show'    => 'facilities.offices.show',
			'edit'    => 'facilities.offices.edit',
			'update'  => 'facilities.offices.update',
			'destroy' => 'facilities.offices.destoy'
	    )
	));

});

