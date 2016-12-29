<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('treasury/payments', 'ProgramController', array(
	    'names' => array(
			'index'   => 'treasury.payments.index',
			'create'  => 'treasury.payments.create',
			'store'   => 'treasury.payments.store',
			'show'    => 'treasury.payments.show',
			'edit'    => 'treasury.payments.edit',
			'update'  => 'treasury.payments.update',
			'destroy' => 'treasury.payments.destoy'
	    )
	));

	
});

