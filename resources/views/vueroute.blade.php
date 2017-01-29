<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
  <meta charset="UTF-8">
  <title>Roles Admin</title>

  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="assets/css/font-awesome.min.css">
 
 </head>
 
 <body>

  <div id="app">

    <router-view></router-view>
 
  </div>
 
 </body>

 <script>   
    window.Laravel = {!! json_encode([ 'csrfToken' => csrf_token(),]); !!} 
 </script>

 <script src="assets/js/jquery-1.11.1.min.js"></script>
 <script src="assets/js/highcharts/highcharts.js"></script>
 <script src="assets/js/bootstrap.min.js"></script>
 <script src="js/vueroute.js"></script>
 
 </html>