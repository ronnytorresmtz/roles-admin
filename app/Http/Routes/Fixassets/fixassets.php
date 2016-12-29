<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('fixassets/fixassets', 'ProgramController', array(
	    'names' => array(
			'index'   => 'fixassets.fixassets.index',
			'create'  => 'fixassets.fixassets.create',
			'store'   => 'fixassets.fixassets.store',
			'show'    => 'fixassets.fixassets.show',
			'edit'    => 'fixassets.fixassets.edit',
			'update'  => 'fixassets.fixassets.update',
			'destroy' => 'fixassets.fixassets.destoy'
	    )
	));

	
});

