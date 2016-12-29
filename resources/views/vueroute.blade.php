<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
  <meta charset="UTF-8">
  <title>MegaCampus</title>
  {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> --}}

  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="assets/css/font-awesome.min.css">


  {{-- favicon --}}
 <!-- <link rel="icon" type="image/png" href="/assets/icons/loading_image.ico" /> -->
 
 </head>
 
 <body>
 
  <div id="app">
 
    <topmenu></topmenu> 
    <router-view></router-view>
 
  </div>
 
 </body>
 
 <script src="assets/js/jquery-1.11.1.min.js"></script>
 {{-- <script src="assets/js/chartjs.bundle.min.js"></script> --}}
 <script src="assets/js/highcharts/highcharts.js"></script>
 <script src="assets/js/bootstrap.min.js"></script>
 <script src="js/vueroute.js"></script>
 
 </html>