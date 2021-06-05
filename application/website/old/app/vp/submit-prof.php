<?php
    $fname = filter_input(INPUT_POST, 'fname');
    $lname = filter_input(INPUT_POST, 'lname');
    $class = filter_input(INPUT_POST, 'class');
    $about = filter_input(INPUT_POST, 'about');

    if (!empty($fname or $lname or $class or $about)){
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
                $sql = "INSERT INTO professors_list (username, first_name, last_name, class, About)
                values ('$fname$lname','$fname','$lname','$class','$about')";
                if ($conn->query($sql)){
                    header('Location: index.php');
                }
                else{
                    echo "Error: ". $sql ."
                    ". $conn->error;
                }
                $conn->close();
            }
    }
    ?>
