
<style scoped>
 
</style>

<template>
  <div>
  <mypopup slot="message"></mypopup>
	<myimport slot="modal-import" url-import="facilities/campuss/import"></myimport>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-2">
				<mysubmenu submenu= "facilities"></mysubmenu>
				
			</div>
		
			<div class="col-sm-10">
				
				<mytable  table-title="Campus List" 

						select-fields='{}'
									
						columns-names='{
								"0": { "name": "id", "width":"10%"},
								"1": { "name": "campusId", "width":"15%"},
								"2": { "name": "campusName", "width":"25%"},
								"3": { "name": "campusDescription" , "width":"50%"},
								"4": { "name": "status", "width":"10%"},
								"5": { "name": "createdBy", "width":"15%"},
								"6": { "name": "updatedBy", "width":"25%"}
						}' 
						
						url="facilities/campuss">
				
						<mycrud 
							slot="crud" 
							url-export="facilities/campuss/export"
							btn-actions='{
         						"0": {"title": "Add",    "method": "Add",    "disabled": false},
          						"1": {"title": "Export", "method": "Export", "disabled": false}, 
          						"2": {"title": "Import", "method": "Import", "disabled": false}
        					}'
						>
						</mycrud>
						
						<myform 
							slot="forma" 

							url="facilities/campuss"

							form-title="Campus"

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
										"name": "campus_id",
										"value": "", 
										"label": "Campus Id",	
										"placeholder":"Type the Campus ID",
										"required": "true",	
										"maxlength": ""
									},

									"2": {
										"type": "text",
										"name": "campus_name",
										"value": "", 
										"label": "Campus Name", 
										"placeholder":"Type the Campus Name",
										"required": "true",	
										"maxlength": ""
									},

									"3": {
										"type": "textarea",
										"name": "campus_description",
										"value": "", 
										"label": "Campus Description", 
										"placeholder":"Type the Campus Description",
										"required": "true",	
										"maxlength": ""
									 },

									 "4": {
										"type": "status",
										"name": "deleted_at",
										"label": "Status"
									 }

								}'
						>
						</myform>
				</mytable>
			<div>
		</div>
	</div>
 </div>
</template>

<script 

src="../parent.js" type="text/javascript">
	
</script>
