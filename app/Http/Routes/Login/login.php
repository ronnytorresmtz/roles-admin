
<?php

Route::group(array('middleware' => 'guest'), function(){
	
	Route::get('/', array(

		'as' 			=> '/', 
		'uses'			=> 'LoginController@getLogIn'
	));	

	Route::get('/login', array( 

		'as' 			=> 'login', 
		'uses'			=> 'LoginController@getLogIn'
	));

});


Route::group(array('middleware' => 'auth'), function(){

	Route::get('login/logOut', array(

		'as' 			=> 'login.logOut', 
		'uses' 			=> 'LoginController@getLogOut'
	));
});


Route::post('login/logIn', array(

	'as' 			=> 'login.logIn', 
	'uses'			=> 'LoginController@postLogIn'
));	


// Route::get('login/forgotYourPassword', array(

// 	'as'			=> 'login.forgotYourPassword',
// 	'uses'			=> 'LoginController@getForgotYourPassword'
// ));

Route::post('login/sendYourPassword', array(

	'as' 			=> 'login.sendYourPassword',
	'uses'			=> 'LoginController@postSendYourPassword'
));

Route::group(array('middleware' => 'token.verification'), function(){

	Route::get('login/passwordReset/{token}', array(

		'as' 			=> 'login.passwordReset',
		'uses'			=> 'LoginController@getPasswordReset'
	));
	
});


Route::post('login/resetYourPassword', array(

	'as'			=> 'login.resetYourPassword',
	'uses'			=> 'LoginController@postResetYourPassword'
));

