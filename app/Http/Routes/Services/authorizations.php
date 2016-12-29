<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('services/authorizations', 'ProgramController', array(
	    'names' => array(
			'index'   => 'services.authorizations.index',
			'create'  => 'services.authorizations.create',
			'store'   => 'services.authorizations.store',
			'show'    => 'services.authorizations.show',
			'edit'    => 'services.authorizations.edit',
			'update'  => 'services.authorizations.update',
			'destroy' => 'services.authorizations.destoy'
	    )
	));

	
});

