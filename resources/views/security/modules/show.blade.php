@extends('layouts.security_left_menu_options')

@section('title')
	<title> {!!Lang::get('labels.view_module')!!} </title>
@stop


@section('body')

	@include('php.top_user_message', array('keyMessage' => 'topbar_message_show', 'transaction' => 'modules'))

	<div id="transaction-panel" class="col-lg-10" align="left">

        <div class="panel panel-default">
            <div class="pull-right" style="padding:6px">
        		<button id="button-fullscreen" class="btn btn-xs btn-default" data-fullscreen="false">
        			<i id="icon-fullscreen" class="glyphicon glyphicon-align-justify" ></i>
        		</button>
        	</div>
	        <div id="transaction-panel-header" class="panel-heading">

              <h3 class="panel-title">{!!Lang::get('labels.view_module')!!}</h3>
           
			</div>           
         	 <div class="panel-body">

				{!! Form::model($module, array('route' => array('security.modules.show', ''), 'method' => 'GET')) !!}

					<div class="row">
						<div class="col-sm-3 text-left">
							<div class="control-group">
								{!!Form::label(Lang::get('fields.module_name'))!!}		
								{!!Form::text('module_name',null,array('class' => 'form-control','size' => '10px','readonly' => 'readonly'))!!}
							</div>
						</div>
					</div>

					<br>

					<div class="row">
						<div class="col-sm-6 text-left">
							<div class="control-group">
								{!!Form::label(Lang::get('fields.module_description'))!!}
								{!!Form::text('module_description',null,array('class' => 'form-control','size' => '10px','readonly' => 'readonly'))!!}
							</div>
						</div>
					</div>

					<br>

					<div class="row">
						<div class="col-sm-2 text-left">
							<div class="control-group">
								{!!Form::label(Lang::get('fields.module_order'))!!}
								{!!Form::text('module_order',null,array('class' => 'form-control','size' => '10px','readonly' => 'readonly'))!!}
							</div>
						</div>
					</div>

					<hr>	

					<div class="control-group">
						
						{!!link_to(URL::to(Session::get('UrlPrevious')), Lang::get('buttons.back'), 
						array('class' => 'btn btn-sm btn-primary'))!!}

					</div>	
				</div>

				{!!  Form::close() !!}

			</div>



			</div>	
			
	</div>


@stop