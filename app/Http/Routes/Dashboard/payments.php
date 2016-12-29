<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('dashboard/payments', 'ProgramController', array(
	    'names' => array(
			'index'   => 'dashboard.payments.index',
			'create'  => 'dashboard.payments.create',
			'store'   => 'dashboard.payments.store',
			'show'    => 'dashboard.payments.show',
			'edit'    => 'dashboard.payments.edit',
			'update'  => 'dashboard.payments.update',
			'destroy' => 'dashboard.payments.destoy'
	    )
	));

	
});

