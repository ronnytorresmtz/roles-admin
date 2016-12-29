@extends('layouts.security_left_menu_options')

@section('title')
	<title> {!!Lang::get('labels.edit_user')!!}</title>
@stop


@section('body')

@include('php.top_user_message', array('keyMessage' => 'topbar_message_edit', 'transaction' => 'users'))

<div id="transaction-panel" class="col-sm-10" align="left">


	<div class="panel panel-default">
	    <div class="pull-right" style="padding:6px">
    		<button id="button-fullscreen" class="btn btn-sm btn-default" data-fullscreen="false">
    			<i id="icon-fullscreen" class="glyphicon glyphicon-align-justify" ></i>
    		</button>
    	</div>
	    <div id="user-panel-header" class="panel-heading">

	      <!--h3 class="panel-title">{!!Lang::get('labels.edit_user')!!}</h3-->
	      <h3 class="panel-title">{!!Lang::get('labels.edit_user')!!}</h3>
	   
		</div>           
	 	 <div class="panel-body">
	 	 		<!--p> {!!Session::get('UrlPrevious')!!}</p>
	 	 		<p> {!!Session::get('debug')!!}</p>
	 	 		<p> {!!Session::get('debug2')!!}</p-->
			<div class="row">
				<!--Display a message return from the controller in the Session Object-->
				<div class="col-sm-12 text-center">

						@include('php.popup_message')

				</div>
			</div>

			@include('php.validation_message')
			
			{!! Form::model($user, array('route' => array('security.users.update',$user->id), 'method' => 'PUT')) !!}

					{!!Form::hidden('id', $user->id)!!}

					<div class="row">
						<div class="col-sm-2 text-left">
							<div class="control-group">
								{!!Form::label(Lang::get('fields.username'))!!}
								{!!Form::text('username',$user->username,array('readonly'=>'readonly','class' => 'form-control',
								'size' => '10px'))!!}
							</div>
						</div>
					</div>
					<br>
					
					<div class="row">
						<div class="col-sm-4 text-left">
							<div class="control-group">
								{!!Form::label(Lang::get('fields.user_fullname'))!!}				
								{!!Form::text('user_fullname',$user->user_fullname, array('readonly'=>'readonly','class' => 'form-control','size' => '10px'))!!}
							</div>
						</div>
					</div>
					<br>

					<div class="row">
						<div class="col-sm-4 text-left">
							<div class="control-group">					
								{!!Form::label(Lang::get('fields.email'))!!}
								{!!Form::email('email',$user->email,array('class' => 'form-control','size' => '10px'))!!}
							</div>
						</div>
					</div>
					<br>

					<div class="row">
						<div class="col-sm-3 text-left">
							<div class="control-group">
								{!!Form::label(Lang::get('fields.role_name'))!!}
								{!!Form::select('role_name', $roles, $role_name, array('class'=>'form-control'))!!}
							</div>
						</div>
					</div>
					

					<hr>
				
					{!!Form::submit(Lang::get('buttons.update'),array ('class'=>'btn btn-sm btn-primary'))!!}
					{!!link_to(URL::to(Session::get('UrlPrevious')), Lang::get('buttons.back'), array('class' => 'btn btn-sm btn-primary'))!!}
			
			{!!  Form::close() !!}

		</div>
		
	</div>	
	
</div>


	
@stop