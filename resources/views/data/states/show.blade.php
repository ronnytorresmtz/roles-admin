@extends('layouts.data_left_menu_options')

@section('title')
	<title> {!!Lang::get('labels.view_state')!!} </title>
@stop


@section('body')

	@include('php.top_user_message', array('keyMessage' => 'topbar_message_show', 'transaction' => 'states'))

	<div id="transaction-panel" class="col-lg-10" align="left">

        <div class="panel panel-default">
            <div class="pull-right" style="padding:6px">
        		<button id="button-fullscreen" class="btn btn-xs btn-default" data-fullscreen="false">
        			<i id="icon-fullscreen" class="glyphicon glyphicon-align-justify" ></i>
        		</button>
        	</div>
	        <div id="transaction-panel-header" class="panel-heading">

              <h3 class="panel-title">{!!Lang::get('labels.view_state')!!}</h3>
           
			</div>           
         	 <div class="panel-body">

				{!! Form::model($state, array('route' => array('data.states.show', ''), 'method' => 'GET')) !!}

				<div class="conteiner">
		
					<div class="row">
						<div class="col-sm-3 text-left">
								<div class="control-group">
									{!!Form::label(Lang::get('fields.country_name'))!!}		
									{!!Form::text('country_name', 
										$state[0]->country_name ,
										array('class' => 'form-control','size' => '10px','readonly' => 'readonly'))!!}
								</div>
						</div>
					</div>
					
					<br>

					<div class="row">
						<div class="col-sm-2 text-left">
								<div class="control-group">
									{!!Form::label(Lang::get('fields.state_name'))!!}		
									{!!Form::text('state_name',$state[0]->state_name,array('class' => 'form-control','size' => '10px','readonly' => 'readonly'))!!}
								</div>
						</div>
					</div>

					<br>

					<div class="row">
						<div class="col-sm-3 text-left">
							<div class="control-group">
								{!!Form::label(Lang::get('fields.state_description'))!!}
								{!!Form::text('state_description',$state[0]->state_name,array('class' => 'form-control','size' => '10px','readonly' => 'readonly'))!!}
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