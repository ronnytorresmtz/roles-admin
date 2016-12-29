@extends('layouts.menuTemplate_left_menu_options')

@section('title')
	<title> {!!Lang::get('labels.edit_modelTemplate')!!}</title>
@stop



@section('body')

@include('php.top_user_message', array('keyMessage' => 'topbar_message_edit', 'transaction' => 'modelTemplates'))

<div id="transaction-panel" class="col-lg-10" align="left">

    <div class="panel panel-default">
        <div class="pull-right" style="padding:6px">
    		<button id="button-fullscreen" class="btn btn-xs btn-default" data-fullscreen="false">
    			<i id="icon-fullscreen" class="glyphicon glyphicon-align-justify" ></i>
    		</button>
    	</div>
        <div id="transaction-panel-header" class="panel-heading">

          <h3 class="panel-title">{!!Lang::get('labels.edit_modelTemplate')!!}</h3>
       
		</div>           
     	 <div class="panel-body">
			<div class="row">
				<!--Display a message return from the controller in the Session Object-->
				<div class="col-sm-12 text-center">

						@include('php.popup_message')

				</div>
			</div>

			@include('php.validation_message')
			
			{!! Form::model($modelTemplate, array('route' => array('menuTemplate.modelTemplates.update',$modelTemplate->id), 'method' => 'PUT')) !!}


				<div class="row">
					<div class="col-sm-3 text-left">
						<div class="control-group">
							{!!Form::label(Lang::get('fields.modelTemplate_name'))!!}   
							{!!Form::text('modelTemplate_name',null, array('class' => 'form-control','size' => '10px'))!!}
						</div>
					</div>
				</div>
	

				<br>

				
				<div class="row">
					<div class="col-sm-12 text-left">
						<div class="control-group">
							{!!Form::label(Lang::get('fields.modelTemplate_description'))!!}
							{!!Form::textarea('modelTemplate_description',null,array('class' => 'form-control','size' => '10px'))!!}
						</div>
					</div>
				</div>

				<hr>	

				<div class="control-group">
					{!!Form::submit(Lang::get('buttons.update'),array ('class'=>'btn btn-sm btn-primary'))!!}
					{!!link_to(URL::to(Session::get('UrlPrevious')), Lang::get('buttons.back'), array('class' => 'btn btn-sm btn-primary'))!!}
				</div>	
			{!!  Form::close() !!}
		</div>
	</div>	
</div>	
	
@stop