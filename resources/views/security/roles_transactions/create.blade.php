@extends('layouts.security_left_menu_options')

<!--"Programs Management"-->

@section('title')
	<title> {!!Lang::get('labels.add_role_transaction')!!}</title>
@stop


	
@section('body')

	@include('php.top_user_message', array('keyMessage' => 'topbar_message_create', 'transaction' => 'access_rights'))

	<div id="transaction-panel" class="col-sm-10 align="left"">

	    <div class="panel panel-default">

	         <div class="pull-right" style="padding:6px">
        		<button id="button-fullscreen" class="btn btn-xs btn-default" data-fullscreen="false">
        			<i id="icon-fullscreen" class="glyphicon glyphicon-align-justify" ></i>
        		</button>
        	</div>
        	
	        <div id="transaction-panel-header" class="panel-heading">
	     		 <h3 class="panel-title">{!!Lang::get('labels.add_role_transaction')!!}</h3>
			</div>           

	        <div class="panel-body">

				<div class="row">
					<!--Display a message return from the controller in the Session Object-->
					<div class="col-sm-12 text-center">

					 	@include('php.popup_message')
							
					</div>
				</div>

				@include('php.validation_message')

				{!! Form::open(array('route' => 'security.roles_transactions.store')) !!}

				  	<div class="row">
						<div class="col-sm-3 text-left">
							<div class="control-group">
								{!!Form::label(Lang::get('fields.role_name'))!!}
								{!!Form::select('role_name', 
								$roles_names, null, array('class'=>'form-control', 
								'id' => 'add_access_rights_cbo_role_name'))!!}
								
							</div>
						</div>
					</div>

					<br>
					
					<div class="row">
						<div class="col-sm-3 text-left">
							<div class="control-group">
								{!!Form::label(Lang::get('fields.module_name'))!!}				
								{!!Form::select('module_name', 
								$modules_names, null, array('class'=>'form-control', 
								'autofocus' => 'autofocus', 
								'id' => 'add_access_rights_cbo_module_name'))!!}
							</div>
						</div>
					</div>
					
					<br>

					<div class="row">
						<div class="col-sm-3 text-left">
							<div class="control-group">
								{!!Form::label(Lang::get('fields.transaction_name'))!!}	
								{!!Form::select('transaction_name', 
								$transactions_names, null, array('class'=>'form-control',
								'id' => 'add_access_rights_cbo_transaction_name'))!!}			
							</div>
						</div>
					</div>

					<br>

					<div class="row">
						<div class="col-sm-3 text-left">
							<div class="control-group">
								{!!Form::label(Lang::get('fields.transaction_action_name'))!!}	
								{!!Form::select('transaction_action_name', $transaction_actions_names, 
								null, array('class'=>'form-control'))!!}
							</div>
						</div>
					</div>
						
					<hr>

					<div class="control-group">
						{!!Form::submit(Lang::get('buttons.add'),array ('class'=>'btn btn-sm btn-primary'))!!}
				
						{!!link_to(URL::route('security.roles_transactions.role_selected', Session::get('roleIDSelected')), 
						Lang::get('buttons.back'), array('class' => 'btn btn-sm btn-primary'))!!}
						
					</div>	

				{!!  Form::close() !!}

			</div>

		</div>
	</div>
</div>

<script type="text/javascript">
	
	$(document).ready(function() {

		// Get the Sesion Key Value for the Role Name ComboBox set in the list.blade.php file and set the position of the ComboBox
		var role_name_optionId   = sessionStorage.getItem('access_rights_role_name_selected');
		if  (role_name_optionId != null){
			$('#add_access_rights_cbo_role_name').val(role_name_optionId);
		}

		var module_name_optionId = sessionStorage.getItem('access_rights_module_name_selected');
		if  (module_name_optionId != null){
			$('#add_access_rights_cbo_module_name').val(module_name_optionId);
		}

		//Set a Session Key Value for the Module Name Combobox and Get the Transaction Releated to the Module Name
		$('#add_access_rights_cbo_module_name').on('change', function() {

			var module_name_optionId = $(this).find('option:selected').val();

			loadTransactionSelectBox(module_name_optionId); //ajax call
			
			sessionStorage.setItem('access_rights_module_name_selected', module_name_optionId);

			console.log ('change module name:' + module_name_optionId);

		});
		
	});


	 function loadTransactionSelectBox(module_name_optionId){

		$.ajax({
            type: 'GET',
            url : '/security/roles_transactions/moduleSelected/' +  module_name_optionId,
            //data : dataString,
            beforeSend: function(){
            	$('#add_access_rights_cbo_transaction_name').empty();

 				$('#add_access_rights_cbo_transaction_name')
			      	.append($("<option></option>")
 					.text(' Loading...'));
            },
            success : function(data){

            	$('#add_access_rights_cbo_transaction_name').empty();

            	jQuery.each(data, function(key, value) {
            		
			      	$('#add_access_rights_cbo_transaction_name')
				      	.append($("<option></option>")
     					.attr("value", value.id)
     					.text(value.transaction_name)); 
			    });
            }
        });	
	}

</script>



@stop

