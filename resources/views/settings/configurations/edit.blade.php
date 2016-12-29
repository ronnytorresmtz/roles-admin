@extends('layouts.settings_left_menu_options')

@section('title')
	<title> {!!Lang::get('labels.edit_configuration')!!}</title>
@stop



@section('body')

	@include('php.top_user_message', array('keyMessage' => 'topbar_message_edit', 'transaction' => 'configurations'))

	<div id="transaction-panel" class="col-lg-10" align="left">

        <div class="panel panel-default">
            <div class="pull-right" style="padding:6px">
        		<button id="button-fullscreen" class="btn btn-xs btn-default" data-fullscreen="false">
        			<i id="icon-fullscreen" class="glyphicon glyphicon-align-justify" ></i>
        		</button>
        	</div>
	        <div id="transaction-panel-header" class="panel-heading">

              <h3 class="panel-title">{!!Lang::get('labels.edit_configuration')!!}</h3>
           
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
				
				{!! Form::model($configuration, array('route' => array('settings.configurations.update',$configuration->id), 'method' => 'PUT')) !!}


				<div class="conteiner">
					
					<div class="row">
						<div class="col-sm-3 text-left">
							<div class="control-group">
								{!!Form::label(Lang::get('fields.configuration_name'))!!}   
								{!!Form::text('configuration_name',null, array('class' => 'form-control','size' => '10px'))!!}
							</div>
						</div>
					</div>
		
					<br>

					<div class="row">
						<div class="col-sm-3 text-left">
							<div class="control-group">
								{!!Form::label(Lang::get('fields.configuration_description'))!!}
								{!!Form::text('configuration_description',null,array('class' => 'form-control','size' => '10px'))!!}
							</div>
						</div>
					</div>

					<hr>	

					<div class="control-group">
						{!!Form::submit(Lang::get('buttons.update'),array ('class'=>'btn btn-sm btn-primary'))!!}
						{!!link_to(URL::to(Session::get('UrlPrevious')), Lang::get('buttons.back'), array('class' => 'btn btn-sm btn-primary'))!!}
					</div>	
					
				</div>

				{!!  Form::close() !!}
			</div>
		</div>	
</div>	
	
@stop