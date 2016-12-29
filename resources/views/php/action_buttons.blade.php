{{--all these buttons are in a Laravel Form--}}

<!--View Button-->
<button type="submit" 
	class="btn btn-sm btn-primary"
	formaction="{!!URL::route ($subMenuOption. '.viewButton')!!}">
	<i class="glyphicon glyphicon-file"></i>
	{!!Lang::get('buttons.view')!!}
</button>

<!--Add Button-->
<a 	href="{!!URL::route($subMenuOption. '.create')!!}" 
	class="btn btn-sm btn-primary"
	{!! (($transactionActionId['transaction_action_id']==2) ? 'disabled' : '') !!}>
	
	<i class="glyphicon glyphicon-plus"></i>
	{!!Lang::get('buttons.add')!!}
</a>

<!--Edit Button-->
<button  
	{!! (($transactionActionId['transaction_action_id']==2) ? 'disabled' : '') !!}
	type="submit" 
	class="btn btn-sm btn-primary"
	formaction="{!!URL::route ($subMenuOption. '.editButton')!!}">
	<!--formmethod="post" -->
	<i class="glyphicon glyphicon-pencil"></i>
	{!!Lang::get('buttons.edit')!!}
</button>

<!--Delete Button-->
<button 
	{!! (($transactionActionId['transaction_action_id']==2) ? 'disabled' : '') !!}
	class="btn btn-sm btn-primary" 
	type="button" 
	data-toggle="modal" 
	data-target="#modalWindow" 
	data-title= "{!!Lang::get('messages.question')!!}"
	data-message= "{!!Lang::get('messages.question_message')!!}"> 
	<i class="glyphicon glyphicon-trash"></i>
	{!!Lang::get('buttons.delete')!!}
</button>

<!--Export Button-->
<a href="{!!URL::route($subMenuOption. '.export')!!}" class="btn btn-sm btn-primary">		
	<i class="glyphicon glyphicon-open"></i>
	{!!Lang::get('buttons.export')!!}
</a>

<!--Import Button-->
<a href="{!!URL::route ($subMenuOption. '.import_file')!!}" 
class="btn btn-sm btn-primary"
{!! (($transactionActionId['transaction_action_id']==2) ? 'disabled' : '') !!}>	 

<i class="glyphicon glyphicon-save"></i>
	{!!Lang::get('buttons.import')!!}
</a>