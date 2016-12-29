
<div id="header" class="navbar navbar-inverse navbar-fixed-top" >
	<div class="row" style= "padding-left:15px; padding-right:30px;">	
		<div class="col-xm-1  pull-left">	
			<div class="navbar-header"5
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>


				@section('brand')
			 		<a class="navbar-brand" rel="home" href="{!!URL::route('home')!!}" style="color:white;">{!!env('APP_COMPANY')!!}
			 		</a>
				@show
			</div>	
		</div>
		<div class="collapse navbar-collapse">
			<div class="col-xm-8  pull-left">
				<ul class="nav navbar-nav" >

					<!-- DISPLAY THE MAIN MENU OPTIONS base on User Access Rights-->
					@foreach ($menuNames as $menuname)

						@if (strtolower($menuname->module_name)=='assets')
							<li><a href="{!!URL::route('fixassets')!!}">
						@else
							<li><a href="{!!URL::route(strtolower($menuname->module_name))!!}">
						@endif
						{!!Lang::get('menus.' . strtolower($menuname->module_name))!!}</a></li>
						
					@endforeach

				</ul>
			</div>

			<div class="col-xm-3 pull-right">
				
				<ul class="nav navbar-nav navbar-right">

					<li >
						<a href="#" id="user_messages" data-toggle="popover">
							<i class="glyphicon glyphicon-bell" ></i>
							<span class="badge" style="background:red">13</span> 
						</a>
					</li>

					<li style="magin:0 0 0 0">
						<a href="#" id="login_user_info" data-toggle="popover">
							<i class="glyphicon glyphicon-user"></i> 
						</a>
					 </li>

					<li>
						<a href="{!!URL::route('login.logOut')!!}">
							<i class="glyphicon glyphicon-log-out"></i>
							{!!Lang::get('menus.logout')  !!} 
						</a>
					</li>
				</ul>

			</div>

		</div>
	</div>
</div>




