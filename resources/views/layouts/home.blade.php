<!DOCTYPE html>
  
  <html lang="en">
  
	  <head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content="">
	    <meta name="author" content="">
	    <meta name="csrf-token" content="{{ csrf_token() }}" />

		@section('title')
			<title>Title Description</title>
		@show

		
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
		<!--link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css" rel="stylesheet">
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"-->
		
		<!--{!! HTML::style('assets/css/bootstrap.min.css') !!} -->
		
		{!! HTML::style('assets/css/bootstrap-theme.min.css') !!}
		{!! HTML::style('assets/css/font-awesome.min.css') !!}

		{!! HTML::style('assets/pnotify/pnotify.custom.min.css') !!}
		{!! HTML::style('assets/css/stylesheet.css') !!}
		
	</head>

	<body >
 

		<div id="wrapper">

			 			
			@include('php.navigation_topbar')

		
			<div id="content" > 

				@yield('body')

			</div>


		{{--@include('php.information_bottombar')--}}
			
			
		</div>
		
		<!--script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<!-IE9-->		
		<!--script src="http://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="http://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script-->
		<!---->

		{!! HTML::script('assets/js/jquery-1.11.1.min.js') !!}	
		{!! HTML::script('assets/js/bootstrap.min.js') !!}
		<!--IE9-->	
		{!! HTML::script('assets/js/html5shiv.js') !!}
		{!! HTML::script('assets/js/respond.min.js') !!}
		<!--IE9-->
		{!! HTML::script('assets/pnotify/pnotify.custom.min.js') !!}
		{!! HTML::script('assets/js/javascript.js') !!}	

		{!! HTML::script('assets/js/highcharts/highcharts.js') !!}			
		{!! HTML::script('assets/js/highcharts/exporting.js') !!}


		<script type="text/javascript">

		
		    $.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		    });

		   


		    $('#user_messages').popover({
				title: '{!!Lang::get('labels.user_notifications')!!}',
				placement: 'bottom', 
				//trigger:'hover', 
				//container: 'body',
				html: true,
				content: '<div class="list-group" style="width:250px">' +
							'<a href="#" class="list-group-item" style="width:250px">' +
							  	'{!!Lang::get('labels.new_messages')!!}' + '<span class="badge" style="background:gray">6</span>' +
							'</a>' +
							'<a href="#" class="list-group-item" style="width:250px">' +
							  	'{!!Lang::get('labels.new_alerts')!!}'  +  '<span class="badge" style="background:red">3</span>' +
							'</a>' +
							'<a href="#" class="list-group-item" style="width:250px">' +
							  	'{!!Lang::get('labels.new_reminders')!!}'   + '<span class="badge" style="background:gray">2</span>' +
							'</a>' +
							'<a href="#" class="list-group-item" style="width:250px">' +
							  	'{!!Lang::get('labels.new_events')!!}'  + '<span class="badge" style="background:gray"></span>' +
							'</a>' +
							'<a href="#" class="list-group-item" style="width:250px">' +
							  	'{!!Lang::get('labels.new_autorizations')!!}'  + '<span class="badge" style="background:gray">2</span>' +
							'</a>' +
						 '</div>'
		    });


		    $('#login_user_info').popover({
				title: '{!!Lang::get('labels.login_user_information')!!}',
				placement: 'bottom', 
				//trigger:'hover', 
				//container: 'body',
				html: true,
				content: '<div style="width:250px; padding:10px">' +
						
							'<strong>{!!Lang::get('labels.user_name')!!}:</strong><br>  {!!Auth::user()->username!!} <br>'  +
							'<strong>{!!Lang::get('labels.user_fullname')!!}:</strong> <br>{!! Auth::user()->user_fullname !!}  <br>' +
							'<strong>{!!Lang::get('labels.user_email')!!}:</strong> <br>{!! Auth::user()->email !!}' +
							'<hr>' +
							'</i><a href="#"> {!!Lang::get('labels.change_email')!!}</a> <br>' +
							'<a href="#"> {!!Lang::get('labels.change_password')!!}</a>' +
						
						'</div>'
		    });


		     $('#login_user_info').on('click', function(){

		     	$('#user_messages').popover('hide');	
		     });

		     $('#user_messages').on('click', function(){

		     	$('#login_user_info').popover('hide');	
		     });


		</script>

	</body>

</html>