<?php
 session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
   header("location: index.php");
   exit;
}

?>

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
                <h4 style='padding-top: 22px; margin-bottom:-3px; max-height: 55px'><?php echo htmlspecialchars($_SESSION["name"]); ?> </b>,<a href="logout.php">Logout</a></h4>
			</div>
	</nav>
</div>


<div class="container" style='height: 160px; font-size17px'>
	<div class="row">
	<!---Start Information ---->
		<?php
                include 'navbar.php';
            ?>
	<!---End Information ---->
	
			<div class="col-md-9 Help">
			<h1>Help</h1>
			<hr>
			<hr>
			<div class="col-lg-12">
			<div class="row">
			<div class="col-xl-2 col-lg-2 col-md-2 col-sm-3 col-3">Email</div>
                <div class="col-xl-10 col-lg-10 col-md-10 col-sm-9 col-9"><input type="Email" Name="Email" pattern="/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/" class="form-control" placeholder="E-mail" required><br></div>
                
                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-3 col-3">Title</div>
                <div class="col-xl-10 col-lg-10 col-md-10 col-sm-9 col-9"><input type="Password" Name="ConfirmPassword" class="form-control"><br></div>
				
				<div class="col-xl-2 col-lg-2 col-md-2 col-sm-3 col-3">Please type your message</div>
                <div class="col-xl-10 col-lg-10 col-md-10 col-sm-9 col-9"><textarea rows="4" cols="60" class="form-control">
				</textarea><br></div>
				
				<button class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12 offset-xl-2 offset-lg-2 offset-md-2" onclick="window.location.href = '#';" id="Submit">Submit</button> 
                </form>
			</div>	
			</div>	
			</div>	
		</div>
   </div>
</body>
</html>
