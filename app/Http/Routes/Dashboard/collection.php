<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('dashboard/collection', 'ProgramController', array(
	    'names' => array(
			'index'   => 'dashboard.collection.index',
			'create'  => 'dashboard.collection.create',
			'store'   => 'dashboard.collection.store',
			'show'    => 'dashboard.collection.show',
			'edit'    => 'dashboard.collection.edit',
			'update'  => 'dashboard.collection.update',
			'destroy' => 'dashboard.collection.destoy'
	    )
	));

	
});

