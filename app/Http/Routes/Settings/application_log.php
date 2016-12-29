<?php

Route::group(array('middleware' => 'auth'), function(){


	Route::get('settings/application_log/index', array (

		'as'			=> 'settings.application_log.index',
		'uses' 			=> 'ApplicationLogController@index'
	));
	

	
	
});

