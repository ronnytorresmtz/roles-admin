<?php

Route::group(array('middleware' => 'auth'), function(){

	// Dummy Routes needs to be replace
	Route::resource('facilities/classrooms', 'CampusController', array(
	    'names' => array(
			'index'   => 'facilities.classrooms.index',
			'create'  => 'facilities.classrooms.create',
			'store'   => 'facilities.classrooms.store',
			'show'    => 'facilities.classrooms.show',
			'edit'    => 'facilities.classrooms.edit',
			'update'  => 'facilities.classrooms.update',
			'destroy' => 'facilities.classrooms.destoy'
	    )
	));

});

