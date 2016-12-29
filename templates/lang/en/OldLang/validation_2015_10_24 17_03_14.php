<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/


"accepted"             => "The :attribute must be accepted.",
"active_url"           => "The :attribute is not a valid URL.",
"after"                => "The :attribute must be a date after :date.",
"alpha"                => "The :attribute may only contain letters.",
"alpha_dash"           => "The :attribute may only contain letters, numbers, and dashes.",
"alpha_num"            => "The :attribute may only contain letters and numbers.",
"array"                => "The :attribute must be an array.",
"before"               => "The :attribute must be a date before :date.",
"between"              => array(
	"numeric"              => "The :attribute must be between :min and :max.",
	"file"                 => "The :attribute must be between :min and :max kilobytes.",
	"string"               => "The :attribute must be between :min and :max characters.",
	"array"                => "The :attribute must have between :min and :max items.",
	),
"boolean"              => "The :attribute field must be true or false",
"confirmed"            => "The :attribute confirmation does not match.",
"date"                 => "The :attribute is not a valid date.",
"date_format"          => "The :attribute does not match the format :format.",
"different"            => "The :attribute and :other must be different.",
"digits"               => "The :attribute must be :digits digits.",
"digits_between"       => "The :attribute must be between :min and :max digits.",
"email"                => "The :attribute must be a valid email address.",
"exists"               => "The selected :attribute is invalid.",
"image"                => "The :attribute must be an image.",
"in"                   => "The selected :attribute is invalid.",
"integer"              => "The :attribute must be an integer.",
"ip"                   => "The :attribute must be a valid IP address.",
"max"                  => array(
	"numeric"              => "The :attribute may not be greater than :max.",
	"file"                 => "The :attribute may not be greater than :max kilobytes.",
	"string"               => "The :attribute may not be greater than :max characters.",
	"array"                => "The :attribute may not have more than :max items.",
	),
"mimes"                => "The :attribute must be a file of type: :values.",
"min"                  => array(
	"numeric"              => "The :attribute must be at least :min.",
	"file"                 => "The :attribute must be at least :min kilobytes.",
	"string"               => "El campo :attribute debe ser al menos de :min caracteres.",   //traslate
	"array"                => "The :attribute must have at least :min items.",
	),
"not_in"               => "The selected :attribute is invalid.",
"numeric"              => "The :attribute must be a number.",
"regex"                => "The :attribute format is invalid.",
"required"             => "El campo :attribute es requerido.",
"required_if"          => "The :attribute field is required when :other is :value.",
"required_with"        => "The :attribute field is required when :values is present.",
"required_with_all"    => "The :attribute field is required when :values is present.",
"required_without"     => "The :attribute field is required when :values is not present.",
"required_without_all" => "The :attribute field is required when none of :values are present.",
"same"                 => "The :attribute and :other must match.",
"size"                 => array(
	"numeric"              => "The :attribute must be :size.",
	"file"                 => "The :attribute must be :size kilobytes.",
	"string"               => "The :attribute must be :size characters.",
	"array"                => "The :attribute must contain :size items.",
	),
"unique"               => "The :attribute has already been taken.",
"url"                  => "The :attribute format is invalid.",
"timezone"             => "The :attribute must be a valid zone.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	|	'custom' => array(
	|		'attribute-name' => array(
	|			'rule-name' => 'custom-message',
	|		),
	|	),
	*/
	
	'login'                              => array(
	
	'email.required'                     => 'El campo de Cuenta de Correo es requierido',
	'remember_security_number.required'  => 'El campo de Código de Seguridad es requerido',
	'new_password.required'              => 'El campo de la Nueva Contraseña es requerida',
	'new_password_confirmation.required' => 'El campo de Confirmación de Contraseña es requerido',
	'new_password.confirmed'             => 'El campo de Confirmación de Contraseña debe ser igual a la Nueva Contraseña',
	),
	
	
	'programs'                           => array(
	
	'program_id.required'                => 'El campo programa id es requerido',
	'program_name.required'              => 'El campo nombre de programa es requerido',
	'program_description.required'       => 'El campo descripcion de programa es requerido',
	),


	'user'                              => array(
	
	'person_id.required'                 => 'El campo persona id es requerido',
	'user_name.required'          		 => 'El campo cuenta de usuario es requerido',
	'password.required'          		 => 'El campo de contraseña es requerida',
	),
	
	'roles'                              => array(
	
	'role_name.required'                 => 'El nombre del perfil es requerido',
	'role_description.required'          => 'La descripción del perfil es requerido',
	),
	
	'modules'                            => array(
	
	'module_name.required'               => 'El nombre del módulo es requerido',
	'module_description.required'        => 'La descripción del módulo es requerido',
	),
	
	'transactions'                       => array(
	
	'module_name.required'               => 'La selección del módulo es requerido',
	'transaction_name.required'          => 'El nombre de la transacción es requerida',
	'transaction_description.required'   => 'La descripción de la transacción es requerida',
	),
	
	
	'roles_transactions'                 => array(
	
	'role_name.required'                 => 'La selección del perfil es requerido',
	'transaction_name.required'          => 'La selección de la transacción es requerida',
	'transaction_action_name.required'   => 'La selección del permiso es requerido',
	),

	'institutes'                            => array(
	
	'institute_short_name.required'               => 'El nombre del módulo es requerido',
	'institute_long_name.required'        => 'La descripción del módulo es requerido',
	),

	//Validation_Template Don´t Delete This Line







	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => array(),

);
