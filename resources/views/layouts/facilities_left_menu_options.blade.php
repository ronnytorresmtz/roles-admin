@extends('layouts.home')

<br> <br> <br> <br>
<div id="menu-header" class="col-sm-2 text-left" >
	<!--Display the left panel with system options-->
    <div id="menu-panel" class="panel panel-default">

        <div id="menu-panel-header" class="panel-heading" >
          <h3 class="panel-title">{!!Lang::get('labels.leftpanel')!!}</h3>
		</div> 

		@include('php.display_left_submenus', array('mainMenu' => 'facilities'))
	
	</div>

</div>	
	
