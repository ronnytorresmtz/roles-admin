<?php

Route::group(array('middleware' => 'auth'), function(){
	
	//Dummy routes
	Route::resource('dashboard/achievement', 'ProgramController', array(
	    'names' => array(
			'index'   => 'dashboard.achievement.index',
			'create'  => 'dashboard.achievement.create',
			'store'   => 'dashboard.achievement.store',
			'show'    => 'dashboard.achievement.show',
			'edit'    => 'dashboard.achievement.edit',
			'update'  => 'dashboard.achievement.update',
			'destroy' => 'dashboard.achievement.destoy'
	    )
	));

	
});

