{{--Display a blue box with a message base on languages files messages and menus--}}
<div class="col-sm-2"></div>
	<div id="top_user_message" class="col-sm-10">	
		<p class="bg-info" align="center">
			<br>
			{!! Lang::get('messages.' . $keyMessage, array('transaction' => strtolower (Lang::get('menus.' . $transaction)))) !!}
			<br><br>
		<p>
</div>