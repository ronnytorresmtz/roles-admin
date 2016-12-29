<?php

 MEGACAMPUS COMMANDS REFERECES
===============================

* clean:data   		Delete old data from users_action_log
* crud:simple   	Create a general CRUD funcionality
* crud:delete       Delete a general CRUD funcionality



-----'INSTRUCTIONS TO EXECUTE --> crud:simple' -----
//Pay attention to the console instrucción ("IMPORTANT section")
Steps:

1) Run the crud generation

	'php artisan crud:simple'

7) Read the questions carefully from the console displays, answer them

8) Read the console Outputs, take the url displayed.

9) Goes to the {menu}_left_opcions.blade.php in the {model} view directory to add the url mentioned in point 8.

10) Goes to the {menu}_left_opcions.blade.php in layout directory to add the url mentioned in point 8.

11) Change the Spahish traslations at the end of the file of fields.php, labels.php, validation.php

12) Tested to see the magic!!!


-----'INSTRUCTIONS TO EXECUTE --> crud:delete' -----
// Should be really sure to execute this because it delete all files of a Model

1) Run the crud generation

	'php artisan crud:delete'

2) Read the questions carefully that the console displays, answer them

3) Read the console Outputs, section wiht a phrase IMPORTANT

4) IMPORTANT: Rollback Manually the Lang Files (field.php, labels.php, validation.php) from the templates directory (OldLang directory)

5) IMPORTANT: Rollback Manually the AppServiceProvider File from the templates directory (OldAppServiceProvider)

6) For the Lag Files and AppServiceProvider File mentioned in point 4,5 take away the datetime added to the file when it was backuped

7) Done!!!