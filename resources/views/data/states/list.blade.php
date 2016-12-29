@extends('layouts.data_left_menu_options')

<!--"Programs Management"-->

@section('title')

	<title> {!!Lang::get('labels.list_state')!!} </title>
@stop


@section('body')

	@include('php.top_user_message', array('keyMessage' => 'topbar_message_list', 'transaction' => 'states'))

	<div id="transaction-panel" class="col-sm-10" align="left">

	    <div class="panel panel-default" >
			<div class="pull-right" style="padding:6px">
        		<button id="button-fullscreen" class="btn btn-sm btn-default" data-fullscreen="false">
        			<i id="icon-fullscreen" class="glyphicon glyphicon-align-justify" ></i>
        		</button>
        	</div>

	        <div id="transaction-panel-header" class="panel-heading">
	          <h3 class="panel-title">{!!Lang::get('labels.list_state')!!}</h3>
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

								{!!Form::select('country_name', $countries_names, Session::get('countryIDSelected'), 
								array('class'=>'form-control','id'=>'state_cbo_country_name', 'autofocus' =>'autofocus',
								'style' => 'width:200px; '))!!}
							</span>
					</div>
				
					<!--div class="container"-->	
					<div class="col-sm-6 text-right">
						
						{!! Form::open(array('route'=> 'data.states.deleteButton'))!!}			
						
							@include('php.action_buttons',array('subMenuOption' => 'data.states'))

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
					            	{!!Lang::get('fields.state_name')!!}
					            </th>
					            <th  data-field="description">
					            	{!!Lang::get('fields.state_description')!!}
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
					    	@foreach($states as $state)
							    <tr>
							    	<td style="min-width:30px" align="center">
							    		{!! Form::checkbox('checked_items[]',$state->id) !!}
							    	</td>	
							    	<td style="min-width:0px">{!! $state->id !!}</td>
							        <td style="min-width:0px"> {!! $state->state_name !!}</td>
							        <td style="min-width:0px">{!! $state->state_description !!}</td>
							        <td style="min-width:0px">{!! $state->created_at !!}</td>
							        <td style="min-width:0px">{!! $state->updated_at !!}</td>
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
						
						<p> {!!Lang::get('labels.showing')!!} {!!$states->firstitem()!!} {!!Lang::get('labels.to')!!} {!!$states->lastitem()!!} {!!Lang::get('labels.of')!!} {!!$states->total()!!} {!!Lang::get('labels.items')!!} </p>
					</div>
				</div>

				<!--Display the pagination links/buttons-->
				<div class="col-sm-9 text-right">
						{!!$states->render()!!}
				</div>

			</div>

		</div>
	</div>
</div>

<!--Display a messagebox for confirm when the user wants to delete an item-->
@include('php.messagebox')

<script type="text/javascript">
	
	$(document).ready(function() {

		// Set a Seesion Key with the Role Name ComboBox Value
		$('#state_cbo_country_name').on('change', function() {

		    var country_name_optionId = $(this).find('option:selected').val();

		    if  (country_name_optionId != null){

			    $(location).attr('href','/data/states/countrySelected/' + country_name_optionId );

				 sessionStorage.setItem('state_country_name_selected', country_name_optionId);
			}

		});

	});

</script>

@stop