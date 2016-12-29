@extends('layouts.login_layout')

<!--"Programs Management"-->

@section('title')
	<title> {!!Lang::get('labels.log_in')!!}</title>
@stop


<br><br>
	
@section('body')

	<div class="col-sm-4 align="left""></div>

	<div class="col-sm-4 align="left"">

	    <div class="panel panel-default">

	                 	
	        <div class="panel-heading">
	     		 <h3 class="panel-title">{!!Lang::get('labels.password_reset')!!} </h3>
			</div>           

	        <div class="panel-body">

				<div class="row">
					<!--Display a message return from the controller in the Session Object-->
					<div class="col-sm-12 text-center">

					 	@include('php.popup_message')
							
					</div>
				</div>

				@include('php.validation_message')

				{!! Form::open(array('route' => 'login.resetYourPassword')) !!}

					{!! Form::hidden('token', $token) !!}
					
					<div class="row">
						<div class="col-sm-12 text-left">
							<p class="alert alert-info">
								{!!Lang::get('labels.reset_instructions')!!}
							</p>
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1">
									<i class="glyphicon glyphicon-lock" ></i>
								</span>			
								{!!Form::text('remember_security_number','',array(
									'class' => 'form-control',
									'size' => '10px',
									'aria-describedby'=>'basic-addon1', 
									'placeholder'=>Lang::get('fields.remember_security_number')

									))
								!!}
							</div>
							
							<hr>

							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1">
									<i class="glyphicon glyphicon-lock" ></i>
								</span>			
								<input 	type="password" 
										name="new_password" 
										class ="form-control",
										maxlength="15",
										placeholder="{!!Lang::get('fields.new_password')!!}">
								</input>
							</div>
							<br>
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1">
									<i class="glyphicon glyphicon-lock" ></i>
								</span>			
								<input 	type="password"
										name="new_password_confirmation" 
										class ="form-control",
										maxlength="15",
										placeholder="{!!Lang::get('fields.new_password_confirmation')!!}">
								</input>
							</div>
						</div>
					</div>

					<hr>



					<div class="control-group" align="right">
						{!!Form::submit(Lang::get('buttons.reset'),array ('class'=>'btn btn-sm btn-primary','style'=>'width:100px'))!!}								
					</div>	
				

				{!!  Form::close() !!}



			</div>

		</div>
	</div>

	<div class="col-sm-4 align="left""></div>
</div>


@stop

