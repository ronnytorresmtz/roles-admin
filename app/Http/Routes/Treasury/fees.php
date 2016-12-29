<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('treasury/fees', 'ProgramController', array(
	    'names' => array(
			'index'   => 'treasury.fees.index',
			'create'  => 'treasury.fees.create',
			'store'   => 'treasury.fees.store',
			'show'    => 'treasury.fees.show',
			'edit'    => 'treasury.fees.edit',
			'update'  => 'treasury.fees.update',
			'destroy' => 'treasury.fees.destoy'
	    )
	));

	
});

