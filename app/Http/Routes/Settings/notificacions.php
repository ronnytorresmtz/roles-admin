<?php
Route::group(array('middleware' => 'auth'), function(){

	// Dummy Routes needs to be replace
	Route::resource('settings/notifications', 'CampusController', array(
	    'names' => array(
			'index'   => 'settings.notifications.index',
			'create'  => 'settings.notifications.create',
			'store'   => 'settings.notifications.store',
			'show'    => 'settings.notifications.show',
			'edit'    => 'settings.notifications.edit',
			'update'  => 'settings.notifications.update',
			'destroy' => 'settings.notifications.destoy'
	    )
	));

});



