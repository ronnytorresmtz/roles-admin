<?php

FORM COMPONENT
=====================

+select without father
 "2": {
	"type": "select",
	"name": "module_name",
	"value": "", 
	"label": "Module Name", 
	"required": "true",	
	"url": "security/modules/getAllModulesActive",
	"table": "modules"
 },
+select with father
 "3": {
	"type": "select",
	"name": "transaction_name",
	"value": "", 
	"label": "Transaction Name", 
	"required": "true",	
	"url": "security/roles_transactions/moduleSelected",
	"table": "transactions",
	"selectFather": "module_name",
	"selectFatherId": "1"
 },

+simple text input
"4": {
	"type": "text",
	"name": "transaction_description",
	"value": "", 
	"label": "Transaction Description", 
	"readonly": "readonly"	
} 

+add a ckeckbox in the form
"5": {
    "type": "checkbox",
    "name": "chkCloseAfterSave",
    "value": "", 
    "label": "Close After Action", 
    "required": "false",	
    "maxlength": ""
} 


CRUDTABLE COMPONENT
====================

+add icon links in the table
icon-info='{
		"0": { "url": "#", "name":"truck", "title":"List Of....", "icon": "fa fa-file-text-o", "text":""},
		"1": { "url": "#", "name":"truck", "title":"List Of....", "icon": "fa fa-truck", "text":""},
		"2": { "url": "#", "name":"truck", "title":"List Of....", "icon": "fa fa-road", "text":""}
}'

+add action icons in the table
icon-actions='{
		"0": { "url": "/users", "name":"truck", "title":"List Of....", "icon": "fa fa-user", "text":""},
		"1": { "url": "#", "name":"truck", "title":"List Of....", "icon": "fa fa-comment-o", "text":""},
		"2": { "url": "#", "name":"truck", "title":"List Of....", "icon": "fa fa-map-marker", "text":""},
		"3": { "url": "#", "name":"user", "title":"List Of....", "icon": "fa fa-trash", "text":""}
}'