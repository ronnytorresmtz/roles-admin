<?php


//Steps to Add a Field after run CrudVue:make


1) {Model}View file - modifify columns_names.  
					  modify input_fields.


2) Migration File - 	modify create_table file.
						modify seeder file.


3) Language File - 		modify validation.php file 
						modify Traslation.vue file.


4) Repository File -	modify store methods.
						modify update methods.
						modify importFile methods.


5) Module file - 		modify getInputRules method.


6) Execute - 			php artisan migration:refresh.
						php artisan db:seed.

7) Validation File    	modify validation.php - en and sp


