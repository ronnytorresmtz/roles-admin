<?php

Route::group(array('middleware' => 'auth'), function(){

	// Dummy Routes needs to be replace
	Route::resource('facilities/departments', 'CampusController', array(
	    'names' => array(
			'index'   => 'facilities.departments.index',
			'create'  => 'facilities.departments.create',
			'store'   => 'facilities.departments.store',
			'show'    => 'facilities.departments.show',
			'edit'    => 'facilities.departments.edit',
			'update'  => 'facilities.departments.update',
			'destroy' => 'facilities.departments.destoy'
	    )
	));

});

