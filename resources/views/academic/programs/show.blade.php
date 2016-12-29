@extends('layouts.academic_left_menu_options')

@section('title')
	<title> {!!Lang::get('labels.view_program')!!} </title>
@stop


@section('body')

	@include('php.top_user_message', array('keyMessage' => 'topbar_message_show', 'transaction' => 'programs'))

	<div id="transaction-panel" class="col-lg-10" align="left">

        <div class="panel panel-default">
            <div class="pull-right" style="padding:6px">
        		<button id="button-fullscreen" class="btn btn-xs btn-default" data-fullscreen="false">
        			<i id="icon-fullscreen" class="glyphicon glyphicon-align-justify" ></i>
        		</button>
        	</div>
	        <div id="transaction-panel-header" class="panel-heading">

              <h3 class="panel-title">{!!Lang::get('labels.view_program')!!}</h3>
           
			</div>           
         	 <div class="panel-body">

				{!! Form::model($program, array('route' => array('academic.programs.show', ''), 'method' => 'GET')) !!}

					<div class="conteiner">
						
						<div class="row">
							<div class="col-sm-2 text-left">
										
										{!!Form::label(Lang::get('fields.program_id'))!!}						
										{!!Form::text('program_id',null, array('class' => 'form-control','size' => '10px','readonly' => 'readonly'))!!}
									</div>
										<br>
							</div>
						</div>
			
						<div class="row">
							<div class="col-sm-12 text-left">
									<div class="control-group">
										<br>
										{!!Form::label(Lang::get('fields.program_name'))!!}		
										{!!Form::text('program_name',null,array('class' => 'form-control','size' => '10px','readonly' => 'readonly'))!!}
									</div>
							</div>
						</div>

						<br>

						<div class="control-group">
							{!!Form::label(Lang::get('fields.program_description'))!!}
							{!!Form::textarea('program_description',null,array('class' => 'form-control','size' => '10px','readonly' => 'readonly'))!!}
						</div>

						<hr>	

						<div class="control-group">
							
							{!!link_to(URL::to(Session::get('UrlPrevious')), Lang::get('buttons.back'), array('class' => 'btn btn-sm btn-primary'))!!}

						</div>	
					</div>

				{!!  Form::close() !!}

			</div>



			</div>	
			
	</div>


@stop