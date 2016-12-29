<!-- DISPLAY THE SUBMENU OPTIONS base on User Access Rights-->

{!! ''; $column_size = 12/(ceil(count($subMenuOptions)/3)) !!}
<!-- calculate the column to divide the submenu options -->
{!! ''; $columns = ceil(count($subMenuOptions)/3)!!}
<!-- loop the number of columns -->
@for ($i = 0; $i < $columns; $i++) 
	<!-- Display a column  -->
	<div class="col-sm-{!! $column_size !!} text-left">
		<div class="list-group">
			<!-- loop the submenu option to fill each column -->
			@for ($j = 0; $j < 3; $j++) 
				<!-- check if submenOption variable has values  -->
				@if (! count($subMenuOptions)==0)
					<!--get the the first option and remove it for the subMenuOptions collection  -->	
					{!! ''; $subMenuOption = $subMenuOptions->shift()!!}
					<!-- replace space with underline and convert to lowercase -->
					{!! ''; $subMenuOption->transaction_name=strtolower(str_replace(' ', '_', $subMenuOption->transaction_name))!!}
					{!! ''; $subMenuOption->transaction_name=strtolower(str_replace('-', '_', $subMenuOption->transaction_name))!!}
					<!-- Display the submenu option link  -->
					@if ($subMenuOption->transaction_name=='dashboard')
						<a href="{!!URL::route('security.' . strtolower($subMenuOption->transaction_name) . '.users.statistics')!!}" class="list-group-item" style="color:blue;">
					@else
						@if ($subMenuOption->transaction_name=='access_rights')
							<a href="{!!URL::route('security.roles_transactions.index')!!}" class="list-group-item" style="color:blue;">
						@else
							@if ($subMenuOption->transaction_name=='campus')
								<a href="{!!URL::route('facilities.campuss.index')!!}" class="list-group-item" style="color:blue;">
							@else
								@if ($subMenuOption->transaction_name=='assets')
									<a href="{!!URL::route('fixassets.fixassets.index')!!}" class="list-group-item" style="color:blue;">
								@else
									@if (strtolower($subMenuOption->module_name)=='assets')
										<a href="{!!URL::route('fixassets.' . $subMenuOption->transaction_name . '.index')!!}" 
										class="list-group-item" style="color:blue;">
									@else
										<a href="{!!URL::route(strtolower($subMenuOption->module_name) . '.' . 
										$subMenuOption->transaction_name . '.index')!!}" class="list-group-item" style="color:blue;">
									@endif
								@endif
							@endif
						@endif
					@endif
					<!-- Display the name of the sub menu option  -->
					{!!Lang::get('menus.' . $subMenuOption->transaction_name)!!}

					</a>
				@else
					<!-- Fill the empty space in the columns with a fake option  -->
					<a class="list-group-item" style="color:blue;"> &nbsp; <a>

				@endif

			@endfor

		</div>
	</div>

@endfor