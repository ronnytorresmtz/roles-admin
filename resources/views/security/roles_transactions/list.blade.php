@extends('layouts.security_left_menu_options')

<!--"Access Right Management"-->

@section('title')

	<title> {!!Lang::get('labels.list_roles_transactions')!!} </title>
@stop


@section('body')

	@include('php.top_user_message', array('keyMessage' => 'topbar_message_list', 'transaction' => 'access_rights'))

	<div id="transaction-panel" class="col-sm-10" align="left">

	    <div class="panel panel-default" >
			<div class="pull-right" style="padding:6px">
        		<button id="button-fullscreen" class="btn btn-sm btn-default" data-fullscreen="false">
        			<i id="icon-fullscreen" class="glyphicon glyphicon-align-justify" ></i>
        		</button>
        	</div>

	        <div id="transaction-panel-header" class="panel-heading">
	          <h3 class="panel-title">{!!Lang::get('labels.list_roles_transactions')!!}</h3>
			</div>           

	        <div class="panel-body">
				<div class="row">
					<!--Display a message return from the controller in the Session Object-->
					<div class="col-sm-12 text-center">
							
							@include('php.popup_message')

					</div>
				</div>
					
				<div class="row">

					<!-- Form for the Search Text/Button-->
					<div class="col-sm-6 text-left">	

						    <span class="form-inline">
								{!!Form::label(Lang::get('fields.role_name')) . ':' !!}	&nbsp;	

								{!!Form::select('role_name', $roles_names, Session::get('roleIDSelected'), 
								array('class'=>'form-control','id'=>'access_rights_cbo_role_name', 'autofocus' =>'autofocus',
								'style' => 'width:200px; '))!!}
							</span>
					</div>
			
					<div class="col-sm-6 text-right">
						
						{!! Form::open(array('route'=> 'security.roles_transactions.deleteButton'))!!}			
						
								@include('php.action_buttons',array('subMenuOption' => 'security.roles_transactions'))
								
					</div>
					
					
				</div>

				<div class="table-responsive" style="white-space:nowrap;overflow-x:auto; overflow-y:auto; width:auto; height:305px; padding:0px">
					
					<table class= "table table-striped table-bordered table-condensed table-hover"> 
						<!--table-hover" -->
					    <thead>

					         <tr>
					            <!--Displays the Table Headers"-->
					             <th></th>
					            <th data-field="id">
									{!!Lang::get('fields.id')!!}
								</th>
					           
					            <th data-field="module_name">
					            	{!!Lang::get('fields.module_name')!!}
					            </th>					            
					            <th data-field="transaction_action_name">
					            	{!!Lang::get('fields.transaction_name')!!}
					            </th>
								<th data-field="transaction_description">
					            	{!!Lang::get('fields.transaction_description')!!}
					            </th>
					            <!--th  data-field="transaction_action" style="display: none">
					            	{!!Lang::get('fields.transaction_action_id')!!}
					            </th-->
					             <th  data-field="transaction_action">
					            	{!!Lang::get('fields.transaction_action_name')!!}
					            </th>
					            <th  data-field="created_at">
					            	{!!Lang::get('fields.created_at')!!}
					            </th>
					            <th data-field="updated_at">
					            	{!!Lang::get('fields.updated_at')!!}
					            </th>
					        </tr>                                       
					    </thead>

						<tbody >		

							<!-- Populate the Table Display-->
					    	@foreach($roles_transactions as $role_transaction)
							    <tr>

							    	<td style="min-width:0px" align="center">
							    		{!! Form::checkbox('checked_items[]',$role_transaction->id) !!}
							    	</td>	
							    	<td style="min-width:0px" align="center">
							    		{!! $role_transaction->id !!} 
							    	</td>
							    	<!--td>{!! $role_transaction->role_name !!}</td-->
							    	<td style="min-width:0px">{!! $role_transaction->module_name !!}</td>
							        <td style="min-width:0px">{!! $role_transaction->transaction_name !!}</td>
									<td style="min-width:0px">{!! $role_transaction->transaction_description !!}</td>
							        <td style="min-width:0px">
									 	@if ($role_transaction->transaction_action_id==1) 
											 <i style="color:red" class="glyphicon glyphicon-unchecked"></i>
								        @else
								        	@if($role_transaction->transaction_action_id==2)
												 <i style="color:green" class="glyphicon glyphicon-share"></i>
								        	@else
												 <i style="color:blue" class="glyphicon glyphicon-edit"></i>
								        	@endif
								        @endif
							         	{!! $role_transaction->transaction_action_name!!}
							         </td>	
							        <td style="min-width:0px">{!! $role_transaction->created_at !!}</td>
							        <td style="min-width:0px">{!! $role_transaction->updated_at !!}</td>
						    </tr>
					    	@endforeach
						</tbody>

					</table>
				

				</div>

				{!! Form::close() !!}

				<!--/div-->

				<!-- Display a label with the from/to of the pagination-->	
			
				<div class="row" padding="0px">
					<div class="col-sm-3 text-left">
						<div align="left">
							<br>
							<p style="font-size:13px;"> 
								{!!Lang::get('labels.showing')!!} {!!$roles_transactions->firstitem()!!} {!!Lang::get('labels.to')!!} {!!$roles_transactions->lastitem()!!} {!!Lang::get('labels.of')!!} {!!$roles_transactions->total()!!} {!!Lang::get('labels.items')!!} 
							</p>

						</div>
					</div>

					<!--Display the pagination links/buttons-->
					<div class="col-sm-9 text-right" >
							{!!$roles_transactions->appends(array('search_value' => $search_value))->render()!!}
					</div>
				</div>				
			</div>	
		</div>
	</div>
</div>

<!--Display a messagebox for confirm when the user wants to delete an item-->
@include('php.messagebox')



<script type="text/javascript">
	
	$(document).ready(function() {

		// Set a Seesion Key with the Role Name ComboBox Value
		$('#access_rights_cbo_role_name').on('change', function() {

		    var role_name_optionId = $(this).find('option:selected').val();

		    if  (role_name_optionId != null){

			    $(location).attr('href','/security/roles_transactions/roleSelected/' + role_name_optionId );

				 sessionStorage.setItem('access_rights_role_name_selected', role_name_optionId);
			}

			 console.log ('change:' + role_name_optionId);
		   
		});

		sessionStorage.setItem('access_rights_module_name_selected', 1);

		console.log ('focus:' + role_name_optionId);
	});

</script>

@stop