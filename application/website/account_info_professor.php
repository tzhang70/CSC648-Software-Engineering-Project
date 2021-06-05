<?php

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
	header("location: Index_Page.php");
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
                header("location: professor_calendar.php");
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
                header("location: professor_calendar.php");
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
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="CSS/styles.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
	<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
			<div class="col-md-12">
				<a class="navbar-brand" href="homepage.php"><img src="icon_images/logo.png" Alt="logo"></a>
				<h2>Welcome <b><?php echo htmlspecialchars($_SESSION["name"]); ?> </b>,<a href="logout.php">Logout</a></h2>
			</div>
	</nav>
</div>


<div class="container">
	<div class="row">
	<!---Start Information ---->
		<div class="col-md-3">
			<div class="col-sm-12">
				<img src="icon_images/61205.svg" Alt="Account">
				<h4><a href="account_info_professor.php">Account</a></h4>
			</div>

			<div class="col-sm-12">
				<img src="icon_images/814201.svg" Alt="Courses">
				<h4><a href="Update_Availability.php">Update</a></h4>
			</div>
			
			<div class="col-sm-12 Calendar">
				<img src="icon_images/1571653.svg" Alt="Calendar">
				<h4><a href="Professor_Calander.php">Calendar</a></h4>
			</div>
			
			<div class="col-sm-12 Inbox">
				<img src="icon_images/1602840.svg" Alt="Inbox">
                    <h4><a href="inbox.php">Inbox</a></h4>
			</div>
			
			<div class="col-sm-12 Help">
				<img src="icon_images/1662046.svg" Alt="Help">
				<h4><a href="help.php">Help</a></h4>
			</div>
		</div>
	<!---End Information ---->
	
	<!--Start Account Information--->
		<div class="col-md-8">	
		<h1>Account Information</h1><hr><hr>
		<!---Name satrt --->
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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
					
			<!---Name end --->
            <p>&nbsp;</p>
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
			<!---Status end --->

            <p>&nbsp;</p>

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
			<!---Courses end --->
            <p>&nbsp;</p>
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
				
			<!---Password end --->


			<!---Password End --->
				<div class="col-sm-12">		
					<input type="submit" Value="Update" name="Submit">	
				</div>
			</form>
			</div>	






</body>
</html>
