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
	     		 <h3 class="panel-title">{!!Lang::get('labels.send_your_password')!!} </h3>
			</div>           

	        <div class="panel-body">

				<div class="row">
					<!--Display a message return from the controller in the Session Object-->
					<div class="col-sm-12 text-center">

					 	@include('php.popup_message')
							
					</div>
				</div>

				@include('php.validation_message')

				{!! Form::open(array('route' => 'login.sendYourPassword')) !!}

					<div class="row">
						<div class="col-sm-12 text-left">
							<p class="alert alert-info">
								{!!Lang::get('labels.send_password')!!}
							</p>
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1">
									<i class="glyphicon glyphicon-envelope" ></i>
								</span>			
								{!!Form::text('email','',array(
									'class'            => 'form-control',
									'size'             => '10px',
									'aria-describedby' => 'basic-addon1', 
									'maxlength'        => '100',
									'placeholder'      =>  Lang::get('fields.email')

									))
								!!}
							</div>
						</div>
					</div>

				
				

					<hr>

					<div class="control-group" align="right">
						{!!Form::submit(Lang::get('buttons.send'),array ('class'=>'btn btn-sm btn-primary','style'=>'width:100px'))!!}								
					</div>	
				

				{!!  Form::close() !!}



			</div>

		</div>
	</div>

	<div class="col-sm-4 align="left""></div>
</div>


@stop

