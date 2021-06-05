<?php
    $con=mysqli_connect("localhost","dbadmin","DB4DM1NP4$$","db01");
    // Check connection
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    
    $result = mysqli_query($con,"SELECT * FROM professors_list where username = '".$_GET["user"]."' ");
    
    echo "<table border='1'>
    <tr>
    <th>Firstname</th>
    <th>Lastname</th>
    <th>Class</th>
    <th>About</th>
    </tr>";
    
    while($row = mysqli_fetch_array($result))
    {
        echo "<tr>";
        echo "<td>" . $row['first_name'] . "</td>";
        echo "<td>" . $row['last_name'] . "</td>";
        echo "<td>" . $row['class'] . "</td>";
        echo "<td>" . $row['About'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    mysqli_close($con);
?>
