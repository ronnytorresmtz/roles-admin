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
		            <h3 class="panel-title">{!!Lang::get('labels.amount_transactions_actions_used_by_day' )!!} </h3> 

				</div>           
		     	 <div class="panel-body">
		     	 	<div class="row" align="center">
							Month: {!! Form::select('month_transactions_actions_used_by_day', Lang::get('calendar.longMonths'), date('n'), ['class' => 'field', 'id' => 'month_transactions_actions_used_by_day']) !!}
							Year:  {!! Form::selectYear('year', date('Y')-3, date('Y'), date('Y'), ['class' => 'field', 'id' => 'year_transactions_actions_used_by_day']) !!}

					</div>
					<div class="row" align="center" style="padding:15px">
						<span id="loading_by_day" class="label label-default" style="align:center">Loading Data...</span>	
					</div>
					<!--br-->
					<div id="amount_transactions_actions_used_by_day"  style="min-width: 200px; height: 250px; margin: 0 auto"></div>
					
				</div>	
			</div>	
		</div>
	</div>
		
	<div class="row" style="margin: 0 auto">
		<div class="col-sm-2"></div>

		<div class="col-sm-4">	
		       <div class="panel panel-default">
			        <div id="transaction-panel-header" class="panel-heading">
			        	<h3 class="panel-title">{!!Lang::get('labels.most_active_users') !!}</h3>
					</div>           
		         	 <div class="panel-body">
						<div class="row" align="center">
							Month: {!! Form::select('month', Lang::get('calendar.longMonths'), date('n'), ['class' => 'field', 'id' => 'month_most_active_users']) !!}
							
							Year:  {!! Form::selectYear('year', date('Y')-3, date('Y'),  date('Y'), ['class' => 'field', 'id' => 'year_most_active_users']) !!}

							
						</div>

		         	 	<br><br>

		         	 	<div class="table-responsive" style="white-space:nowrap;overflow-x:auto; overflow-y:auto; width:auto; height:240px; padding:0px">
					
							<table id="table_most_active_users" class= "table table-striped table-bordered table-condensed table-hover"> 
								
								<tbody>
									<th>{!! Lang::get('fields.user_name')!!}</th>
					         		<th>{!! Lang::get('fields.amount_of_actions')!!}</th>
					         		

									@foreach ($users as $user)
						         		<tr>
						         			<td style="max-width:110px">{!!$user->username!!}</td>
						         			<td style="max-width:100px">
							         			{!!$user->amountOfActions!!}  
							         			({!! round($user->amountOfActions / date('d'), 1) !!} 
							         			{!! Lang::get('calendar.by_day') !!})
							         		</td>
						         		</tr>
									@endforeach
								</tbody>

			         	 	</table>
		         	 	</div>

					</div>	
				</div>	
			
		</div>


		<div class="col-sm-6">	
		       <div class="panel panel-default">
			        <div id="transaction-panel-header" class="panel-heading">
			        	<h3 class="panel-title">{!!Lang::get('labels.most_transactions_actions_used') !!}</h3>
					</div>           
		         	 <div class="panel-body">
						<div class="row" align="center">
							Month: {!! Form::select('month_transactions_actions_used', Lang::get('calendar.longMonths'), date('n'), ['class' => 'field', 'id' => 'month_transactions_actions_used']) !!}
							
							Year:  {!! Form::selectYear('year', date('Y')-3, date('Y'),  date('Y'), ['class' => 'field', 'id' => 'year_transactions_actions_used']) !!}

							
						</div>

		         	 	<br><br>

		         	 	<div class="table-responsive" style="white-space:nowrap;overflow-x:auto; overflow-y:auto; width:auto; height:240px; padding:0px">
					
							<table id="table_month_transactions_actions_used" class= "table table-striped table-bordered table-condensed table-hover"> 
								
								<tbody>
									<th>{!! Lang::get('fields.module_name')!!}</th>
									<th>{!! Lang::get('fields.transaction_name')!!}</th>
									<th>{!! Lang::get('fields.action_name')!!}</th>
					         		<th>{!! Lang::get('fields.amount_of_actions')!!}</th>

									@foreach ($transactions as $transaction)
						         		<tr>
						         			<td style="max-width:110px">{!!$transaction->module_name!!}</td>
						         			<td style="max-width:110px">{!!$transaction->transaction_name!!}</td>
						         			<td style="max-width:110px">{!!$transaction->action_name!!}</td>
						         			<td style="max-width:100px">
							         			{!!$transaction->amountOfTransactionsActions!!}  
							         			({!! round($transaction->amountOfTransactionsActions / date('d'), 1) !!} 
							         			{!! Lang::get('calendar.by_day') !!})
						         			</td>
						         		</tr>
									@endforeach
								</tbody>

			         	 	</table>
		         	 	</div>

					</div>	
				</div>	
			
		</div>

		
	</div>
		

	<div class="row" style="margin: 0 auto">
		<div class="col-sm-2"></div>
		<div class="col-sm-10">	
		        <div class="panel panel-default">
			        <div  class="panel-heading">
		              <h3 class="panel-title">{!!Lang::get('labels.amount_transactions_actions_used_by_month')!!}</h3>
					</div>           
		         	 <div class="panel-body">
						<div class="row" align="center">
		         	 		Year: {!! Form::selectYear('year', date('Y')-3, date('Y'), date('Y'), ['class' => 'field', 'id' => 'year_transactions_actions_used_by_month' ]) !!}

						</div>	
						<div class="row" align="center" style="padding:15px">
							<span id="loading_by_month" class="label label-default" style="align:center">Loading Data...</span>	
						</div>
						
						<div id="amount_transactions_actions_used_by_month" style="min-width: 200px; height: 250px; margin: 0 auto"></div>

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

		$('#month_transactions_actions_used_by_day').on('change', function(e){

			fillGraphMonthTransactionsActionsUsedByDay();
		});


		$('#year_transactions_actions_used_by_day').on('change', function(e){

			fillGraphMonthTransactionsActionsUsedByDay();
		});


		$('#month_most_active_users').on('change', function(e){

			fillTableMostActiveUsers();
		});

		$('#year_most_active_users').on('change', function(e){

			fillTableMostActiveUsers();
		});


		$('#month_transactions_actions_used').on('change', function(e){

			fillTableTransactionsActionsUsed();
		});

		$('#year_transactions_actions_used').on('change', function(e){

			fillTableTransactionsActionsUsed();
		});


		$('#year_transactions_actions_used_by_month').on('change', function(e){

			fillGraphMonthTransactionsActionsUsedByMonth();
		});
		

		function fillGraphMonthTransactionsActionsUsedByDay(){

			$('#loading_by_day').css('background', 'gray');

			var dataArray = new Object();

			
			dataArray.month_transactions_actions_used_by_day  = $("#month_transactions_actions_used_by_day").val();
			dataArray.year_transactions_actions_used_by_day   = $("#year_transactions_actions_used_by_day").val();

			$.post("/security/dashboard/transactionsActions/statistics/monthbyday", dataArray)
			 	.done(function(responseData) {
				   	amount_transactions_actions_used_by_day.series[0].setData(responseData);
				})
				.fail(function() {
			   		 alert( "error1" );
			 	})
		  		.always(function() {
		   			 $('#loading_by_day').css('background', 'white');
		   		});
		}


		function fillGraphMonthTransactionsActionsUsedByMonth(){

			$('#loading_by_month').css('background', 'gray');

			var dataArray = new Object();
			
			dataArray.year_transactions_actions_used_by_month = $("#year_transactions_actions_used_by_month").val();

			$.post( "/security/dashboard/transactionsActions/statistics/monthbymonth", dataArray)
			 	.done(function(responseData) {
				   	amount_transactions_actions_used_by_month.series[0].setData(responseData);
				})
				.fail(function() {
			   		 alert( "error" );
			 	})
		  		.always(function() {
		   			 $('#loading_by_month').css('background', 'white');
		   		});
		}


		function fillTableMostActiveUsers(){
			
			var dataArray = new Object();
			
			dataArray.month_most_active_users = $("#month_most_active_users").val();
			dataArray.year_most_active_users  = $("#year_most_active_users").val();


			$.post("/security/dashboard/mostActiveUsers/statistics/mostActiveUsers", dataArray)
			 	.done(function(responseData) {

			 		loadTableRowsMostActiveUsers(responseData);
				})
				.fail(function() {
			   		 alert( "error" );
			 	})
		  		.always(function() {
		   			 $('#loading_by_day').css('background', 'white');
		   		});
		  }


		function loadTableRowsMostActiveUsers(responseData){

			var	tableRows   = '';
			var month       = new Date().getMonth() + 1; 

			// Calculate daysOfMonth for the current month (partial month) or for an old month (full days month)
			if ($("#month_most_active_users").val()==month){
				var daysOfMonth = new Date().getDate();	
			} else{
				var daysOfMonth = new Date($("#year_most_active_users").val(), $("#month_most_active_users").val(), 0).getDate();
			}
	 		responseData.forEach(function(users){
	 				tableRows+='<tr>';
	 				tableRows+='<td style="max-width:110px">'+ users.username + '</td>';
					tableRows+='<td style="max-width:100px">'+ users.amountOfActions + ' ('+
						(Math.round((users.amountOfActions / daysOfMonth) * 10) / 10) + ' {!! Lang::get('calendar.by_day') !!}) </td>';

					tableRows+='</tr>';
	 		});

	 		$('#table_most_active_users tr:gt(0)').remove();
		   	$('#table_most_active_users').append(tableRows);
		}



		function fillTableTransactionsActionsUsed(){
			
			var dataArray = new Object();
			
			dataArray.month_transactions_actions_used  = $("#month_transactions_actions_used").val();
			dataArray.year_transactions_actions_used   = $("#year_transactions_actions_used").val();


			$.post("/security/dashboard/transactionsActions/statistics/transactionsActionsUsed", dataArray)
			 	.done(function(responseData) {

			 		loadTableRowsMostActionUsed(responseData);
				})
				.fail(function() {
			   		 alert( "error" );
			 	})
		  		.always(function() {
		   			 $('#loading_by_day').css('background', 'white');
		   		});
		  }


		function loadTableRowsMostActionUsed(responseData){

			var	tableRows   = '';
			var month       = new Date().getMonth() + 1; 

			// Calculate daysOfMonth for the current month (partial month) or for an old month (full days month)
			if ($("#month_transactions_actions_used").val()==month){
				var daysOfMonth = new Date().getDate();	
			} else{
				var daysOfMonth = new Date($("#year_transactions_actions_used").val(), $("#month_transactions_actions_used").val(), 0).getDate();
			}
	 		responseData.forEach(function(transactions){
	 			tableRows+='<tr>';
	 				tableRows+='<td style="max-width:110px">'+ transactions.module_name + '</td>';
					tableRows+='<td style="max-width:110px">'+ transactions.transaction_name + '</td>';
					tableRows+='<td style="max-width:110px">'+ transactions.action_name + '</td>';
					//tableRows+='<td style="max-width:200px">'+ user.user_fullname + '</td>';
					tableRows+='<td style="max-width:100px">'+ transactions.amountOfTransactionsActions + ' ('+
						(Math.round((transactions.amountOfTransactionsActions / daysOfMonth) * 10) / 10) + ' {!! Lang::get('calendar.by_day') !!}) </td>';
					tableRows+='</tr>';
	 		});

	 		$('#table_month_transactions_actions_used tr:gt(0)').remove();
		   	$('#table_month_transactions_actions_used').append(tableRows);
		}

		//make graphs month logged by day
		console.log({!!($chartByDay)!!});
		var amount_transactions_actions_used_by_day= new Highcharts.Chart({!!($chartByDay)!!});
		$('#loading_by_day').css('background', 'white'); //hide the loading data text
		//make graphs month logged by month
		var amount_transactions_actions_used_by_month= new Highcharts.Chart({!!($chartByMonth)!!});
		$('#loading_by_month').css('background', 'white'); //hide the loading data text

	});



	</script>

@stop