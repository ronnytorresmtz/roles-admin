<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('dashboard/assets', 'ProgramController', array(
	    'names' => array(
			'index'   => 'dashboard.assets.index',
			'create'  => 'dashboard.assets.create',
			'store'   => 'dashboard.assets.store',
			'show'    => 'dashboard.assets.show',
			'edit'    => 'dashboard.assets.edit',
			'update'  => 'dashboard.assets.update',
			'destroy' => 'dashboard.assets.destoy'
	    )
	));

	
});

