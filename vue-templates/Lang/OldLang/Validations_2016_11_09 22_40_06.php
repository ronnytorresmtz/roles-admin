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
	"string"               => "The :attribute must be at least :min characters.",
	"array"                => "The :attribute must have at least :min items.",
	),
	"not_in"               => "The selected :attribute is invalid.",
	"numeric"              => "The :attribute must be a number.",
	"regex"                => "The :attribute format is invalid.",
	"required"             => "The :attribute field is required.",
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
	|
	|	'custom' => array(
	|		'attribute-name' => array(
	|			'rule-name' => 'custom-message',
	|		),
	|	),
	*/
		
	'login'                              => array(
	
	'email.required'                     => 'The Email field is required',
	'remember_security_number.required'  => 'The Security Code field is required',
	'new_password.required'              => 'The New Password field is required',
	'new_password_confirmation.required' => 'The Confirmation Password field is required',
	'new_password.confirmed'             => 'The Confirmation Password field does not match with the New Password field',
	),
	
	'programs'                           => array(
	
	'program_id.required'                => 'The program id field is required.',
	'program_name.required'              => 'The program name field is required',
	'program_description.required'       => 'The program description field is required',
	),

	'users'                              => array(
	
	'person_id.required'                 => 'The person_id field is required',
	'user_name.required'          		 => 'The user_name field is required',
	'password.required'          		 => 'The password field is required',
	),
	
	'roles'                              => array(
	
	'role_name.required'                 => 'The role name field is required',
	'role_description.required'          => 'The role description field is required',
	),
	
	'modules'                            => array(
	
	'module_name.required'               => 'The module name field is required',
	'module_description.required'        => 'The module description field is required',
	),
	
	
	'transactions'                       => array(
	
	'module_name.required'               => 'The module name field is required',
	'transaction_name.required'          => 'The transaction name field is required',
	'transaction_description.required'   => 'The transaction description field is required',
	),

	'roles_transactions'                 => array(
	
	'role_name.required'              	 => 'The role name field is required',
	'transaction_name.required'          => 'The transaction name field is required',
	'transaction_action_name.required'   => 'The access right field is required',
	),

	'institutes'                         => array(
	
	'institute_short_name.required'      => 'The institute name field is required',
	'institute_long_name.required'       => 'The institute description field is required',
	),

	'configurations'                      => array(
	
	'configuration_name.required'        => 'The configuration name field is required',
	'configuration_description.required' => 'The configuration description field is required',
	),
	
	'campuss'                      => array(
	
	'campus_name.required'        => 'The campus name field is required',
	'campus_description.required' => 'The campus description field is required',
	),
	
	'countries'                      => array(
	
	'country_name.required'        => 'The country name field is required',
	'country_description.required' => 'The country description field is required',
	),
	
	'states'                      => array(
	
	'state_name.required'        => 'The state name field is required',
	'state_description.required' => 'The state description field is required',
	),
	
	'cities'                      => array(
	
	'city_name.required'        => 'The city name field is required',
	'city_description.required' => 'The city description field is required',
	),
	
	'languages'                      => array(
	
	'language_name.required'        => 'The language name field is required',
	'language_description.required' => 'The language description field is required',
	),
	
	'plans'                      => array(
	
	'plan_name.required'        => 'The plan name field is required',
	'plan_description.required' => 'The plan description field is required',
	),
	
	'companies'                      => array(
	
	'company_name.required'        => 'The company name field is required',
	'company_description.required' => 'The company description field is required',
	),

	'customers'                      => array(
	
	'customer_name.required'        => 'The customer name field is required',
	'customer_description.required' => 'The customer description field is required',
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
