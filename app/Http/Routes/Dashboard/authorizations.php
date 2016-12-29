<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('dashboard/authorizations', 'ProgramController', array(
	    'names' => array(
			'index'   => 'dashboard.authorizations.index',
			'create'  => 'dashboard.authorizations.create',
			'store'   => 'dashboard.authorizations.store',
			'show'    => 'dashboard.authorizations.show',
			'edit'    => 'dashboard.authorizations.edit',
			'update'  => 'dashboard.authorizations.update',
			'destroy' => 'dashboard.authorizations.destoy'
	    )
	));

	
});

