<?php

require_once 'config.php';

    /*if(isset($_POST['create'])){
         $email = $_POST['Email'];
         $password = $_POST['Password'];
         echo $email,$password;
    }*/


$email =$name = $type = $major = $password = $confirm_password = "";
$email_err =$name_err = $type_err = $major_err = $password_err = $confirm_password_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
        
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter a email.";
    } elseif(!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){
        $email_err = "Please enter a valid email.";
    }
    else{
       
        $sql = "SELECT uid FROM users_list WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            $param_email = trim($_POST["email"]);
            
            if(mysqli_stmt_execute($stmt)){
                
                mysqli_stmt_store_result($stmt);
            
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This email is already taken.";
                } else{
                    $email = trim($_POST["email"]);
                }

            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        
         }
        
        mysqli_stmt_close($stmt);
    }

    if(empty($_POST["name"])){
        $name_err = "Please enter a name.";
    } elseif(preg_match("/^[a-zA-Z ]*$/",$name)){
        $name = trim($_POST["name"]);
    } else{
        $name_err = "Only letters and white spaces.";
    }

    if(empty($_POST["type"]))
    {
        $type_err = "Please select one.";
    }
    else{
        $type = trim($_POST["type"]);
    }

    if(empty($_POST["major"]))
    {
        $major_err = "Please enter a major.";
    }
    else
    {
        $major = trim($_POST["major"]);
    }
    
    
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    
    if(empty($email_err) && empty($name_err) && empty($type_err) && empty($major_err) && empty($password_err) && empty($confirm_password_err)){
        
        
        $sql = "INSERT INTO users_list (email, name, type, major, password, username) VALUES (?, ? , ? , ? , ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            $username = str_replace(' ', '', $name);
            mysqli_stmt_bind_param($stmt, "ssssss", $param_email, $param_name, $param_type, $param_major, $param_password, $username);
            
          
            $param_email = $email;
            $param_name =$name;
            $param_type = $type;
            $param_major =$major;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            
            
            if(mysqli_stmt_execute($stmt)){
                
                header("location: index.php");
            } else{
                echo "Something went wrong. Please try again later.";
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
				<a style='padding-top: 22px; margin-bottom:-3px' class="navbar-brand" href="index.php"><img style='padding-left: 0%; max-height: 55px' src="icon_images/logo.png" Alt="logo"></a>
			</div>
	</nav>
</div>


<div class="container col-xl-12 col-lg-12 col-md-10 col-sm-10 col-12 Create" style='font-size:17px'>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" id="account">
            <h3>Create Account</h3><hr><hr>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
				 <div class="row">
                <div class="col-sm-2">Name</div>
                <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12"><input type="text" Name="name" class="form-control"><i class="fa fa-user-circle-o" aria-hidden="true"></i>
<br></div>
				</div>
                
				<div class="row">
                <div class="col-sm-2">Email</div>
                <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12"><input type="text" Name="email" class="form-control"><br></div>
                </div>
				
				<div class="row">
                <div class="col-sm-2">Are You</div>
                <div class="col-lg-10 col-xl-10 col-md-10 col-sm-12 col-12"><select Name="type" class="form-control">
					<option Value ="Student">Student</option>
                    <option Value ="Professor">Professor</option>
                </select><br></div>
                </div>
				
				<div class="row">
                <div class="col-sm-2">Major</div>
                <div class="col-lg-10 col-xl-10 col-md-10 col-sm-12 col-12"><input type="text" Name="major" class="form-control"><br></div>
				</div>
                
				<div class="row">
                <div class="col-sm-2">Password</div>
                <div class="col-lg-10 col-xl-10 col-md-10 col-sm-12 col-12"><input type="Password" Name="password" class="form-control"><br></div>
                </div>
				
				<div class="row">
                <div class="col-sm-2">Confirm Password</div>
                <div class="col-lg-10 col-xl-10 col-md-10 col-sm-12 col-12"><input type="Password" Name="confirm_password" class="form-control"><br></div>
				</div>
				
				
				<button class="col-xl-4 col-lg-4 col-md-4 col-sm-8 col-8 offset-xl-4 offset-lg-4 offset-md-4 offset-sm-2 offset-2" onclick="window.location.href = '#';" id="btnCreateAccount" name="create" method="post" type="submit" >Create Account</button>
            
				<div class="row">
                <div class="col-lg-6 col-xl-6 col-md-8 col-sm-8 col-8 offset-xl-3 offset-lg-3 offset-md-2 offset-sm-2 offset-2" style='text-align: center;'>By clicking "Create Account" you agree to the Terms and Privacy Policy<br></div>
				</div>
                
				
                </form>
        </div>
    </div>
</div>

</body>
</html>
