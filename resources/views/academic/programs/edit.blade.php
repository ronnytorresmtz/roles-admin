@extends('layouts.academic_left_menu_options')

@section('title')
	<title> {!!Lang::get('labels.edit_program')!!}</title>
@stop



@section('body')

	@include('php.top_user_message', array('keyMessage' => 'topbar_message_edit', 'transaction' => 'programs'))

	<div id="transaction-panel" class="col-lg-10" align="left">

        <div class="panel panel-default">
            <div class="pull-right" style="padding:6px">
        		<button id="button-fullscreen" class="btn btn-xs btn-default" data-fullscreen="false">
        			<i id="icon-fullscreen" class="glyphicon glyphicon-align-justify" ></i>
        		</button>
        	</div>
	        <div id="transaction-panel-header" class="panel-heading">

              <h3 class="panel-title">{!!Lang::get('labels.edit_program')!!}</h3>
           
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
				
				{!! Form::model($program, array('route' => array('academic.programs.update', $program->id), 'method' => 'PUT')) !!}


				<div class="conteiner">
					
					<div class="row">
						<div class="col-sm-2 text-left">
									{!!Form::label(Lang::get('fields.program_id'))!!}   
									{!!Form::text('program_id',null, array('class' => 'form-control','size' => '10px'))!!}
								</div>
									<br>
						</div>
					</div>
		
					<div class="row">
						<div class="col-sm-12 text-left">
								<div class="control-group">
								<br>	
									{!!Form::label(Lang::get('fields.program_name'))!!}		
									{!!Form::text('program_name',null,array('class' => 'form-control','size' => '10px'))!!}
								</div>
						</div>
					</div>

					<br>

					<div class="control-group">
						{!!Form::label(Lang::get('fields.program_description'))!!}
						{!!Form::textarea('program_description',null,array('class' => 'form-control','size' => '10px'))!!}
					</div>

					<hr>	

					<div class="control-group">
						
						{!!Form::submit(Lang::get('buttons.update'),array ('class'=>'btn btn-sm btn-primary'))!!}
						<!--{!!Form::button('Go Back',array ('class'=>'btn btn-default'))!!}-->
									
						<!--{!!link_to(URL::previous(), 'Go Back', array('class' => 'btn btn-primary'))!!}-->
						{!!link_to(URL::to(Session::get('UrlPrevious')), Lang::get('buttons.back'), array('class' => 'btn btn-sm btn-primary'))!!}

					</div>	
					
				</div>

				{!!  Form::close() !!}


			</div>
			
		</div>	
	<!--/div-->	
</div>	


	
@stop