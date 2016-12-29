
<div id="header" class="navbar navbar-inverse navbar-fixed-top" >
		
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		</button>
		@section('brand')
	 		<a class="navbar-brand" rel="home" style="color:white;">{!!env('APP_COMPANY')!!}</a>
		@show
	</div>	
	
	<div class="col-sm-12 col-md-1 pull-right">
		<ul class="nav navbar-nav navbar-right">
			<li>
				<a href="{!!URL::to('login')!!}">
					<i class="glyphicon glyphicon-log-in"></i>&nbsp;{!!Lang::get('menus.login')!!}
				</a>
			</li>
		</ul>
	</div>
	


</div>


