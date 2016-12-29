@extends('layouts.facilities_left_menu_options')

<!--"Programs Management"-->

@section('title')

	<title> {!!Lang::get('labels.list_campus')!!} </title>
@stop


@section('body')

	@include('php.top_user_message', array('keyMessage' => 'topbar_message_list', 'transaction' => 'campuss'))

	<div id="transaction-panel" class="col-sm-10" align="left">

	    <div class="panel panel-default" >
			<div class="pull-right" style="padding:6px">
        		<button id="button-fullscreen" class="btn btn-sm btn-default" data-fullscreen="false">
        			<i id="icon-fullscreen" class="glyphicon glyphicon-align-justify" ></i>
        		</button>
        	</div>

	        <div id="transaction-panel-header" class="panel-heading">
	          <h3 class="panel-title">{!!Lang::get('labels.list_campus')!!}</h3>
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
								{!!Form::label(Lang::get('fields.institute_short_name')) . ':' !!}	&nbsp;	

								{!!Form::select('institute_name', $institutes_names, Session::get('instituteIDSelected'), 
								array('class'=>'form-control','id'=>'campus_cbo_institute_name', 'autofocus' =>'autofocus',
								'style' => 'width:200px; '))!!}
							</span>
					</div>
					<!--div class="container"-->	
					<div class="col-sm-6 text-right">
						
						{!! Form::open(array('route'=> 'facilities.campuss.deleteButton'))!!}			
						
							@include('php.action_buttons',array('subMenuOption' => 'facilities.campuss'))

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
					            	{!!Lang::get('fields.campus_name')!!}
					            </th>
					            <th  data-field="description">
					            	{!!Lang::get('fields.campus_description')!!}
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
					    	@foreach($campuss as $campus)
							    <tr>
							    	<td style="min-width:30px" align="center">
							    		{!! Form::checkbox('checked_items[]',$campus->id) !!}
							    	</td>	
							    	<td style="min-width:0px">{!! $campus->id !!}</td>
							        <td style="min-width:0px"> {!! $campus->campus_name !!}</td>
							        <td style="min-width:0px">{!! $campus->campus_description !!}</td>
							        <td style="min-width:0px">{!! $campus->created_at !!}</td>
							        <td style="min-width:0px">{!! $campus->updated_at !!}</td>
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
						
						<p> {!!Lang::get('labels.showing')!!} {!!$campuss->firstitem()!!} {!!Lang::get('labels.to')!!} {!!$campuss->lastitem()!!} {!!Lang::get('labels.of')!!} {!!$campuss->total()!!} {!!Lang::get('labels.items')!!} </p>
					</div>
				</div>

				<!--Display the pagination links/buttons-->
				<div class="col-sm-9 text-right">
						{!!$campuss->render()!!}
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
		$('#campus_cbo_institute_name').on('change', function() {

		    var institute_name_optionId = $(this).find('option:selected').val();

		    console.log (institute_name_optionId);

		    if  (institute_name_optionId != null){

			    $(location).attr('href','/facilities/campuss/instituteSelected/' + institute_name_optionId );

				 sessionStorage.setItem('campus_institute_name_selected', institute_name_optionId);
			}

		});

	});

</script>

@stop