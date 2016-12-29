
<!--script to display form field validations-->
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

@if ($errors->all())

	<!--div class="alert alert-danger" data-dismiss="alert">

	 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<strong>ERRORS:
			{!! HTML::ul($errors->all())!!}
			</strong>

			
	</div-->	

	<script>
		$(document).ready( function() {
			MyApp.Mensaje('error', 'ERROR',{!! "'" . $errors->first() . "'" !!});
		});
	</script>
@endif
