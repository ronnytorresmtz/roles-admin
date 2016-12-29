
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
@if (Session::has('info'))
	<!--p class="alert alert-info" data-dismiss="alert">
	<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>	
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<strong>{!! Session::get('info') !!}</strong>
	 </p-->
	 

	 <script type="text/javascript">
		$(document).ready( function() {
			MyApp.Mensaje('info', 'Success',{!! "'" . Session::get('info') . "'" !!});
		});
	</script>

	{!!Session::forget('info')!!}
@endif

@if (Session::has('warning'))
	<!--p class="alert alert-warning" data-dismiss="alert">
	<span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<strong>{!! Session::get('warning') !!}	</strong>
	 </p-->
	 


	 <script type="text/javascript">
		$(document).ready( function() {
	    	MyApp.Mensaje('warning', {!! "'" . Session::get('warning') !!} ."'");
		});
	</script>

	{!!Session::forget('warning')!!}

@endif

@if (Session::has('error'))
	<!--p class="alert alert-danger" data-dismiss="alert">
	<span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<strong>{!! Session::get('error') !!}	</strong>
	 </p-->

	 <script type="text/javascript">
		$(document).ready( function() {
	    	MyApp.Mensaje('error', 'ERROR',{!! "'" . Session::get('error') . "'" !!});
		});
	</script>

	 {!!Session::forget('error')!!}
@endif

@if (Session::has('exception'))
	<!--p class="alert alert-danger" data-dismiss="alert">
	<span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<strong>{!! Session::get('exception') !!}	</strong>
	 </p-->

	 <script type="text/javascript">
		$(document).ready( function() {
	    	MyApp.Mensaje('error', 'ERROR', {!! "'" . Session::get('exception') . "'" !!});
		});
	</script>

	 {!!Session::forget('exception')!!}
@endif

