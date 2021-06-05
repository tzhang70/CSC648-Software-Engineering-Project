<?php

require_once 'config.php';
 

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
        
        
        $sql = "INSERT INTO users_list (email, name, type, major, password) VALUES (?, ? , ? , ? , ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "sssss", $param_email, $param_name, $param_type, $param_major, $param_password);
            
          
            $param_email = $email;
            $param_name =$name;
            $param_type = $type;
            $param_major =$major;
            $param_password = password_hash($password, PASSWORD_DEFAULT); 
            
            
            if(mysqli_stmt_execute($stmt)){
                
                header("location: Index_Page.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        
        mysqli_stmt_close($stmt);
    }
    
   
    mysqli_close($link);
}
?>


<!DOCTYPE html>
<html lang ="en">
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


<div class="container">
    <div class="row">
        <div class="col-md-12" id="account">
            <h3>Create Account</h3><hr><hr>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="col-sm-2">Name</div>
                <div class="col-sm-10"><input type="text" name="name" class="form-control" value ="<?php echo $name; ?>"><br></div>
            
                <div class="col-sm-2">Email</div>
                <div class="col-sm-10"><input type="text" name="email" class="form-control"><br></div>
                
                <div class="col-sm-2">Are You</div>
                <div class="col-sm-10"><select name="type" class="form-control">
                    <option Value ="Student">Student</option>
                    <option Value ="Professor">Professor</option>
                </select><br></div>
                
                <div class="col-sm-2">Major</div>
                <div class="col-sm-10"><input type="text" name="major" class="form-control"><br></div>
                
                <div class="col-sm-2">Password</div>
                <div class="col-sm-10"><input type="password" name="password" class="form-control"><br></div>
                
                <div class="col-sm-2">Confirm Password</div>
                <div class="col-sm-10"><input type="password" name="confirm_password" class="form-control"><br></div>
                
                <input type="submit" Name="Submit" id="Create" value="Submit">
                    </form>
        </div>
    </div>
</div>


</body>
</html>
