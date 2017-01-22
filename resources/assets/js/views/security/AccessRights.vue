
<style scoped>
 
</style>

<template>
  <div>
  <mypopup slot="message"></mypopup>
	<myimport slot="modal-import" url-import="secutiry/roles_transactions/import"></myimport>
	<mytopmenu></mytopmenu> 
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-2">
				<mysubmenu submenu= "security"></mysubmenu>
			</div>
		
			<div class="col-sm-10">

				<mymessage 
					message="This options allows to set the access rights for each role at transaction level for each module."
					color="info"
					align="center"
				>
				</mymessage>

				<mycrudtable  
				
						table-id="table1"

						table-title="Access Rights List" 

						select-fields='{

							"0": {
								"type": "select",
								"name": "role_name",
								"value": "", 
								"label": "Role Name", 
								"required": "true",	
								"url": "security/roles/getAllRolesActivebyPage",
								"table": "roles"
							}

						}'

						columns-names='{
								"0": { "name": "id", "width":"10%"},
								"1": { "name": "roleName", "width":"10%"},
								"2": { "name": "moduleName", "width":"10%"},
								"3": { "name": "transactionName", "width":"10%"},
								"4": { "name": "transactionDescription" , "width":"30%"},
								"5": { "name": "transactionActionName" , "width":"10%"},
								"6": { "name": "createdBy", "width":"10%"},
								"7": { "name": "updatedBy", "width":"10%"}
						}' 
						
						url="security/roles_transactions"

						icon-info='{	}'
						icon-actions='{		}'
						>
				
						<mycrudbuttons
							slot="crud" 
							url-export="security/roles_transactions/export" 
							btn-actions='{
         						"0": {"title": "Add",    "method": "Add",    "disabled": false},
          						"1": {"title": "Export", "method": "Export", "disabled": false}, 
          						"2": {"title": "Import", "method": "Import", "disabled": false}
        					}'
        				>
						</mycrudbuttons>
						
						<mycrudform 
							slot="forma" 

							url="security/roles_transactions"

							form-title="Access Rights"

							input-fields='{
									"0": {
										"type": "text",
										"name": "id",
										"value": "", 
										"label": "Id",	
										"placeholder":"",
										"readonly":"true",
										"required": "true"
									},

									"1": {
										"type": "select",
										"name": "role_name",
										"value": "", 
										"label": "Role Name", 
										"required": "true",	
										"url": "security/roles/getAllRolesActive",
										"table": "roles"
									 },

									"2": {
										"type": "select",
										"name": "module_name",
										"value": "", 
										"label": "Module Name", 
										"required": "true",	
										"url": "security/modules/getAllModulesActive",
										"table": "modules"
									 },

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

									 "4": {
										"type": "hidden",
										"name": "transaction_description",
										"value": "", 
										"label": "Transaction Description", 
										"readonly":"true"	
									 }, 


									 "5": {
										"type": "select",
										"name": "transaction_action_name",
										"value": "", 
										"label": "Transaction Action", 
										"required": "true",	
										"url": "security/roles_transactions/transactionActions",
										"table": "transactions_actions"
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

