<!DOCTYPE html>
<html>
		<meta name="viewport" content="width=device-width, initial-scale=1">
    <head>
      <title>TEST</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <body>
			<div id="app">
				<mypopup slot="message"></mypopup>
				<mytopmenu></mytopmenu>
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-2">
							<mysubmenu></mysubmenu>
							<pre>@{{ $data | json }}</pre>
						</div>
					
						<div class="col-sm-10">
							
							<mytable  table-title="Plan List" 
												
												columns-names='{
														"0": { "name": "Id", "width":"10%"},
														"1": { "name": "Plan Id", "width":"15%"},
														"2": { "name": "Plan Name", "width":"25%"},
														"3": { "name": "Plan Description" , "width":"50%"}
												}' 
												
												url-resource="/plan">
							
									<mycrud slot="crud"></mycrud>
									
									<myform 
										slot="forma" 

										form-title="Plan",

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
													"name": "pland",
													"value": "", 
													"label": "Plan Id",	
													"placeholder":"Type the Plan ID",
													"required": "true",	
													"maxlength": ""
												},

												"2": {
													"type": "text",
													"name": "planName",
													"value": "", 
													"label": "Plan Name", 
													"placeholder":"Type the Plan Name",
													"required": "true",	
													"maxlength": ""
												},

												"3": {
													"type": "textarea",
													"name": "planDescription",
													"value": "", 
													"label": "Plan Description", 
													"placeholder":"Type the Plan Description",
													"required": "true",	
													"maxlength": ""
												 },

												"4": {
													"type": "checkbox",
													"name": "chkCloseAfterSave",
													"value": "", 
													"label": "Close After Action", 
													"required": "false",	
													"maxlength": ""
												}
											}'
									>
									</myform>
							</mytable>
						<div>
					</div>
				</div>
			</div>
    </body>

	{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.16/vue.js"></script>--}}
	
   <script src="js/main.js"></script>
    
</html>
