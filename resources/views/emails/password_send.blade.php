<!DOCTYPE html>
	  
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
</head>
</body>




<p>{!!Lang::get('labels.greeting')!!} {!!$user_fullname!!},<p>

<p> {!!Lang::get('labels.click_link_message')!!}

<p>{!!Lang::get('labels.remember_secutiry_code')!!}: {!!$remember_security_number!!} <p>

<p>{!!Lang::get('labels.omit_message')!!} </p>

<a href="{!!$link!!}">{!!$link!!}</a>

<br>
<br>
<br>

<p>--------------</p>

<p> {!!Lang::get('labels.send_by')!!}  {!!env('APP_NAME')!!}  </p>


</body>
</html>


