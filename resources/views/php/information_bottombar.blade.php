<div id="footer" class="navbar navbar-inverse navbar-fixed-bottom">
	<div class="row" >
		<div class="col-sm-2" align="left">
			<p class="bottombrand"> {!!env('APP_NAME')!!} (2014-2016) &copy;  </p>
		</div>
		<div class="col-sm-2" align="left">
			<p class="bottombrand"> {!!Lang::get('labels.server')!!}: {!!getenv('DB_HOST')!!}  </p>
		</div>
		<div class="col-sm-2" align="left">
			<p class="bottombrand"> {!!Lang::get('labels.database')!!}: {!!getenv('DB_DATABASE')!!}  </p>
		</div>
		<div class="col-sm-2" align="left">
			<p class="bottombrand"> {!!Lang::get('labels.user_name')!!}: {!!Auth::user()->username!!}  </p>
		</div>
		{{-- <div class="col-sm-2" align="left">
			<p id="LoadingTime" class="bottombrand"> 
				{!!Lang::get('labels.loading_time')!!}: {!!round(microtime(true)-Session::get('loadingStartTime'),2)!!} seconds
			</p>
		</div> --}}
		<div class="col-sm-2" align="right">
			<p class="bottomcodeby">{!!Lang::get('labels.codeby')!!} TMTechnologies &reg; </p>
		</div>
	</div>
</div>
