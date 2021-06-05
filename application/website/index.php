<?php

session_start();

if((isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true))
{
    if($_SESSION["type"] == "Student"){
   header("location: homepage_student.php");
    }
    else{
    header("location: cal_prof.php");
     }
   exit;
}


require_once "config.php";

$name = $email = $password = $type = "";
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
       
        $sql = "SELECT uid, name, email, password, type FROM users_list WHERE email = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            
            $param_email = $email;

            
            if(mysqli_stmt_execute($stmt)){
                
                mysqli_stmt_store_result($stmt);

                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    
                    mysqli_stmt_bind_result($stmt, $id, $name, $email, $hashed_password, $type);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            
                            session_start();

                            if($type=="Student"){

                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["name"] = $name;
                                $_SESSION["email"] = $email;
                                $_SESSION["type"] = $type;

                                header("location: homepage_student.php");
                            }
                            elseif($type=="Professor"){
                        
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["name"] = $name;
                            $_SESSION["email"] = $email;
                            $_SESSION["type"] = $type;
                          
                            header("location: cal_prof.php");
                        }
                        else{

                        }

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
				<!--<h4 style='padding-top: 22px; margin-bottom:-3px; max-height: 55px'><a href="index.html">Login</a></h4> -->
			</div>
         </nav>
</div>


<div class="container" id="login">
	
	<h1>Schedule Office Hours
	<br> with Your Professor!</h1>
	<!---Start Information ---->
	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
		<div class="row">
		<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 landing">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<img class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" src="icon_images/landing_page.png" Alt="Account">
			</div>
		</div>			
	<!---End Information ---->	
	
	<!--Start Account Information--->
		<div class="col-md-6" id="create"> 	
			<h3>Welcome to Gater Dater!</h3><hr><hr> 
            <form action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method ="post">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12" >
                <form method="POST">
                    <input type="text" Name="email" placeholder="Email" class="form-control"><br>
                     </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <input type="password" Name="password" placeholder="Password" class="form-control">
                    </div>
                    
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                          <button class="col-xl-12 col-lg-12 col-md-12 col-sm-12" onclick="window.location.href = 'homepage.html';" id="Welcome" name="login" method="post" type="submit">Login</button>

                    </div>
                </form>
				<div style='font-size: 270%; margin-top:3% margin-bottom: 2%; text-align: center;'>Don't have an account? <a href="create_account.php" value='CREATE'>Create</a><br>
				Need help Logging in, <a href="help.html">Click here!</a></div>
			</div>	
		</div>	
    </form>
	</div>
</div>
<!--End Account Information--->





</body>
</html>
