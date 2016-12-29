<?php

Route::group(array('middleware' => 'auth'), function(){

	// Dummy Routes needs to be replace
	Route::resource('facilities/courts', 'CampusController', array(
	    'names' => array(
			'index'   => 'facilities.courts.index',
			'create'  => 'facilities.courts.create',
			'store'   => 'facilities.courts.store',
			'show'    => 'facilities.courts.show',
			'edit'    => 'facilities.courts.edit',
			'update'  => 'facilities.courts.update',
			'destroy' => 'facilities.courts.destoy'
	    )
	));


	


});

