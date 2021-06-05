<?php

session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: homepage.php");
    exit;
}

require_once "config.php";

$name = $email = $password = "";
$email_err = $password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter email.";
    }else {
        $email = trim($_POST["email"]);
    
    }


    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

    
    if(empty($email_err) && empty($password_err)){
       
        $sql = "SELECT uid, name, email, password FROM users_list WHERE email = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            
            $param_email = $email;

            
            if(mysqli_stmt_execute($stmt)){
                
                mysqli_stmt_store_result($stmt);

                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    
                    mysqli_stmt_bind_result($stmt, $id, $name, $email, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            
                            session_start();

                        
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["name"] = $name;
                            $_SESSION["email"] = $email;
                        


                            
                            header("location: homepage.php");
                        } else{
                            
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    
                    $email_err = "No account found with that email.";
                }
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
				<a class="navbar-brand" href="Index_Page.php"><img src="icon_images/logo.png" Alt="logo"></a>
			</div>
            <p> &nbsp; </p>
            <p> &nbsp; </p>

	</nav>
</div>


<div class="container" id="login">
	<div class="row">
	<h1>Schedule Office Hours<br> with Your Professor!</h1>
	<!---Start Information ---->
		<div class="col-md-6 landing">
			<div class="col-sm-12">
				<img src="icon_images/landing_page.png" Alt="Account">
			</div>
		</div>			
	<!---End Information ---->	
	
	<!--Start Account Information--->
		<div class="col-md-6" id="create"> 	
			<h3>Welcome to Gator Dater!</h3><hr><hr> 
			<form action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
				<div class="col-sm-12" >
				<input type="text" name="email" placeholder="Email" class="form-control"><br>
				 </div>
				
				<div class="col-sm-12">
					<input type="password" name="password" placeholder="Password" class="form-control">
				</div>
				<div class="col-sm-12">
					   <input type="Submit" Value="Login" Name="Submit" id="login">
                           
				</div>
				<h4>Don't have an account? <a href="create_account.php">Create</a><br>
				Need help Logging in, Click here!</h4>
			</div>	
			</form>
	</div>
</div>
<!--End Account Information--->





</body>
</html>
