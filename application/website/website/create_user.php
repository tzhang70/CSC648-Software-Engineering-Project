<?php
    $Name = filter_input(INPUT_POST, 'Name');
    $Email = filter_input(INPUT_POST, 'Email');
    $Type = filter_input(INPUT_POST, 'Type');
    $Major = filter_input(INPUT_POST, 'Major');
    $Password = filter_input(INPUT_POST, 'Password');
    $ConfirmPassword = filter_input(INPUT_POST, 'ConfirmPassword');
    $HashedPass = password_hash($password, PASSWORD_DEFAULT);
    
    if (!empty($Name or $Email or $Type or $Major or $Password or $Confirm-Password)){
        $host = "localhost";
        $dbusername = "dbadmin";
        $dbpassword = "DB4DM1NP4$$";
        $dbname = "db01";
        // Create connection
        $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);
        if (mysqli_connect_error()){
            die('Connect Error ('. mysqli_connect_errno() .') '
                . mysqli_connect_error());
        }
        else{
            $sql = "INSERT INTO users_list (name, email, type, major, password)
            values ('$Name','$Email','$Type','$Major','$HashedPass')";
            if ($conn->query($sql)){
                header('Location: index.html');
            }
            else{
                echo "Error: ". $sql ."
                ". $conn->error;
            }
            $conn->close();
        }
    }
    ?>
