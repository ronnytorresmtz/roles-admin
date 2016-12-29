<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('treasury/invoicing', 'ProgramController', array(
	    'names' => array(
			'index'   => 'treasury.invoicing.index',
			'create'  => 'treasury.invoicing.create',
			'store'   => 'treasury.invoicing.store',
			'show'    => 'treasury.invoicing.show',
			'edit'    => 'treasury.invoicing.edit',
			'update'  => 'treasury.invoicing.update',
			'destroy' => 'treasury.invoicing.destoy'
	    )
	));

	
});

