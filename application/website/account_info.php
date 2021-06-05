<?php

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
	header("location: index.php");
	exit;
}

require_once "config.php";

$new_name = $new_password = "";
$new_name_err = $new_password_err ="";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	if(empty($_POST["new_name"]))
	{
		$new_name_err = "Please enter a name.";
	}
	else{
		$new_name = trim($_POST["new_name"]);
	}


	if(empty($_POST["new_password"]))
	{
		$new_password_err = "Please enter a name.";
	}
	else{
		$new_password = trim($_POST["new_password"]);
	}


	if(empty($new_name_err)){
        
        $sql = "UPDATE users_list SET name=? WHERE uid = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "si", $param_name,  $param_id);

            
            $param_name = $new_name;
            $param_id = $_SESSION["id"];

            
            if(mysqli_stmt_execute($stmt)){
                
                session_destroy();
                header("location: homepage_student.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);
    }

	if(empty($new_password_err)){
        
        $sql = "UPDATE users_list SET  password=? WHERE uid = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);

            
            $param_password =password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];

            
            if(mysqli_stmt_execute($stmt)){
                
                session_destroy();
                header("location: homepage_student.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);
    }
   
    mysqli_close($link);
}
?>



<!DOCTYPE html>
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
				<a style='padding-left: 0%' class="navbar-brand" href="index.php"><img style='padding-left: 0%; max-height: 55px' src="icon_images/logo.png" Alt="logo"></a>
				<h4 style='padding-top: 22px; margin-bottom:-3px; max-height: 55px'><?php echo htmlspecialchars($_SESSION["name"]); ?> </b>,<a href="logout.php">Logout</a></h4>
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
	
	<!--Start Account Information--->
		<div class="col-md-9 Account" style='font-size:17px'>
		<div class="col-lg-12">
				
		<h1>Account Information</h1><hr><hr>
		<!---Name satrt --->
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		<div class="row">
			<div class="col-sm-2">
					Name:
			</div>
                
                <div class="col-sm-8">
                <input type="text" name="new_name" class="form-control" placeholder="Name">
                </div>
					<div class="col-sm-2">
						<div class="btn-group">
							<button><a href="#">Add</a>/<a href="#">Edit</a></button>
						</div>
					</div>
			</div>
			<!---Name end --->
            <p>&nbsp;</p>
			<div class="row">
            <div class="col-sm-2">
					Status:
			</div>
                <div class="col-sm-8">
                    <input type="text" Name="Status" class="form-control" placeholder="Status">
                </div>
					<div class="col-sm-2">
						<div class="btn-group">
							<button><a href="#">Add</a>/<a href="#">Edit</a></button>
						</div>
					</div>
				</div>
			<!---Status end --->

            <p>&nbsp;</p>
			<div class="row">
            <div class="col-sm-2">
					Courses:
			</div>
                <div class="col-sm-8">
                    <input type="text" Name="Courses" class="form-control" placeholder="Courses">
                </div>
					<div class="col-sm-2">
						<div class="btn-group">
							<button><a href="#">Add</a>/<a href="#">Edit</a></button>
						</div>
					</div>
				</div>
			<!---Courses end --->
            <p>&nbsp;</p>
			<div class="row">
            <div class="col-sm-2">
					Password:
			</div>
                <div class="col-sm-8">
                    <input type="password" name="new_password" class="form-control" placeholder="**********">
                </div>
					<div class="col-sm-2">
						<div class="btn-group">
							<button><a href="#">Add</a>/<a href="#">Edit</a></button>
						</div>
					</div>
			</div>
			<!---Password end --->

		
				<div class="col-sm-12">		
					 <button onclick="window.location.href = '#';" id="Update">Update</button> 	
				</div>
			</form>
			</div>	
			</div>	
		</div>	
</div>	
				





</body>
</html>
