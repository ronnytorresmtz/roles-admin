@extends('layouts.facilities_left_menu_options')

@section('title')
	<title> {!!Lang::get('labels.edit_campus')!!}</title>
@stop



@section('body')

	@include('php.top_user_message', array('keyMessage' => 'topbar_message_edit', 'transaction' => 'campuss'))

	<div id="transaction-panel" class="col-lg-10" align="left">

        <div class="panel panel-default">
            <div class="pull-right" style="padding:6px">
        		<button id="button-fullscreen" class="btn btn-xs btn-default" data-fullscreen="false">
        			<i id="icon-fullscreen" class="glyphicon glyphicon-align-justify" ></i>
        		</button>
        	</div>
	        <div id="transaction-panel-header" class="panel-heading">

              <h3 class="panel-title">{!!Lang::get('labels.edit_campus')!!}</h3>
           
			</div>           
         	 <div class="panel-body">
				<div class="row">
					<!--Display a message return from the controller in the Session Object-->
					<div class="col-sm-12 text-center">

							@include('php.popup_message')

					</div>
				</div>

				@include('php.validation_message')
				
				{!! Form::model($campus, array('route' => array('facilities.campuss.update',$campus[0]->id), 'method' => 'PUT')) !!}

				{!!Form::hidden('institute_id',$campus[0]->institute_id, array('class' => 'form-control','size' => '10px', 'readonly' => 'readonly'))!!}

					<div class="row">
						<div class="col-sm-3 text-left">
							<div class="control-group">
								{!!Form::label(Lang::get('fields.institute_short_name'))!!}  
								{!!Form::text('institute_name',
								$campus[0]->institute_short_name, array('class' => 'form-control','size' => '10px', 
								'readonly' => 'readonly'))!!}
							</div>
						</div>
					</div>

					<br>
					
					<div class="row">
						<div class="col-sm-6 text-left">
							<div class="control-group">
								{!!Form::label(Lang::get('fields.campus_name'))!!}   
								{!!Form::text('campus_name',$campus[0]->campus_name, array('class' => 'form-control','size' => '10px'))!!}
							</div>
						</div>
					</div>

					<br>

					<div class="row">
						<div class="col-sm-12 text-left">
							<div class="control-group">
								{!!Form::label(Lang::get('fields.campus_description'))!!}
								{!!Form::textarea('campus_description',$campus[0]->campus_description,array('class' => 'form-control','size' => '10px'))!!}
							</div>
						</div>
					</div>

					<hr>	

					<div class="control-group">
						
						{!!Form::submit(Lang::get('buttons.update'),array ('class'=>'btn btn-sm btn-primary'))!!}
					
						{!!link_to(URL::route('facilities.campuss.institute_selected', Session::get('instituteIDSelected')), 
						Lang::get('buttons.back'), array('class' => 'btn btn-sm btn-primary'))!!}
					</div>	
					

				{!!  Form::close() !!}


			</div>
			
		</div>	
</div>	
	
@stop