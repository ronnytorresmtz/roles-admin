<!-- DISPLAY THE SUBMENU OPTIONS base on User Access Rights-->

{{-- Get the menu options from the App\Http\ViewComposers\SubMenuOptionsComposer class--}}
@foreach ($subMenuOptions as $subMenuOption)
	
	<!-- replace space with underline and convert to lowercase -->
	{!! ''; $subMenuOption->transaction_name=strtolower(str_replace(' ', '_', $subMenuOption->transaction_name))!!}
	
	@if ($subMenuOption->transaction_name=='Assets')
		{!!$subMenuOption->transaction_module=='fxassets'!!}
		{!!$subMenuOption->transaction_name=='fxassets'!!}
	@endif
	<!-- Display the submenu option link  -->
	@if ($subMenuOption->transaction_name=='dashboard')
		<a href="{!!URL::route('security.dashboard.users.statistics')!!}"
		   class="list-group-item" style="color:blue;">
	@else
		@if ($subMenuOption->transaction_name=="access_rights")
			<a href="{!!URL::route('security.roles_transactions.index')!!}" class="list-group-item" style="color:blue;">
		@else
			@if ($subMenuOption->transaction_name=='campus')
				<a href="{!!URL::route('facilities.campuss.index')!!}"
				   class="list-group-item" style="color:blue;">
			@else
				<a href="{!!URL::route($mainMenu . '.' . $subMenuOption->transaction_name . '.index')!!}"
				   class="list-group-item" style="color:blue;">
			@endif
		@endif
	@endif

	{!!Lang::get('menus.' . $subMenuOption->transaction_name) !!} 	
	</a>



@endforeach

<a class="list-group-item" style="color:blue">
&nbsp;
</a>

<a href="#" class="list-group-item" style="color:blue">
{!!Lang::get('menus.help')!!}
</a>
