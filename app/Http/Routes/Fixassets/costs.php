<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('fixassets/costs', 'ProgramController', array(
	    'names' => array(
			'index'   => 'fixassets.costs.index',
			'create'  => 'fixassets.costs.create',
			'store'   => 'fixassets.costs.store',
			'show'    => 'fixassets.costs.show',
			'edit'    => 'fixassets.costs.edit',
			'update'  => 'fixassets.costs.update',
			'destroy' => 'fixassets.costs.destoy'
	    )
	));

	
});

