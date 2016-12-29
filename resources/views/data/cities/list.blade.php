@extends('layouts.data_left_menu_options')

<!--"Programs Management"-->

@section('title')

	<title> {!!Lang::get('labels.list_city')!!} </title>
@stop


@section('body')

	@include('php.top_user_message', array('keyMessage' => 'topbar_message_list', 'transaction' => 'cities'))

	<div id="transaction-panel" class="col-sm-10" align="left">

	    <div class="panel panel-default" >
			<div class="pull-right" style="padding:6px">
        		<button id="button-fullscreen" class="btn btn-sm btn-default" data-fullscreen="false">
        			<i id="icon-fullscreen" class="glyphicon glyphicon-align-justify" ></i>
        		</button>
        	</div>

	        <div id="transaction-panel-header" class="panel-heading">
	          <h3 class="panel-title">{!!Lang::get('labels.list_city')!!}</h3>
			</div>           

	        <div class="panel-body">
				<div class="row">
					<!--Display a message return from the controller in the Session Object-->
					<div class="col-sm-12 text-center">
							
							@include('php.popup_message')

					</div>
				</div>
					
				<div class="row">

					<!-- Form for the Search Text/Button-->
					<div class="col-sm-6 text-left">	

						    <span class="form-inline">
						    	{!!Form::label(Lang::get('fields.country_name')) . ':' !!}	&nbsp;	

								{!!Form::select('state_name', $countries_names, Session::get('countryIDSelected'), 
								array('class'=>'form-control','id'=>'country_cbo_state_name', 'autofocus' =>'autofocus',
								'style' => 'width:150px; '))!!} &nbsp;

								{!!Form::label(Lang::get('fields.state_name')) . ':' !!}	&nbsp;	

								{!!Form::select('state_name', $states_names, Session::get('stateIDSelected'), 
								array('class'=>'form-control','id'=>'city_cbo_state_name', 'autofocus' =>'autofocus',
								'style' => 'width:150px; '))!!}
							</span>
					</div>
				
					<!--div class="container"-->	
					<div class="col-sm-6 text-right">
						
						{!! Form::open(array('route'=> 'data.cities.deleteButton'))!!}			
						
							@include('php.action_buttons',array('subMenuOption' => 'data.cities'))
							
					</div>
					
				</div>

				<div class="table-responsive" style="white-space:nowrap;overflow-x:auto; overflow-y:auto; width:auto; height:305px; padding:0px">
					
					<table class= "table table-striped table-bordered table-condensed table-hover"> 
					    <thead>
					         <tr>
					            <!--Displays the Table Headers"-->
					            
					            <th></th>

					             <th data-field="id">
					            	{!!Lang::get('fields.id')!!}
					            </th>
					            
					            <th data-field="name">
					            	{!!Lang::get('fields.city_name')!!}
					            </th>
					            <th  data-field="description">
					            	{!!Lang::get('fields.city_description')!!}
					            </th>
					            <th  data-field="created_at">
					            	{!!Lang::get('fields.created_at')!!}
					            </th>
					            <th data-field="updated_at">
					            	{!!Lang::get('fields.updated_at')!!}
					            </th>
					        </tr>
					    </thead>

						<tbody >		

							<!-- Populate the Table Display-->
					    	@foreach($cities as $city)
							    <tr>
							    	<td style="min-width:30px" align="center">
							    		{!! Form::checkbox('checked_items[]',$city->id) !!}
							    	</td>	
							    	<td style="min-width:0px">{!! $city->id !!}</td>
							        <td style="min-width:0px"> {!! $city->city_name !!}</td>
							        <td style="min-width:0px">{!! $city->city_description !!}</td>
							        <td style="min-width:0px">{!! $city->created_at !!}</td>
							        <td style="min-width:0px">{!! $city->updated_at !!}</td>
							    </tr>
					    	@endforeach

						</tbody>

					</table>
				

				</div>

				{!! Form::close() !!}

				<br>
				<!-- Display a label with the from/to of the pagination-->					
				<div class="col-sm-3 text-left">
					<div align="left">
						
						<p> {!!Lang::get('labels.showing')!!} {!!$cities->firstitem()!!} {!!Lang::get('labels.to')!!} {!!$cities->lastitem()!!} {!!Lang::get('labels.of')!!} {!!$cities->total()!!} {!!Lang::get('labels.items')!!} </p>
					</div>
				</div>

				<!--Display the pagination links/buttons-->
				<div class="col-sm-9 text-right">
						{!!$cities->render()!!}
				</div>

			</div>

		</div>
	</div>
</div>

<!--Display a messagebox for confirm when the user wants to delete an item-->
@include('php.messagebox')

<script type="text/javascript">
	
	$(document).ready(function() {

		sessionStorage.setItem('country_state_name_selected', '{!!Session::get('countryIDSelected')!!}');

		// Set a Seesion Key with the Role Name ComboBox Value
		$('#country_cbo_state_name').on('change', function() {

		    var country_name_optionId = $(this).find('option:selected').val();

		    if  (country_name_optionId != null){

			    $(location).attr('href','/data/cities/countrySelected/' + country_name_optionId );

				 sessionStorage.setItem('country_state_name_selected', country_name_optionId);
			}

		});



		// Set a Seesion Key with the Role Name ComboBox Value
		$('#city_cbo_state_name').on('change', function() {

		    var state_name_optionId = $(this).find('option:selected').val();

		    var country_name_optionId = sessionStorage.getItem('country_state_name_selected');

		    if  (state_name_optionId != null){

		    	console.log (country_name_optionId + '/' + state_name_optionId);

			    $(location).attr('href','/data/cities/stateSelected/' + country_name_optionId + '/' + state_name_optionId);

			    sessionStorage.setItem('city_state_name_selected', state_name_optionId);
			}

		});

	});

</script>

@stop