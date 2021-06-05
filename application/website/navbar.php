<?php

 session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
   header("location: index.php");
   exit;
}
require_once "config.php";

        if($_SESSION["type"]=="Student"){
                     include 'student_navbar.php';
    }
        else{
                     include 'professor_navbar.php';
        }
        ?>
        

