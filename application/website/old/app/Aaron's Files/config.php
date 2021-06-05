<?php

$user = 'dbadmin';
$password = 'DB4DM1NP4$$';
$db = 'db01';
$host = 'localhost';


$link = mysqli_init();
$success = mysqli_real_connect(
   $link,
   $host,
   $user,
   $password,
   $db,
   
);



?>