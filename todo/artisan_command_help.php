<?php

=====================
  ARTISAN COMMANDS
=====================


//------Generate migration with schema and the model files---------
php artisan make:migration:schema --schema=schema_modules --model=module create_modules_table
		
		run -->  composer dump-autoload -o

//-----------------------------------------------------------------

//------Generate migration with pivot tables
php artisan make:migration:pivot roles transactions

//------Execute all migrations and seed the tables---------
php artisan migrate:refresh --seed




