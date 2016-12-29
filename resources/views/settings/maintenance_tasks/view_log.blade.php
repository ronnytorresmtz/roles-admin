@extends('layouts.settings_left_menu_options')

@section('title')
	<title> {!!Lang::get('labels.view_tasks_log')!!} </title>
@stop


@section('body')

	@include('php.top_user_message', array('keyMessage' => 'topbar_message_tasks_log', 'transaction' => ''))

	<div id="transaction-panel" class="col-lg-10" align="left">

        <div class="panel panel-default">
            <div class="pull-right" style="padding:6px">
        		<button id="button-fullscreen" class="btn btn-xs btn-default" data-fullscreen="false">
        			<i id="icon-fullscreen" class="glyphicon glyphicon-align-justify" ></i>
        		</button>
        	</div>
	        <div id="transaction-panel-header" class="panel-heading">

              <h3 class="panel-title">{!!Lang::get('labels.view_tasks_log')!!}</h3>
           
			</div>           
         	 <div class="panel-body">
				<div class="row">
					<!--Display a message return from the controller in the Session Object-->
					<div class="col-sm-12 text-center">
							
							@include('php.popup_message')

					</div>
				</div>
					
				<div class="table-responsive" style="white-space:nowrap;overflow-x:auto; overflow-y:auto; width:auto; height:345px; padding:0px">
				
					<table class= "table table-striped table-bordered table-condensed table-hover"> 
	
						<theader>
							<td style="min-width:60px">{!!Lang::get('fields.date_time')!!}</td> 
							<td style="min-width:60px">{!!Lang::get('fields.task_name')!!}</td> 
							<td style="min-width:30px">{!!Lang::get('fields.message_type')!!}</td> 
							<td >{!!Lang::get('fields.message_log')!!}</td> 
							<theader>
	
						
						@foreach ($tasksLog as $log)
								<tr>
								<td style="min-width:60px; ">{!!$log->created_at!!}</td>
								<td>{!!$log->task_name!!}</td>

								@if ($log->task_log_message_type == 'Failed' )
									<td style="min-width:30px"> 
										<i class="glyphicon glyphicon-remove-sign" style="color:red"></i>
										{!!Lang::get('labels.task_failed')!!}
									</td>
								@else 
									<td style="min-width:30px"> 
										<i class="glyphicon glyphicon-info-sign" style="color:lightgray"></i> 
										{!!Lang::get('labels.task_successed')!!}
									</td>
								
								@endif
								
								<td>{!!$log['task_log_message']!!}</td> 
								<tr>
						@endforeach
						

					</table>
				</div>
				
			
				<br>
				{!!link_to(URL::previous(), Lang::get('buttons.back'), array('class' => 'btn btn-sm btn-primary'))!!}
			</div>

	

		</div>	
			
	</div>

@stop

