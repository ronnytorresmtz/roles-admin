
<style scoped>

	.link-space {
		padding-right: 40px;
	}
 
</style>

<template>

<div>
 	<mypopup slot="message"></mypopup>
	<myimport slot="modal-import" url-import="security/modules/import"></myimport>

	<div class="container-fluid" >
		<div class="row" >
			<!--<div class="col-sm-2">
				<mysubmenu submenu= "security"></mysubmenu>
			</div>-->
			<div class="col-sm-12" >
				<p class="bg-info" align="center">
		      <br>
		        This option allows to follow up how the users use the system and how many times they logged.
		      <br><br>
	    	</p>

				<myhorizontallinks name="horizontal-links"></myhorizontallinks>

	    	<div class="row" style="padding:0px">
					<div class="col-sm-12" style="padding:0px">
					 
					  <div style="padding-left:10px;padding-right:20px">
					  
					  	<mychart 
					  		id="Chart1"
					  		type="spline"
					  		width="500"
					  		height="250"
							url="/security/dashboard/transactionsUsedByDay"
							title="Transactions Used by Day"
							x-title="Days"
							y-title="Transactiones Used"
							legend-position="bottom"
							legend-display="false"
							show-year="true"
							show-month="true"
					  	>

					  	</mychart>

					 	</div>
					</div>
				</div>
				
				<div class="row" style="padding:0px">
					<div class="col-sm-12" >
					 
						<mytableyearmonth  

							table-id="table1"

							table-title="Transactions Used" 

							columns-names='{
								"0": { "name": "moduleName", "width":"25%"},
								"1": { "name": "transactionName" , "width":"50%"},
								"2": { "name": "clicks" , "width":"50%"}
									
							}' 
							
							url="security/dashboard/transactionsUsed"

							icon-info='{ }'

							icon-actions='{ }'

							show-year ="true"

							show-month = "true"

							>

							</mytableyearmonth>

						</div>
					
				</div>

				<div class="row" style="padding:0px">
					<div class="col-sm-12" style="padding:0px">
					 
					  <div style="padding-left:10px;padding-right:20px">
					  
					  	<mychart 
					  		id="Chart2"
					  		type="column"
					  		width="500"
					  		height="250"
							url="/security/dashboard/transactionsUsedByMonth"
							title="Transactions Used by Month"
							x-title="Days"
							y-title="Transactions Used"
							legend-position="top"
							legend-display="false"
							show-year="true"
							show-month="false"
					  	>
					  	</mychart>

					 	</div>
					</div>
				</div>


			</div>		
		</div>		
	</div>
</div>
</template>


<script 

src="../parent.js" type="text/javascript">
	
</script>



										