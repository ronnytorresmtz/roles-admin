
<style scoped>

 
</style>

<template>
  <div>
 <mypopup slot="message"></mypopup>
 <myimport slot="modal-import" url-import="menuTemplate/modelTemplates/import"></myimport>

	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-2">
				<mysubmenu submenu= "menuTemplate"></mysubmenu>
			</div>
		
			<div class="col-sm-10">
				
				<mytable  

						table-title="ucfirstModelTemplate List" 

						select-fields='{ }'
									
						columns-names='{
								"0": { "name": "id", "width":"10%"},
								"1": { "name": "modelTemplateName", "width":"25%"},
								"2": { "name": "modelTemplateDescription" , "width":"50%"},
								"3": { "name": "status", "width":"10%"},
								"4": { "name": "createdBy", "width":"15%"},
								"5": { "name": "updatedBy", "width":"25%"}
						}' 
						
						url="menuTemplate/modelTemplates"


						icon-info='{ }'


						icon-actions='{ }'

						>
						
				
						<mycrud 
							slot="crud" 
							url-export="menuTemplate/modelTemplates/export"
							btn-actions='{
         						"0": {"title": "Add",    "method": "Add",    "disabled": false},
        						"1": {"title": "Export", "method": "Export", "disabled": false}, 
        						"2": {"title": "Import", "method": "Import", "disabled": false}        				
        			}'
						>
						</mycrud>
						
						<myform 
							slot="forma" 

							url="menuTemplate/modelTemplates"

							form-title="ucfirstModelTemplate"

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
										"name": "modelTemplate_name",
										"value": "", 
										"label": "ucfirstModelTemplate Name", 
										"placeholder":"Type the ucfirstModelTemplate Name",
										"required": "true",	
										"maxlength": ""
									},

									"2": {
										"type": "textarea",
										"name": "modelTemplate_description",
										"value": "", 
										"label": "ucfirstModelTemplate Description", 
										"placeholder":"Type the ucfirstModelTemplate Description",
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


<!-- ======= PROPS TO DISPLAY ICON LINKS IN THE TABLE============-->

<!-- icon-info='{
		"0": { "url": "#", "name":"truck", "title":"List Of....", "icon": "fa fa-file-text-o", "text":""},
		"1": { "url": "#", "name":"truck", "title":"List Of....", "icon": "fa fa-truck", "text":""},
		"2": { "url": "#", "name":"truck", "title":"List Of....", "icon": "fa fa-road", "text":""}
}'


icon-actions='{
		"0": { "url": "/users", "name":"truck", "title":"List Of....", "icon": "fa fa-user", "text":""},
		"1": { "url": "#", "name":"truck", "title":"List Of....", "icon": "fa fa-comment-o", "text":""},
		"2": { "url": "#", "name":"truck", "title":"List Of....", "icon": "fa fa-map-marker", "text":""},
		"3": { "url": "#", "name":"user", "title":"List Of....", "icon": "fa fa-trash", "text":""}
}' -->
