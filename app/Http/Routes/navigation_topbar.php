<?php

Route::group(array('middleware' => array('auth')), function(){

	Route::get('/home', array(

		'as'	=> 'home',
		'uses'	=> 'NavigationTopBarController@getHomeModule'
	));

	Route::get('/dashboard', array(

		'as' 	=> 'dashboard',
		'uses'	=> 'NavigationTopBarController@getDashboardModule'
	));

	Route::get('/facilities', array(

		'as'   => 'facilities',
		'uses' => 'NavigationTopBarController@getFacilitiesModule'
	));

	Route::get('/academic', array(

		'as'   => 'academic',
		'uses' => 'NavigationTopBarController@getAcademicModule'
	));

	Route::get('/resources', array(

		'as'   => 'resources',
		'uses' => 'NavigationTopBarController@getResourcesModule'
	));

	Route::get('/inventory', array(

		'as'   => 'inventory',
		'uses' => 'NavigationTopBarController@getInventoryModule'
	));
				 
	Route::get('/fixassets', array(

		'as'   => 'fixassets',
		'uses' => 'NavigationTopBarController@getFixassetsModule'
	));

	Route::get('/services', array(

		'as'   => 'services',
		'uses' => 'NavigationTopBarController@getServicesModule'
	));

	Route::get('/treasury', array(

		'as'   => 'treasury',
		'uses' => 'NavigationTopBarController@getTreasuryModule'
	));

	Route::get('/security', array(

		'as'   => 'security',
		'uses' => 'NavigationTopBarController@getSecurityModule'
	));

	Route::get('/settings', array(

		'as'   => 'settings',
		'uses' => 'NavigationTopBarController@getSettingsModule'
	));

	Route::get('/data', array(

		'as'   => 'data',
		'uses' => 'NavigationTopBarController@getDataModule'
	));

	
});