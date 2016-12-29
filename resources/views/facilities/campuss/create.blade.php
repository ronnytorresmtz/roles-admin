@extends('layouts.facilities_left_menu_options')

<!--"Programs Management"-->

@section('title')
	<title> {!!Lang::get('labels.add_campus')!!}</title>
@stop


	
@section('body')

	@include('php.top_user_message', array('keyMessage' => 'topbar_message_create', 'transaction' => 'campuss'))

	<div id="transaction-panel" class="col-sm-10 align="left"">

	    <div class="panel panel-default">

	         <div class="pull-right" style="padding:6px">
        		<button id="button-fullscreen" class="btn btn-xs btn-default" data-fullscreen="false">
        			<i id="icon-fullscreen" class="glyphicon glyphicon-align-justify" ></i>
        		</button>
        	</div>
        	
	        <div id="transaction-panel-header" class="panel-heading">
	     		 <h3 class="panel-title">{!!Lang::get('labels.add_campus')!!}</h3>
			</div>           

	        <div class="panel-body">

				<div class="row">
					<!--Display a message return from the controller in the Session Object-->
					<div class="col-sm-12 text-center">

					 	@include('php.popup_message')
							
					</div>
				</div>

				@include('php.validation_message')

				{!! Form::open(array('route' => 'facilities.campuss.store')) !!}

					<div class="row">
						<div class="col-sm-3 text-left">
								<div class="control-group">
								{!!Form::label(Lang::get('fields.institute_short_name'))!!}
								{!!Form::select('institute_name', 
								$institutes_names, null, array('class'=>'form-control', 
								'id' => 'add_campus_cbo_institute_name'))!!}
							</div>
						</div>
					</div>
					
					<br>
				
					<div class="row">
						<div class="col-sm-6 text-left">
							<div class="control-group">
								{!!Form::label(Lang::get('fields.campus_name'))!!}				
								{!!Form::text('campus_name','', array('class' => 'form-control','size' => '10px'))!!}
							</div>
						</div>
					</div>

					<br>

					<div class="row">
						<div class="col-sm-12 text-left">
							<div class="control-group">
								{!!Form::label(Lang::get('fields.campus_description'))!!}
								{!!Form::textarea('campus_description','',array('class' => 'form-control','size' => '10px'))!!}
							</div>
						</div>
					</div>

					<hr>


					<div class="control-group">
						{!!Form::submit(Lang::get('buttons.add'),array ('class'=>'btn btn-sm btn-primary'))!!}
						{!!Form::reset(Lang::get('buttons.clear') ,array ('class'=>'btn btn-sm btn-primary'))!!}
					
						{!!link_to(URL::route('facilities.campuss.institute_selected', Session::get('instituteIDSelected')), 
						Lang::get('buttons.back'), array('class' => 'btn btn-sm btn-primary'))!!}
						
					</div>	
				

				{!!  Form::close() !!}



			</div>

		</div>
	</div>
</div>

<script type="text/javascript">
	
	$(document).ready(function() {

		// Get the Sesion Key Value for the Role Name ComboBox set in the list.blade.php file and set the position of the ComboBox
		var institute_name_optionId   = sessionStorage.getItem('campus_institute_name_selected');
		if  (institute_name_optionId != null){
			$('#add_campus_cbo_institute_name').val(institute_name_optionId);
		}


		



	});

</script>

@stop

