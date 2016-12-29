<?php
Route::group(array('middleware' => 'auth'), function(){

	// Dummy Routes needs to be replace
	Route::resource('settings/task_scheduler', 'CampusController', array(
	    'names' => array(
			'index'   => 'settings.task_scheduler.index',
			'create'  => 'settings.task_scheduler.create',
			'store'   => 'settings.task_scheduler.store',
			'show'    => 'settings.task_scheduler.show',
			'edit'    => 'settings.task_scheduler.edit',
			'update'  => 'settings.task_scheduler.update',
			'destroy' => 'settings.task_scheduler.destoy'
	    )
	));

});



