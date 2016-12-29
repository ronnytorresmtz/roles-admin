
<style scoped>

 
</style>

<template>
  <div>
 <mypopup slot="message"></mypopup>
 <myimport slot="modal-import" url-import="academic/plans/import"></myimport>
	<!--mytopmenu></mytopmenu-->
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-2">
				<mysubmenu submenu= "academic"></mysubmenu>
			</div>
		
			<div class="col-sm-10">
				
				<mytable  table-title="Plan List" 

						select-fields='{}'

						columns-names='{
								"0": { "name": "id", "width":"10%"},
								"1": { "name": "planId", "width":"15%"},
								"2": { "name": "planName", "width":"25%"},
								"3": { "name": "planDescription" , "width":"50%"},
								"4": { "name": "status", "width":"10%"},
								"5": { "name": "createdBy", "width":"15%"},
								"6": { "name": "updatedBy", "width":"25%"}
						}' 
						
						url="academic/plans">
				
						<mycrud 
							slot="crud" 
							url-export="academic/plans/export"
							btn-actions='{
         						"0": {"title": "Add",    "method": "Add",    "disabled": false},
          						"1": {"title": "Export", "method": "Export", "disabled": false}, 
          						"2": {"title": "Import", "method": "Import", "disabled": false}
        					}'
						>
						</mycrud>
						
						<myform 
							slot="forma" 

							url="academic/plans"

							form-title="Plan"

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
										"name": "plan_id",
										"value": "", 
										"label": "Plan Id",	
										"placeholder":"Type the Plan ID",
										"required": "true",	
										"maxlength": ""
									},

									"2": {
										"type": "text",
										"name": "plan_name",
										"value": "", 
										"label": "Plan Name", 
										"placeholder":"Type the Plan Name",
										"required": "true",	
										"maxlength": ""
									},

									"3": {
										"type": "textarea",
										"name": "plan_description",
										"value": "", 
										"label": "Plan Description", 
										"placeholder":"Type the Plan Description",
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


<!-- "5": {
		"type": "checkbox",
		"name": "chkCloseAfterSave",
		"value": "", 
		"label": "Close After Action", 
		"required": "false",	
		"maxlength": ""
	} -->