@extends('layouts.security_left_menu_options')

@section('title')
	<title> {!!Lang::get('labels.security_dashboard')!!} </title>
@stop


@section('body')

	@include('php.top_user_message', array('keyMessage' => 'topbar_message_security_dashboard', 'transaction' => ''))

	<div class="row" style=" margin: 0 auto">

		@include('php.navigation_security_dashboard_topbar')
		
		<div class="col-sm-2"></div>
		<div class="col-sm-10">	
			<div class="panel panel-default">
		        <div id="transaction-panel-header" class="panel-heading">
		            <h3 class="panel-title">{!!Lang::get('labels.amount_modules_used_by_day' )!!} </h3> 

				</div>           
		     	 <div class="panel-body">
		     	 	<div class="row" align="center">
							Month: {!! Form::select('month_modules_used_by_day', Lang::get('calendar.longMonths'), date('n'), ['class' => 'field', 'id' => 'month_modules_used_by_day']) !!}
							Year:  {!! Form::selectYear('year', date('Y')-3, date('Y'), date('Y'), ['class' => 'field', 'id' => 'year_modules_used_by_day']) !!}

					</div>
					<div class="row" align="center" style="padding:15px">
						<span id="loading_by_day" class="label label-default" style="align:center">Loading Data...</span>	
					</div>
					<!--br-->
					<div id="amount_modules_used_by_day"  style="min-width: 200px; height: 250px; margin: 0 auto"></div>
					
				</div>	
			</div>	
		</div>
	</div>
		
	<div class="row" style="margin: 0 auto">
		<div class="col-sm-2"></div>
		<div class="col-sm-5">	
		        <div class="panel panel-default">
			        <div id="transaction-panel-header" class="panel-heading">
			        	<h3 class="panel-title">{!!Lang::get('labels.modules_used') !!}</h3>
					</div>           
		         	 <div class="panel-body">
						<div class="row" align="center">
							Month: {!! Form::select('month_modules_used', Lang::get('calendar.longMonths'), date('n'), ['class' => 'field', 'id' => 'month_modules_used']) !!}
							
							Year:  {!! Form::selectYear('year', date('Y')-3, date('Y'),  date('Y'), ['class' => 'field', 'id' => 'year_modules_used']) !!}

							
						</div>

		         	 	<br><br>

		         	 	<div class="table-responsive" style="white-space:nowrap;overflow-x:auto; overflow-y:auto; width:auto; height:240px; padding:0px">
					
							<table id="table_month_modules_used" class= "table table-striped table-bordered table-condensed table-hover"> 
								
								<tbody>
									<th>{!! Lang::get('fields.module_name')!!}</th>
									<th>{!! Lang::get('fields.transactions_used')!!}</th>
					         		<th>{!! Lang::get('fields.amount_of_actions')!!}</th>

									@foreach ($modules as $module)
						         		<tr>
						         			<td style="max-width:110px">{!!$module->module_name!!}</td>
						         			<td style="max-width:100px">{!!$module->amountOfTransactions!!}</td>
						         			<td style="max-width:100px">
							         			{!!$module->amountOfActions!!} 
							         			({!! round($module->amountOfActions / date('d'), 1) !!} 
							         			{!!Lang::get('calendar.by_day')!!})
						         			</td>
						         		</tr>
									@endforeach
								</tbody>

			         	 	</table>
		         	 	</div>

					</div>	
				</div>	
			
		</div>
		<div class="col-sm-5">	
		        <div class="panel panel-default">
			        <div  class="panel-heading">
		              <h3 class="panel-title">{!!Lang::get('labels.amount_modules_used_by_month')!!}</h3>
					</div>           
		         	 <div class="panel-body">
						<div class="row" align="center">
		         	 		Year: {!! Form::selectYear('year', date('Y')-3, date('Y'), date('Y'), ['class' => 'field', 'id' => 'year_modules_used_by_month' ]) !!}

						</div>	
						<div class="row" align="center" style="padding:15px">
							<span id="loading_by_month" class="label label-default" style="align:center">Loading Data...</span>	
						</div>
						
						<div id="amount_modules_used_by_month" style="min-width: 200px; height: 250px; margin: 0 auto"></div>

					</div>	
				</div>	
		</div>
</div>



{!! HTML::script('assets/js/jquery-1.11.1.min.js') !!}	


<script type="text/javascript">

$(document).ready(function()  {

	/* Highcharts.setOptions({
	        global: {
	        useUTC: false
	        }
	    });*/

	$('#month_modules_used_by_day').on('change', function(e){

		fillGraphMonthModulesUsedByDay();
	});


	$('#year_modules_used_by_day').on('change', function(e){

		fillGraphMonthModulesUsedByDay();
	});


	$('#month_modules_used').on('change', function(e){

		fillTableModulesUsed();
	});

	$('#year_modules_used').on('change', function(e){

		fillTableModulesUsed();
	});


	$('#year_modules_used_by_month').on('change', function(e){

		fillGraphMonthModulesUsedByMonth();
	});
	

	function fillGraphMonthModulesUsedByDay(){

		$('#loading_by_day').css('background', 'gray');

		var dataArray = new Object();

		
		dataArray.month_modules_used_by_day  = $("#month_modules_used_by_day").val();
		dataArray.year_modules_used_by_day   = $("#year_modules_used_by_day").val();

		$.post("/security/dashboard/modules/statistics/monthbyday", dataArray)
		 	.done(function(responseData) {
			   	amount_modules_used_by_day.series[0].setData(responseData);
			})
			.fail(function() {
		   		 alert( "error1" );
		 	})
	  		.always(function() {
	   			 $('#loading_by_day').css('background', 'white');
	   		});
	}


	function fillGraphMonthModulesUsedByMonth(){

		$('#loading_by_month').css('background', 'gray');

		var dataArray = new Object();
		
		dataArray.year_modules_used_by_month = $("#year_modules_used_by_month").val();

		$.post( "/security/dashboard/modules/statistics/monthbymonth", dataArray)
		 	.done(function(responseData) {
			   	amount_modules_used_by_month.series[0].setData(responseData);
			})
			.fail(function() {
		   		 alert( "error" );
		 	})
	  		.always(function() {
	   			 $('#loading_by_month').css('background', 'white');
	   		});
	}

	function fillTableModulesUsed(){
		
		var dataArray = new Object();
		
		dataArray.month_modules_used  = $("#month_modules_used").val();
		dataArray.year_modules_used   = $("#year_modules_used").val();


		$.post("/security/dashboard/modules/statistics/modulesUsed", dataArray)
		 	.done(function(responseData) {

		 		loadTableRows(responseData);
			})
			.fail(function() {
		   		 alert( "error" );
		 	})
	  		.always(function() {
	   			 $('#loading_by_day').css('background', 'white');
	   		});
	  }

	function loadTableRows(responseData){

		var	tableRows   = '';
		var month       = new Date().getMonth() + 1; 

		// Calculate daysOfMonth for the current month (partial month) or for an old month (full days month)
		if ($("#month_modules_used").val()==month){
			var daysOfMonth = new Date().getDate();	
		} else{
			var daysOfMonth = new Date($("#year_modules_used").val(), $("#month_modules_used").val(), 0).getDate();
		}
 		responseData.forEach(function(modules){
 			tableRows+='<tr>';
				tableRows+='<td style="max-width:110px">'+ modules.module_name + '</td>';
				//tableRows+='<td style="max-width:200px">'+ user.user_fullname + '</td>';
				tableRows+='<td style="max-width:100px">'+ modules.amountOfTransactions + '</td>';
				tableRows+='<td style="max-width:100px">'+ modules.amountOfActions + ' (' + (Math.round((modules.amountOfActions / daysOfMonth) * 10) / 10) + ' {!!Lang::get('calendar.by_day')!!})</td>';
				
 		});

 		$('#table_month_modules_used tr:gt(0)').remove();
	   	$('#table_month_modules_used').append(tableRows);
	}

	//make graphs month logged by day
	var amount_modules_used_by_day= new Highcharts.Chart({!!($chartByDay)!!});
	$('#loading_by_day').css('background', 'white'); //hide the loading data text
	//make graphs month logged by month
	var amount_modules_used_by_month= new Highcharts.Chart({!!($chartByMonth)!!});
	$('#loading_by_month').css('background', 'white'); //hide the loading data text

});



</script>

@stop