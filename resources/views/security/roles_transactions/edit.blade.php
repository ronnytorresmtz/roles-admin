@extends('layouts.security_left_menu_options')

@section('title')
	<title> {!!Lang::get('labels.edit_role_transaction')!!}</title>
@stop



@section('body')

@include('php.top_user_message', array('keyMessage' => 'topbar_message_edit', 'transaction' => 'access_rights'))

<div id="transaction-panel" class="col-lg-10" align="left">

    <div class="panel panel-default">
        <div class="pull-right" style="padding:6px">
    		<button id="button-fullscreen" class="btn btn-xs btn-default" data-fullscreen="false">
    			<i id="icon-fullscreen" class="glyphicon glyphicon-align-justify" ></i>
    		</button>
    	</div>
        <div id="transaction-panel-header" class="panel-heading">

          <h3 class="panel-title">{!!Lang::get('labels.edit_role_transaction')!!}</h3>
       
		</div>           
     	 <div class="panel-body">
			<div class="row">
				<!--Display a message return from the controller in the Session Object-->
				<div class="col-sm-12 text-center">

						@include('php.popup_message')

				</div>
			</div>

			@include('php.validation_message')
			
			{!! Form::model($role_transaction, array('route' => array('security.roles_transactions.update',
			$role_transaction[0]->id), 'method' => 'PUT')) !!}

				{!!Form::hidden('role_id',$role_transaction[0]->role_id, array('class' => 'form-control','size' => '10px', 'readonly' => 'readonly'))!!}
								

				<div class="row">
					<div class="col-sm-3 text-left">

						{!!Form::label(Lang::get('fields.role_name'))!!}  
						{!!Form::text('role_name',
						$role_transaction[0]->role_name, array('class' => 'form-control','size' => '10px', 'readonly' => 'readonly'))!!}
								
					</div>
				</div>
			
				<br>
					
				<div class="row">
					<div class="col-sm-3 text-left">

						{!!Form::label(Lang::get('fields.transaction_name'))!!}  
						{!!Form::text('transaction_name',
						$role_transaction[0]->transaction_name, array('class' => 'form-control','size' => '10px', 'readonly' => 'readonly'))!!}
					</div>
				</div>
				
				<br>

				<div class="row">
					<div class="col-sm-3 text-left">

						{!!Form::label(Lang::get('fields.transaction_action_name'))!!}  
						{!!Form::select('transaction_action_name', $transaction_actions_names, 
						$role_transaction[0]->transaction_action_id, array('class'=>'form-control'))!!}

					</div>
				</div>
	

				<hr>	

				<div class="control-group">
					
					{!!Form::submit(Lang::get('buttons.update'),array ('class'=>'btn btn-sm btn-primary'))!!}
				
					{!!link_to(URL::route('security.roles_transactions.role_selected', Session::get('roleIDSelected')), 
					Lang::get('buttons.back'), array('class' => 'btn btn-sm btn-primary'))!!}

				</div>	
				
			</div>

			{!!  Form::close() !!}
		</div>
	</div>	
</div>	

@stop