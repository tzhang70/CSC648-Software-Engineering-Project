<?php
    $con=mysqli_connect("localhost","dbadmin","DB4DM1NP4$$","db01");
    // Check connection
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    
    $result = mysqli_query($con,"SELECT * FROM users_list where name = '".$_GET["name"]."' ");
    
    echo "<table border='1'>
    <tr>
    <th>Name</th>
    </tr>";
    
    while($row = mysqli_fetch_array($result))
    {
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    mysqli_close($con);
?>
