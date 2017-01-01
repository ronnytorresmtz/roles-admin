
<style scoped>

 
</style>

<template>
  <div>
 <mypopup slot="message"></mypopup>
 <myimport slot="modal-import" url-import="security/roles/import"></myimport>
	<!--mytopmenu></mytopmenu-->
	<div class="container-fluid">
		<div class="row">
			<!--<div class="col-sm-2">
				<mysubmenu submenu= "security"></mysubmenu>
			</div>-->
		
			<div class="col-sm-12">

				<mycrudtable  

						table-id="table1"
						
						table-title="Role List" 

						select-fields='{	}'
									
						columns-names='{
								"0": { "name": "id", "width":"10%"},
								"1": { "name": "rolName", "width":"25%"},
								"2": { "name": "rolDescription" , "width":"50%"},
								"3": { "name": "status", "width":"10%"},
								"4": { "name": "createdBy", "width":"15%"},
								"5": { "name": "updatedBy", "width":"25%"}
						}' 
						
						url="security/roles"

						icon-info='{ }'
						icon-actions='{ }'

						>
						
				
						<mycrudbuttons
							slot="crud" 
							url-export="security/roles/export"
							btn-actions='{
         						"0": {"title": "Add",    "method": "Add",    "disabled": false},
        						"1": {"title": "Export", "method": "Export", "disabled": false}, 
        						"2": {"title": "Import", "method": "Import", "disabled": false}        				
        			}'
						>
						</mycrudbuttons>
						
						<mycrudform 
							slot="forma" 

							url="security/roles"

							form-title="Role"

							input-fields='{
									"0": {
										"type": "text",
										"name": "id",
										"value": "", 
										"label": "Id",	
										"placeholder":"",
										"readonly":"true",
										"required": "true",	
										"maxlength": ""
									},

									"1": {
										"type": "text",
										"name": "role_name",
										"value": "", 
										"label": "Role Name", 
										"placeholder":"Type the Role Name",
										"required": "true",	
										"maxlength": ""
									},

									"2": {
										"type": "textarea",
										"name": "role_description",
										"value": "", 
										"label": "Role Description", 
										"placeholder":"Type the Role Description",
										"required": "true",	
										"maxlength": ""
									 },

									"3": {
										"type": "status",
										"name": "deleted_at",
										"label": "Status"
									 }
									
								}'
						>
						</mycrudform>
				</mycrudtable>
			<div>
		</div>
	</div>
 </div>
</template>


<script 

src="../parent.js" type="text/javascript">
	
</script>

<!--//Exemple of how to integrate icon to the table to link other pages
icon-info='{
		"0": { "url": "#", "name":"truck", "title":"List Of....", "icon": "fa fa-file-text-o", "text":""},
		"1": { "url": "#", "name":"truck", "title":"List Of....", "icon": "fa fa-truck", "text":""},
		"2": { "url": "#", "name":"truck", "title":"List Of....", "icon": "fa fa-road", "text":""}
}'

icon-actions='{
		"0": { "url": "/users", "name":"truck", "title":"List Of....", "icon": "fa fa-user", "text":""},
		"1": { "url": "#", "name":"truck", "title":"List Of....", "icon": "fa fa-comment-o", "text":""},
		"2": { "url": "#", "name":"truck", "title":"List Of....", "icon": "fa fa-map-marker", "text":""},
		"3": { "url": "#", "name":"user", "title":"List Of....", "icon": "fa fa-trash", "text":""}
}'-->

<!-- Example to add a checkbox in the form
	"5": {
		"type": "checkbox",
		"name": "chkCloseAfterSave",
		"value": "", 
		"label": "Close After Action", 
		"required": "false",	
		"maxlength": ""
	} -->
