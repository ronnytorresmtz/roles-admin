@extends('layouts.login_layout')

<!--"Programs Management"-->

@section('title')
	<title> {!!Lang::get('labels.log_in')!!}</title>
	
@stop


<br><br><br><br>
	
@section('body')

	<div class="col-sm-4 align="left""></div>

	<div class="col-sm-4 align="left"">

	    <div class="panel panel-default">

	                 	
	        <div class="panel-heading">
	     		 <h3 class="panel-title">{!!Lang::get('labels.log_in')!!} </h3>
			</div>           

	        <div class="panel-body">

				<div class="row">
					<!--Display a message return from the controller in the Session Object-->
					<div class="col-sm-12 text-center">

					 	@include('php.popup_message')
							
					</div>
				</div>

				@include('php.validation_message')

				{!!Form::open(array('route' => 'login.logIn'))!!}
				
					<div class="row">
						<div class="col-sm-12 text-left">
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon1">
										<i class="glyphicon glyphicon-user" ></i>
									</span>			
									<input type="text" name="username" id="username" class ="form-control",
										placeholder="{{Lang::get('fields.username')}}"
										value="{{Session::get('remember_username')}}">
									</input>
								</div>
								<br>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-12 text-left">
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon1">
										<i class="glyphicon glyphicon-lock" ></i>
									</span>	

									<input type="password" name="password" id="password" class ="form-control",
										placeholder="{{Lang::get('fields.password')}}">
									</input>
									
								</div>
						</div>
					</div>

					<br>
						
					
						<div class="row">
							<div class="col-sm-6 text-left">
								<div class="control-group" >
									<!--{{Form::hidden('remember_me',0)}}-->
									{!!Form::checkbox('remember_me',0,0)!!}
										{!!(Lang::get('labels.remember_me'))!!}				
								</div>	
							</div>	
											
							<div class="col-sm-6 text-right">
								<div class="control-group"  >
									<a href="{{URL::to('login/forgotYourPassword')}}">
										{!!Lang::get('labels.forgot_your_password' ) . '?'!!} 
									</a>	
								</div>
							</div>	
						</div>
					<hr>

						<div class="control-group">
							<div class="row">
								<div class="col-sm-6" align="left">
									{!! Form::button(Lang::get('labels.login_user_demo'), array(
										'id'    => 'demo_user',
										'class' =>'btn btn-sm btn-success'
										))
									!!}
								</div>

								<div class="col-sm-6" align="right">
									{!!Form::submit(Lang::get('buttons.log_in'),array (
										'class'=>'btn btn-sm btn-primary',
										'style'=>'width:100px',
										'id' => 'btn_login'))
									!!}				
								</div>			
							</div>	
					</div>	
				

				{!!Form::close()!!}



			</div>

		</div>
	</div>

	<div class="col-sm-4 align="left""></div>
</div>


<script type="text/javascript">
	

$('#demo_user').on('click', function(e){

	$('#username').val('demo_user');
	$('#password').val('demo123');

	$('#btn_login').click();

});


</script>


@stop

