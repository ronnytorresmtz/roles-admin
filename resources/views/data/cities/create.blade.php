@extends('layouts.data_left_menu_options')

<!--"Programs Management"-->

@section('title')
	<title> {!!Lang::get('labels.add_city')!!}</title>
@stop


	
@section('body')

	@include('php.top_user_message', array('keyMessage' => 'topbar_message_create', 'transaction' => 'cities'))

	<div id="transaction-panel" class="col-sm-10 align="left"">

	    <div class="panel panel-default">

	         <div class="pull-right" style="padding:6px">
        		<button id="button-fullscreen" class="btn btn-xs btn-default" data-fullscreen="false">
        			<i id="icon-fullscreen" class="glyphicon glyphicon-align-justify" ></i>
        		</button>
        	</div>
        	
	        <div id="transaction-panel-header" class="panel-heading">
	     		 <h3 class="panel-title">{!!Lang::get('labels.add_city')!!}</h3>
			</div>           

	        <div class="panel-body">

				<div class="row">
					<!--Display a message return from the controller in the Session Object-->
					<div class="col-sm-12 text-center">

					 	@include('php.popup_message')
							
					</div>
				</div>

				@include('php.validation_message')

				{!! Form::open(array('route' => 'data.cities.store')) !!}

					<div class="row">
						<div class="col-sm-3 text-left">
								<div class="control-group">
									{!!Form::label(Lang::get('fields.country_name'))!!}
									{!!Form::select('country_name', 
									$countries_names, $countryId, array('class'=>'form-control', 
									'id' => 'add_city_cbo_country_name'))!!}
								</div>
								<br>
						</div>
					</div>

					
					<div class="row">
						<div class="col-sm-3 text-left">
								<div class="control-group">
									{!!Form::label(Lang::get('fields.state_name'))!!}
									{!!Form::select('state_name', 
									$states_names, $stateId, array('class'=>'form-control', 
									'id' => 'add_city_cbo_state_name'))!!}
									
								</div>
								<br>
						</div>
					</div>

				
					<div class="row">
						<div class="col-sm-2 text-left">
								<div class="control-group">
									{!!Form::label(Lang::get('fields.city_name'))!!}				
									{!!Form::text('city_name','', array('class' => 'form-control','size' => '10px'))!!}
								</div>
								<br>
						</div>
					</div>

					
					<div class="row">
						<div class="col-sm-3 text-left">
							<div class="control-group">
								{!!Form::label(Lang::get('fields.city_description'))!!}
								{!!Form::text('city_description','',array('class' => 'form-control','size' => '10px'))!!}
							</div>
						</div>
					</div>

					<hr>

					<div class="control-group">
						{!!Form::submit(Lang::get('buttons.add'),array ('class'=>'btn btn-sm btn-primary'))!!}
						{!!Form::reset(Lang::get('buttons.clear') ,array ('class'=>'btn btn-sm btn-primary'))!!}
					
						{!!link_to(URL::route('data.cities.state_selected', Session::get('countryIDSelected') . '/' . Session::get('stateIDSelected')), 
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
		/*var state_name_optionId   = sessionStorage.getItem('city_state_name_selected');
		if  (state_name_optionId != null){
			$('#add_city_cbo_state_name').val(state_name_optionId);
		}*/


		//Set a Session Key Value for the Module Name Combobox and Get the Transaction Releated to the Module Name
		$('#add_city_cbo_country_name').on('change', function() {

			var country_name_optionId = $(this).find('option:selected').val();

			loadStatesSelectBox(country_name_optionId); //ajax call
			
			sessionStorage.setItem('country_state_name_selected', country_name_optionId);

			console.log ('change module name:' + country_name_optionId);

		});
		
	});


	 function loadStatesSelectBox(country_name_optionId){

		$.ajax({
            type: 'GET',
            url : '/data/states/countrySelected/' +  country_name_optionId,
            beforeSend: function(){
            	$('#add_city_cbo_state_name').empty();

 				$('#add_city_cbo_state_name')
			      	.append($("<option></option>")
 					.text(' Loading...'));
            },
            success : function(data){

            	$('#add_city_cbo_state_name').empty();
            	
            	jQuery.each(data, function(key, value) {

			      	$('#add_city_cbo_state_name')
				      	.append($("<option></option>")
     					.attr("value", value.id)
     					.text(value.state_name)); 
			    });
            }

        });	
	}

</script>

@stop

