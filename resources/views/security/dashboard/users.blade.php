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
		            <h3 class="panel-title">{!!Lang::get('labels.amount_users_logged_by_day' )!!} </h3> 

				</div>           
		     	 <div class="panel-body">
		     	 	<div class="row" align="center">
							Month: {!! Form::select('month_logged_by_day', Lang::get('calendar.longMonths'), date('n'), ['class' => 'field', 'id' => 'month_logged_by_day']) !!}
							Year:  {!! Form::selectYear('year', date('Y')-3, date('Y'), date('Y'), ['class' => 'field', 'id' => 'year_logged_by_day']) !!}

					</div>
					<div class="row" align="center" style="padding:15px">
						<span id="loading_by_day" class="label label-default" style="align:center">Loading Data...</span>	
					</div>
					<!--br-->
					<div id="amount_users_logged_by_day"  style="min-width: 200px; height: 250px; margin: 0 auto"></div>
					
				</div>	
			</div>	
		</div>
	</div>
		
	<div class="row" style="margin: 0 auto">
		<div class="col-sm-2"></div>
		<div class="col-sm-5">	
		        <div class="panel panel-default">
			        <div id="transaction-panel-header" class="panel-heading">
			        	<h3 class="panel-title">{!!Lang::get('labels.users_logged') !!}</h3>
					</div>           
		         	 <div class="panel-body">
						<div class="row" align="center">
							Month: {!! Form::select('month_users_logged', Lang::get('calendar.longMonths'), date('n'), ['class' => 'field', 'id' => 'month_users_logged']) !!}
							
							Year:  {!! Form::selectYear('year', date('Y')-3, date('Y'),  date('Y'), ['class' => 'field', 'id' => 'year_users_logged']) !!}

							
						</div>

		         	 	<br><br>

		         	 	<div class="table-responsive" style="white-space:nowrap;overflow-x:auto; overflow-y:auto; width:auto; height:240px; padding:0px">
					
							<table id="table_month_user_logged" class= "table table-striped table-bordered table-condensed table-hover"> 
								
								<tbody>
									<th>{!! Lang::get('fields.user_name')!!}</th>
					         	 	<th>{!! Lang::get('fields.user_fullname')!!}</th>
					         		<th>{!! Lang::get('fields.logs_in')!!}</th>

									@foreach ($usersLogged as $user)
						         		<tr>
						         			<td style="max-width:110px">{!!$user->username!!}</td>
						         			<td style="max-width:200px">{!!$user->user_fullname!!}</td>
						         			<td style="max-width:100px">
							         			{!!$user->login!!} 
							         			({!! round($user->login / date('d'), 1) !!}
							         			{!! Lang::get('calendar.by_day')!!})
						         			</td>
						         		</tr>
									@endforeach
								</tbody>

			         	 	</table>
		         	 	</div>

					</div>	
				</div>	
			<!--/div-->
		</div>
		<div class="col-sm-5">	
		        <div class="panel panel-default">
			        <div  class="panel-heading">
		              <h3 class="panel-title">{!!Lang::get('labels.amount_users_logged_by_month')!!}</h3>
					</div>           
		         	 <div class="panel-body">
						<div class="row" align="center">
		         	 		Year: {!! Form::selectYear('year', date('Y')-3, date('Y'), date('Y'), ['class' => 'field', 'id' => 'year_logged_by_month' ]) !!}

						</div>	
						<div class="row" align="center" style="padding:15px">
							<span id="loading_by_month" class="label label-default" style="align:center">Loading Data...</span>	
						</div>
						<!--br-->
						<div id="amount_users_logged_by_month" style="min-width: 200px; height: 250px; margin: 0 auto"></div>

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

	$('#month_logged_by_day').on('change', function(e){

		fillGraphMonthLoggedByDay();
	});


	$('#year_logged_by_day').on('change', function(e){

		fillGraphMonthLoggedByDay();
	});


	$('#month_users_logged').on('change', function(e){

		fillTableUserLogged();
	});

	$('#year_users_logged').on('change', function(e){

		fillTableUserLogged();
	});


	$('#year_logged_by_month').on('change', function(e){

		fillGraphMonthLoggedByMonth();
	});
	

	function fillGraphMonthLoggedByDay(){

		$('#loading_by_day').css('background', 'gray');

		var dataArray = new Object();

		
		dataArray.month_logged_by_day  = $("#month_logged_by_day").val();
		dataArray.year_logged_by_day   = $("#year_logged_by_day").val();

		$.post("/security/dashboard/users/statistics/monthbyday", dataArray)
		 	.done(function(responseData) {
			   	amount_users_logged_by_day.series[0].setData(responseData);
			})
			.fail(function() {
		   		 alert( "error" );
		 	})
	  		.always(function() {
	   			 $('#loading_by_day').css('background', 'white');
	   		});
	}


	function fillGraphMonthLoggedByMonth(){

		$('#loading_by_month').css('background', 'gray');

		var dataArray = new Object();
		
		dataArray.year_logged_by_month = $("#year_logged_by_month").val();

		$.post( "/security/dashboard/users/statistics/monthbymonth", dataArray)
		 	.done(function(responseData) {
			   	amount_users_logged_by_month.series[0].setData(responseData);
			})
			.fail(function() {
		   		 alert( "error" );
		 	})
	  		.always(function() {
	   			 $('#loading_by_month').css('background', 'white');
	   		});
	}

	function fillTableUserLogged(){
		
		var dataArray = new Object();
		
		dataArray.month_users_logged  = $("#month_users_logged").val();
		dataArray.year_users_logged   = $("#year_users_logged").val();


		$.post("/security/dashboard/userslogged", dataArray)
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
		if ($("#month_users_logged").val()==month){
			var daysOfMonth = new Date().getDate();	
		} else{
			var daysOfMonth = new Date($("#year_users_logged").val(), $("#month_users_logged").val(), 0).getDate();
		}
 		responseData.forEach(function(user){
 			tableRows+='<tr>';
				tableRows+='<td style="max-width:110px">'+ user.username + '</td>';
				tableRows+='<td style="max-width:200px">'+ user.user_fullname + '</td>';
				tableRows+='<td style="max-width:100px">'+ user.login + ' (' + (Math.round((user.login / daysOfMonth) * 10) / 10) + 
					' {!!Lang::get('calendar.by_day')!!})</td>';
				tableRows+='</tr>';
 		});

 		$('#table_month_user_logged tr:gt(0)').remove();
	   	$('#table_month_user_logged').append(tableRows);
	}

	//make graphs month logged by day
	var amount_users_logged_by_day= new Highcharts.Chart({!!($chartByDay)!!});
	$('#loading_by_day').css('background', 'white'); //hide the loading data text
	//make graphs month logged by month
	var amount_users_logged_by_month= new Highcharts.Chart({!!($chartByMonth)!!});
	$('#loading_by_month').css('background', 'white'); //hide the loading data text

});



</script>

@stop