@extends('layouts.home')

@section('title')
	<title> {!!env('APP_NAME')!!} Home </title>
@stop


@section('brand')

<a class="navbar-brand" rel="home" style="color:white;">{!!env('APP_COMPANY')!!}</a>



@stop


@section('body')

<div class="container">

	<br><br><br><br>

	<div class="row">
		<div class="jumbotron" >	
			<div class="text-center">
			    <h1>{!!Lang::get('labels.home_title')!!}</h1>
			     <p class="lead">{!!Lang::get('labels.home_subtitle1')!!} <br>
				    {!!Lang::get('labels.home_subtitle2')!!}</p>
			</div>
		</div>
	</div>
	
	<div class="row">

		<div class="col-lg-4" align="center">
								
			<div class="panel panel-default">
	            <div class="panel-heading">

					<h3 class="panel-title">{!!Lang::get('labels.home_group1')!!}</h3>

	           	</div>

              	<div class="panel-body bg-gray">
					<div class="ul">
						<div class="li">3er Grade Month Exams</div>
						<div class="l">Student Evaluation</div>
						<div class="li">Start Final Exams</div>
						<div class="li">Start Final Exams</div>
						<div class="li">Start Final Exams</div>
					</div>
					
					
				</div>
			
			</div>	
		</div>

		<div class="col-lg-4" align="center">
			<div class="panel panel-default">
	            <div class="panel-heading">

					<h3 class="panel-title">{!!Lang::get('labels.home_group2')!!}</h3>

	           	</div>

              	<div class="panel-body bg-gray" sytle="height:200px">
					<div class="ul">
						<div class="li">3er Grade Month Exams</div>
						<div class="l">Student Evaluation</div>
						<div class="li">Start Final Exams</div>
						<div class="li">Start Final Exams</div>
						<div class="li">Start Final Exams</div>
					</div>
					
				</div>
			
			</div>	
		</div>

		<div class="col-lg-4" align="center">
			<div class="panel panel-default">
	            <div class="panel-heading">

					<h3 class="panel-title">{!!Lang::get('labels.home_group3')!!}</h3>

	           	</div>

              	<div class="panel-body bg-gray" sytle="height:200px">
					<div class="ul">
						<div class="li">3er Grade Month Exams</div>
						<div class="l">Student Evaluation</div>
						<div class="li">Start Final Exams</div>
						<div class="li">Start Final Exams</div>
						<div class="li">Start Final Exams</div>
						
					</div>
					
				</div>
			
			</div>	
		</div>
	</div>

	
	
</div>	

<br><br><br><br>


@stop