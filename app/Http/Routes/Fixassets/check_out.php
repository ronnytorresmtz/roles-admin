<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('fixassets/check_out', 'ProgramController', array(
	    'names' => array(
			'index'   => 'fixassets.check_out.index',
			'create'  => 'fixassets.check_out.create',
			'store'   => 'fixassets.check_out.store',
			'show'    => 'fixassets.check_out.show',
			'edit'    => 'fixassets.check_out.edit',
			'update'  => 'fixassets.check_out.update',
			'destroy' => 'fixassets.check_out.destoy'
	    )
	));

	
});

