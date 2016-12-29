@extends('layouts.data_left_menu_options')

@section('title')
	<title> {!!Lang::get('labels.import_city')!!} </title>
@stop


@section('body')

	@include('php.top_user_message', array('keyMessage' => 'topbar_message_import', 'transaction' => 'cities'))

	<div id="transaction-panel" class="col-lg-10" align="left">

        <div class="panel panel-default">
            <div class="pull-right" style="padding:6px">
        		<button id="button-fullscreen" class="btn btn-xs btn-default" data-fullscreen="false">
        			<i id="icon-fullscreen" class="glyphicon glyphicon-align-justify" ></i>
        		</button>
        	</div>
	        <div id="transaction-panel-header" class="panel-heading">

              <h3 class="panel-title">{!!Lang::get('labels.import_city')!!}</h3>
           
			</div>           
         	 <div class="panel-body">


				<div class="row">
					<!--Display a message return from the controller in the Session Object-->
					<div class="col-sm-12 text-center">
							
							@include('php.popup_message')
							
					</div>
				</div>

				<!--{!! HTML::ul($errors->all())!!}-->

				{!! Form::open(array('route'=>'data.cities.import','files'=>true)) !!}<div class="row">
					
					<div class="col-sm-3 text-left">
								<div class="control-group">
									{!!Form::label(Lang::get('fields.state_name'))!!}		
									{!!Form::text('state_name', 
										$state->state_name,
										array('class' => 'form-control','size' => '10px','readonly' => 'readonly'))!!}
								</div>
								<br>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-3 text-left">
								<div class="control-group">
									{!!Form::label(Lang::get('fields.institute_short_name'))!!}		
									{!!Form::text('institute_name', 
										$institute->institute_short_name,
										array('class' => 'form-control','size' => '10px','readonly' => 'readonly'))!!}
								</div>
								<br>
						</div>
					</div>
  




  
					{!! Form::label(Lang::get('labels.upload_file')) !!}

					{!! Form::file('fileToImport') !!}
				  	<br/><br/>
				  	<!-- submit buttons -->
					{!! Form::submit(Lang::get('buttons.import'), array('class'=>"btn btn-sm btn-primary")) !!}
				  
				  	<!-- reset buttons -->
				  	{!! Form::reset(Lang::get('buttons.clear'), array('class'=>"btn btn-sm btn-primary")) !!}


				  	{!!link_to(URL::route('data.cities.state_selected', Session::get('stateIDSelected')), 
						Lang::get('buttons.back'), array('class' => 'btn btn-sm btn-primary'))!!}

			  
			 	 {!! Form::close() !!}
					

			</div>


		</div>	
	<!--/div>	
</div-->			
</div>

	
@stop




 

 
