
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

		<!--This section appears by default if it is not specify-->
			
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

		<!--IE9-->		
		<script src="http://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="http://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<!--x---->

		{!! HTML::style('assets/pnotify/pnotify.custom.min.css') !!}

		{!! HTML::style('assets/css/stylesheet.css') !!}

		<!--difer makes the same effect of locate the javascript file at the bottom of html-body -->

			
		
	</head>


	<body>

	<div id="wrapper">

		 			
		@include('php.navigation_login_topbar')
		

		<div id="content"> <!--style="height:770px"-->
			<br> <br> <br> <br>
			
			@yield('body')

		</div>	


		<div id="footer" class="navbar navbar-inverse navbar-fixed-bottom">
			<div class="row" >

				<div class="col-sm-6" align="left">
					<!--p style="color:#5567f1"-->
					<p class="bottombrand"> {!!env('APP_NAME')!!} (2014-2016) &copy;  </p>

				</div>
				
				<div class="col-sm-6" align="right">
					<p class="bottomcodeby">{!!Lang::get('labels.codeby')!!} TMTechnologies &reg; </p>
				</div>
			</div>
		</div>

		
	</div>

	
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		
	
	{!! HTML::script('assets/pnotify/pnotify.custom.min.js') !!}

	{!! HTML::script('assets/js/javascript.js') !!}	


	<!--script src="views/js/scripts.js"></script-->

	<script type="text/javascript">
		    $.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		    });
	</script>

	
	</body>

	</html>