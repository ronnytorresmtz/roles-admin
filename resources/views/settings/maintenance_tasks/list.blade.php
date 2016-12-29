@extends('layouts.settings_left_menu_options')

@section('title')
	<title> {!!Lang::get('labels.view_tasks_list')!!} </title>
@stop


@section('body')

	@include('php.top_user_message', array('keyMessage' => 'topbar_message_tasks', 'transaction' => ''))

	<div id="transaction-panel" class="col-lg-10" align="left">

        <div class="panel panel-default">
            <div class="pull-right" style="padding:6px">
        		<button id="button-fullscreen" class="btn btn-xs btn-default" data-fullscreen="false">
        			<i id="icon-fullscreen" class="glyphicon glyphicon-align-justify" ></i>
        		</button>
        	</div>
	        <div id="transaction-panel-header" class="panel-heading">

              <h3 class="panel-title">{!!Lang::get('labels.view_tasks_list')!!}</h3>
           
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
					<div class="col-sm-4 text-right">	

						{!! Form::open(array('route' => 'settings.maintenance_tasks.search', 'method' => 'get')) !!}

							<div class="input-group">
							  	   
								<input name="search_value" type="text" maxlength="25" placeholder="{!!Lang::get('labels.searchingtext')!!}" class="form-control" autofocus="autofocus">
								</input>
							    <span class="input-group-btn"  >
							    	<button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search" style="padding:3px"></i></button>
						      	</span>

						    </div>
												  
						{!! Form::close() !!}

					</div>
			
					<div class="col-sm-2 text-left">	
						<!--TODO: Hide and Show with JQuery if a Search was executed-->
						<div id='filter-label-left'> 
							<h4>
							{!!Form::label('',$label_search,array('class'=>'label label-warning'))!!}
							</h4>
						</div>
					</div>
				
					<!--div class="container"-->	
					<div class="col-sm-6 text-right">
						
						{!! Form::open(array('route'=> 'settings.maintenance_tasks.viewLogButton'))!!}			
						
							<!--the execute task button in Handle by javascript-->
							{!! Form::button('<i class="glyphicon glyphicon-play"></i> ' . Lang::get('buttons.execute_task'), array(
										'class' => 'btn btn-sm btn-primary', 
										'id' => 'button_execute',
										'disabled' => (($transactionActionId['transaction_action_id']==2) ? 'disabled' : null)
							)) !!}
		

							<!--the view log button in Handle by the form::open-->
							<button type="submit" class="btn btn-sm btn-primary">
								<i class="glyphicon glyphicon-file"></i> {!!Lang::get('buttons.view_task_log')!!}
							</button>
						
					</div>
					
					
				</div>

				<div class="table-responsive" style="white-space:nowrap;overflow-x:auto; overflow-y:auto; width:auto; height:335px; padding:0px;">
					
					<table id="task_table" class= "table table-striped table-bordered table-condensed table-hover"> 

					    <thead>
					         <tr>
					            <!--Displays the Table Headers"-->
					            
					            <th></th>

					            <th>
					            	{!!Lang::get('fields.id')!!}
					            </th>
					            
					            <th>
					            	{!!Lang::get('fields.task_name')!!}
					            </th>
					            <th>
					            	{!!Lang::get('fields.task_description')!!}
					            </th>
								
								<!--th>
					            	{!!Lang::get('fields.task_command')!!}
					            </th-->

					             <!--th>
					            	{!!Lang::get('fields.task_status')!!}
					            </th-->

					            <th>
					            	{!!Lang::get('fields.last_execution_date')!!}
					            </th>
					            <th>
					            	{!!Lang::get('fields.last_execution_result')!!}
					            </th>
					           
					        </tr>
					    </thead>

						<tbody >		

							<!-- Populate the Table Display-->
					    	@foreach($tasks as $task)
							    <tr id='{!! $task->id !!}'>
							    	<td style="min-width:30px" align="center">
							    		{!! Form::checkbox('checked_items[]',$task->id) !!}
							    	</td>	
							    	<td style="min-width:0px">{!! $task->id !!}</td>
							        <td style="min-width:0px">{!! $task->task_name !!}</td>
							        <td style="min-width:0px">{!! $task->task_description !!}</td>
							        <!--td style="min-width:0px">{!! $task->task_command !!}</td-->
							        <!--td style="min-width:0px">{!! $task->task_status !!}</td-->
							        <!--td style="min-width:0px">Not Running</td-->
							        <td style="min-width:0px">{!! $task->updated_at !!}</td>
									
							        @if ( $task->task_command_execution_result == "Failed")
							        	<td style="min-width:0px"><i class="glyphicon glyphicon-remove-sign" style="color:red"></i>
							        	{!! Lang::get('labels.task_failed')!!}</td>
						        	@else
							        	<td style="min-width:0px"><i class="glyphicon glyphicon-info-sign" style="color:lightgray"></i>
							        	{!! Lang::get('labels.task_successed')!!}</td>
							        
									@endif
							        

							    </tr>
					    	@endforeach

						</tbody>

					</table>

					{!! Form::close()!!}
				
				</div>


			</div>

		</div>	
			
	</div>


{!! HTML::script('assets/js/only-one-select.js') !!}		

<script type="text/javascript">
	
$(document).ready(function()  {


	$("#button_execute").on('click',function(){

		var checked_items = $("input:checkbox:checked", "#task_table").map(function() {
			return $(this).val();
   		 }).get();

		var dataArray = new Object();

		dataArray.checked_items = checked_items;

		$.ajax({
            type: 'POST',
            url : '/settings/maintenance_tasks/executeButton',
            data: dataArray,
            beforeSend: function(){
				$('#task_table').find('tr#' + checked_items).find('td:eq(5)').html(
					'<span style=color:blue>{!! HTML::image('assets/icons/loading_image.gif') !!} Running </span>'
				);      
		    },
            success : function(data){

		 		$('#task_table').find('tr#' + checked_items).find('td:eq(4)').html(data.execution_date.date.replace('.000000',''));

		 		if (data.status=="Failed"){
		 			$('#task_table').find('tr#' + checked_items).find('td:eq(5)').html('<i class="glyphicon glyphicon-remove-sign" style="color:red"> </i>' + ' ' + data.status);
		 		} else {
		 			$('#task_table').find('tr#' + checked_items).find('td:eq(5)').html('<i class="glyphicon glyphicon-info-sign" style="color:lightgray"> </i>' + ' ' + data.status);
		 		}

            },
            error: function(){
            	 $('#task_table').find('tr#' + checked_items).find('td:eq(5)').html('<i class="glyphicon glyphicon-remove-sign" style="color:red"> </i> ' + 'Failed' );
            }

        });	
	
	});

});

</script>
@stop

