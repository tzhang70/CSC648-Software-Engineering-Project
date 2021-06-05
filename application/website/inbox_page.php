<html>
<head>
<link rel="stylesheet" type="text/css" href="CSS/styles.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <style>
	body{
		font-size: 14px;
	}
  </style>
</head>
<body>

<div class="container-fluid" style='height: 65px !important; padding-left: 0%; max-height: 65px'>
	<nav class="navbar navbar-expand-sm bg-dark navbar-dark" style='padding-left: 0%'>
			<div class="col-md-12" style='padding-left: 0%'>
				<a style='padding-left: 0%' class="navbar-brand" href="account_info.html"><img style='padding-left: 0%; max-height: 55px' src="icon_images/logo.png" Alt="logo"></a>
				<h4 style='padding-top: 22px; margin-bottom:-3px; max-height: 55px'>Daniel Tomasevich,<a href="Index_Page.html">Logout</a></h4>
			</div>
	</nav>
</div>


<div class="container">
	<div class="row">
	<!---Start Information ---->
		<?php
                     include 'navbar.php';
            ?>
	<!---End Information ---->
	
			<div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-9 Inbox" style='font-size:17px'>
			<h1 style='margin-top: -2%;'>Inbox</h1>
			<hr>
			<hr>
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 incoming">
			<li><a name="Chooese" type='link' value="incoming" id="incoming">You Have an incoming appointment.</a><br></li>
				
			</div>	
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 incoming">
			<li><a name="Chooese" type='link' value="Cancelled" id="Cancelled">You Cancelled your appointment with Jaccob Pluto.</a><br></li>
			</div>	
		</div>
   </div>
</body>
</html>
