@extends('layouts.facilities_left_menu_options')

@section('title')
	<title> {!!Lang::get('labels.view_campus')!!} </title>
@stop


@section('body')

	@include('php.top_user_message', array('keyMessage' => 'topbar_message_show', 'transaction' => 'campuss'))

	<div id="transaction-panel" class="col-lg-10" align="left">

        <div class="panel panel-default">
            <div class="pull-right" style="padding:6px">
        		<button id="button-fullscreen" class="btn btn-xs btn-default" data-fullscreen="false">
        			<i id="icon-fullscreen" class="glyphicon glyphicon-align-justify" ></i>
        		</button>
        	</div>
	        <div id="transaction-panel-header" class="panel-heading">

              <h3 class="panel-title">{!!Lang::get('labels.view_campus')!!}</h3>
           
			</div>           
         	 <div class="panel-body">

				{!! Form::model($campus, array('route' => array('facilities.campuss.show', ''), 'method' => 'GET')) !!}

				<div class="conteiner">
		
					<div class="row">
						<div class="col-sm-3 text-left">
							<div class="control-group">
								{!!Form::label(Lang::get('fields.institute_short_name'))!!}		
								{!!Form::text('institute_name', 
									$campus[0]->institute_short_name ,
									array('class' => 'form-control','size' => '10px','readonly' => 'readonly'))!!}
							</div>
						</div>
					</div>
					
					<br>

					<div class="row">
						<div class="col-sm-6 text-left">
							<div class="control-group">
								{!!Form::label(Lang::get('fields.campus_name'))!!}		
								{!!Form::text('campus_name',$campus[0]->campus_name,array('class' => 'form-control','size' => '10px','readonly' => 'readonly'))!!}
							</div>
						</div>
					</div>

					<br>

					<div class="row">
						<div class="col-sm-12 text-left">
							<div class="control-group">
								{!!Form::label(Lang::get('fields.campus_description'))!!}
								{!!Form::textarea('campus_description',$campus[0]->campus_description,array('class' => 'form-control','size' => '10px','readonly' => 'readonly'))!!}
							<div>
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