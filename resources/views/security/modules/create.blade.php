@extends('layouts.security_left_menu_options')

<!--"Programs Management"-->

@section('title')
	<title> {!!Lang::get('labels.add_module')!!}</title>
@stop


	
@section('body')

	@include('php.top_user_message', array('keyMessage' => 'topbar_message_create', 'transaction' => 'modules'))

	<div id="transaction-panel" class="col-sm-10 align="left"">

	    <div class="panel panel-default">

	         <div class="pull-right" style="padding:6px">
        		<button id="button-fullscreen" class="btn btn-xs btn-default" data-fullscreen="false">
        			<i id="icon-fullscreen" class="glyphicon glyphicon-align-justify" ></i>
        		</button>
        	</div>
        	
	        <div id="transaction-panel-header" class="panel-heading">
	     		 <h3 class="panel-title">{!!Lang::get('labels.add_module')!!}</h3>
			</div>           

	        <div class="panel-body">

				<div class="row">
					<!--Display a message return from the controller in the Session Object-->
					<div class="col-sm-12 text-center">

					 	@include('php.popup_message')
							
					</div>
				</div>

				@include('php.validation_message')

				{!! Form::open(array('route' => 'security.modules.store')) !!}

				
					<div class="row">
						<div class="col-sm-3 text-left">
								<div class="control-group">
									{!!Form::label(Lang::get('fields.module_name'))!!}				
									{!!Form::text('module_name','', array('class' => 'form-control','size' => '10px'))!!}
								</div>
						</div>
					</div>

					<br>
					
					<div class="row">
						<div class="col-sm-6 text-left">
							<div class="control-group">
								{!!Form::label(Lang::get('fields.module_description'))!!}
								{!!Form::text('module_description','',array('class' => 'form-control','size' => '10px'))!!}
							</div>
						</div>
					</div>

					<br>

					<div class="row">
						<div class="col-sm-2 text-left">
							<div class="control-group">
								{!!Form::label(Lang::get('fields.module_order'))!!}
								{!!Form::text('module_order','',array('class' => 'form-control','size' => '10px'))!!}
							</div>
						</div>
					</div>

					<hr>

					<div class="control-group">
						{!!Form::submit(Lang::get('buttons.add'),array ('class'=>'btn btn-sm btn-primary'))!!}
						{!!Form::reset(Lang::get('buttons.clear') ,array ('class'=>'btn btn-sm btn-primary'))!!}
					
						{!!link_to(URL::to(Session::get('UrlPrevious')), Lang::get('buttons.back'), array('class' => 'btn btn-sm btn-primary'))!!}



						
					</div>	
				

				{!!  Form::close() !!}



			</div>

		</div>
	</div>
</div>


@stop

