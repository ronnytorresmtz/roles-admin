<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('fixassets/check_in', 'ProgramController', array(
	    'names' => array(
			'index'   => 'fixassets.check_in.index',
			'create'  => 'fixassets.check_in.create',
			'store'   => 'fixassets.check_in.store',
			'show'    => 'fixassets.check_in.show',
			'edit'    => 'fixassets.check_in.edit',
			'update'  => 'fixassets.check_in.update',
			'destroy' => 'fixassets.check_in.destoy'
	    )
	));

	
});

