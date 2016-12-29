@extends('layouts.home')

@section('title')
	<title> {!!Lang::get('labels.access_denied')!!} </title>
@stop


@section('brand')

<a class="navbar-brand" rel="home" style="color:white;">{!!env('APP_COMPANY')!!}</a>



@stop


@section('body')

	
<div class="container">

	<br><br><br><br>

	<div class="row">
		<div class="jumbotron" style="color:#2d6ca2" >	
			<div class="text-center" >
			    <h1>{!!Lang::get('labels.access_denied')!!}</h1>
			     <p class="lead" style="color:black">{!!Lang::get('labels.home_subtitle1')!!} <br>
				    {!!Lang::get('labels.home_subtitle2')!!}</p>
				 
			</div>
		</div>
	</div>
	</div>
	
</div>	


@stop