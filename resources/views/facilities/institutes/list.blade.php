@extends('layouts.facilities_left_menu_options')

<!--"Programs Management"-->

@section('title')

	<title> {!!Lang::get('labels.list_institute')!!} </title>
@stop


@section('body')

	@include('php.top_user_message', array('keyMessage' => 'topbar_message_list', 'transaction' => 'institutes'))

	<div id="transaction-panel" class="col-sm-10" align="left">

	    <div class="panel panel-default" >
			<div class="pull-right" style="padding:6px">
        		<button id="button-fullscreen" class="btn btn-sm btn-default" data-fullscreen="false">
        			<i id="icon-fullscreen" class="glyphicon glyphicon-align-justify" ></i>
        		</button>
        	</div>

	        <div id="transaction-panel-header" class="panel-heading">
	          <h3 class="panel-title">{!!Lang::get('labels.list_institute')!!}</h3>
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
					<div class="col-sm-4 text-right">	

						{!! Form::open(array('route' => 'facilities.institutes.search', 'method' => 'get')) !!}

							<div class="input-group">
							  	   
								<input name="search_value" type="text" maxlength="25" placeholder="{!!Lang::get('labels.searchingtext')!!}" class="form-control" autofocus="autofocus">
								</input>
							    <span class="input-group-btn"  >
							    	<button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search" style="padding:3px"></i></button>
						      	</span>

						    </div>
												  
						{!! Form::close() !!}

					</div>
			
					<div class="col-sm-2 text-left">	
						<!--TODO: Hide and Show with JQuery if a Search was executed-->
						<div id='filter-label-left'> 
							<h4>
							{!!Form::label('',$label_search,array('class'=>'label label-warning'))!!}
							</h4>
						</div>
					</div>
				
					<!--div class="container"-->	
					<div class="col-sm-6 text-right">
						
						{!! Form::open(array('route'=> 'facilities.institutes.deleteButton'))!!}			
						
							@include('php.action_buttons',array('subMenuOption' => 'facilities.institutes'))

					</div>
				
				</div>

				<div class="table-responsive" style="white-space:nowrap;overflow-x:auto; overflow-y:auto; width:auto; height:305px; padding:0px">
					
					<table class= "table table-striped table-bordered table-condensed table-hover"> 
						<!--table-hover" -->
					    <thead>
					         <tr>
					            <!--Displays the Table Headers"-->
					            
					            <!--th data-field="id"></th-->

					            <th></th>

					             <th data-field="id">
					            	{!!Lang::get('fields.id')!!}
					            </th>
					            
					            <th data-field="name">
					            	{!!Lang::get('fields.institute_short_name')!!}
					            </th>
					            <th  data-field="description">
					            	{!!Lang::get('fields.institute_long_name')!!}
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
					    	@foreach($institutes as $institute)
							    <tr>
							    	<td style="min-width:30px" align="center">
							    		{!! Form::checkbox('checked_items[]',$institute->id) !!}
							    	</td>	
							    	<td style="min-width:0px">{!! $institute->id !!}</td>
							        <td style="min-width:0px">{!! $institute->institute_short_name !!}</td>
							        <td style="min-width:0px">{!! $institute->institute_long_name !!}</td>
							        <td style="min-width:0px">{!! $institute->created_at !!}</td>
							        <td style="min-width:0px">{!! $institute->updated_at !!}</td>
							    </tr>
					    	@endforeach

						</tbody>

					</table>
				

				</div>

				{!! Form::close() !!}

				<!--/div-->

				<br>
				<!-- Display a label with the from/to of the pagination-->					
				<div class="col-sm-3 text-left">
					<div align="left">
						
						<p> {!!Lang::get('labels.showing')!!} {!!$institutes->firstitem()!!} {!!Lang::get('labels.to')!!} {!!$institutes->lastitem()!!} {!!Lang::get('labels.of')!!} {!!$institutes->total()!!} {!!Lang::get('labels.items')!!} </p>
					</div>
				</div>

				<!--Display the pagination links/buttons-->
				<div class="col-sm-9 text-right">
						{!!$institutes->appends(array('search_value' => $search_value))->render()!!}
				</div>

			</div>

		</div>
	</div>
</div>

<!--Display a messagebox for confirm when the user wants to delete an item-->
@include('php.messagebox')


@stop