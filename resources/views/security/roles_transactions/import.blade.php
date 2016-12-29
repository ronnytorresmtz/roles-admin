@extends('layouts.security_left_menu_options')

@section('title')
	<title> {!!Lang::get('labels.import_roles_transactions')!!} </title>
@stop


@section('body')

@include('php.top_user_message', array('keyMessage' => 'topbar_message_import', 'transaction' => 'access_rights'))

<div id="transaction-panel" class="col-lg-10" align="left">

    <div class="panel panel-default">
        <div class="pull-right" style="padding:6px">
    		<button id="button-fullscreen" class="btn btn-xs btn-default" data-fullscreen="false">
    			<i id="icon-fullscreen" class="glyphicon glyphicon-align-justify" ></i>
    		</button>
    	</div>
        <div id="transaction-panel-header" class="panel-heading">

          <h3 class="panel-title">{!!Lang::get('labels.import_roles_transactions')!!}</h3>
       
		</div>           
     	 <div class="panel-body">


			<div class="row">
				<!--Display a message return from the controller in the Session Object-->
				<div class="col-sm-12 text-center">
						
						@include('php.popup_message')
						
				</div>
			</div>

			{!! Form::open(array('route'=>'security.roles_transactions.import','files'=>true)) !!}

				{!! Form::label(Lang::get('labels.upload_file')) !!}

				{!! Form::file('fileToImport') !!}

			  	<br/><br/>

				{!! Form::submit(Lang::get('buttons.import'), array('class'=>"btn btn-sm btn-primary")) !!}
			  
			  	{!! Form::reset(Lang::get('buttons.clear'), array('class'=>"btn btn-sm btn-primary")) !!}

			  	{!!link_to(URL::route('security.roles_transactions.role_selected', Session::get('roleIDSelected')), 
						Lang::get('buttons.back'), array('class' => 'btn btn-sm btn-primary'))!!}
						
		  
		 	 {!! Form::close() !!}

		</div>
	</div>	
</div>
	
@stop




 

 
