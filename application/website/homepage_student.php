<?php
 session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
   header("location: index.php");
   exit;
}
require_once "config.php";

?>
<!DOCTYPE html>
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
         @import url(https://fonts.googleapis.com/css?family=Open+Sans);

         body{
           background: #f2f2f2;
           font-family: 'Open Sans', sans-serif;
         }
/*
         .search {
           width: 100%;
           position: relative;
           display: flex;
         }

         .searchTerm {
           width: 100%;
           border: 2px solid #000000;
           padding: 5px;
           height: 40px;
           border-radius: 5px 5px 5px 5px;
           outline: none;
           color: #000000;
         }

         .searchTerm:focus{
             color: #000000;
             border: 3px solid #9d00ff;

         }
         .searchButton {
             position: relative;
             right: 10%
         }
          
         /*Resize the wrap to see the search bar change!*/
         .search-box{
                     width: 300px;
                     position: relative;
                     left: 30%;
                     top: 50%;
                     display: inline-block;
                     font-size: 14px;
                     }
                     .search-box input[type="text"]{
                     height: 32px;
                     padding: 5px 10px;
                     border: 1px solid #CCCCCC;
                     font-size: 14px;
                     }
                     .result{
                     position: absolute;
                     z-index: 999;
                     top: 100%;
                     left: 0;
                     }
                     .search-box input[type="text"], .result{
                     width: 100%;
                     box-sizing: border-box;
                     }
                     /* Formatting result items */
                     .result p{
                     background: #ffffff;
                     margin: 0;
                     padding: 7px 10px;
                     border: 1px solid #CCCCCC;
                     border-top: none;
                     cursor: pointer;
                     }
                     .result p:hover{
                     background: #f2f2f2;
                     }
         .wrap{
           width: 50%;
           position: absolute;
           top: 200%;
           left: 50%;
           transform: translate(-50%, -50%);
         }
      
      </style>
       <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
                  <script type="text/javascript">
                     var name;
                     
                     $(document).ready(function(){
                                       $('.search-box input[type="text"]').on("keyup input", function(){
                                                                              /* Get input value on change */
                                                                              var inputVal = $(this).val();
                                                                              var resultDropdown = $(this).siblings(".result");
                                                                              if(inputVal.length){
                                                                              $.get("vp/backend-search.php", {term: inputVal}).done(function(data){
                                                                                                                                 // Display the returned data in browser
                                                                                                                                 resultDropdown.html(data);
                                                                                                                                 });
                                                                              } else{
                                                                              resultDropdown.empty();
                                                                              }
                                                                              });
                                       
                                       // Set search input value on click of result item
                                       $(document).on("click", ".result p", function(){
                                                      $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
                                                      //sets search field val
                                                      
                                                      $(this).parent(".result").empty();
                                                      //clears dropdown
                                                      name = $(this).text().replace(/\s/g,'');
                                                      
                                                      window.open("scheduler.php?name="+name);
                                                      
                                                      
                                                      });
                                       });
                  </script>
   </head>
   <body>
      <div class="container-fluid" style='height: 65px !important; padding-left: 0%; max-height: 65px'>
         <nav class="navbar navbar-expand-sm bg-dark navbar-dark" style='padding-left: 0%'>
            <div class="col-md-12" style='padding-left: 0%'>
               <a style='padding-left: 0%' class="navbar-brand" href="index.php"><img style='padding-left: 0%; max-height: 55px' src="icon_images/logo.png" Alt="logo"></a>
               <h4 style='padding-top: 22px; margin-bottom:-3px; max-height: 55px'><?php echo htmlspecialchars($_SESSION["name"]); ?>,<a href="logout.php">Logout</a></h4>
            </div>
         </nav>
      </div>
      <div class="container">
         <div class="row">
            <!---Start Information ---->
            <?php
                     include 'navbar.php';
            ?>
            <!---End Information ---->
            <!--Start Prof Search--->
            <div class="col-md-9 Account" style='font-size:17px'>
               <div class="col-lg-12">
                  <h1>Professor Search</h1>
                  <hr>
                  <hr>
                  <div class="search-box">
                     <div class="search">
                        <input type="text"  placeholder="Enter Professor Name">
                        <div class ="result"></div>
                     </div>
                     <!--<div class="col-sm-12">
                         <div class="result">
                            <button onclick="window.location.href = '#';" id="Update">Search</button>
                        </div>
                     </div> -->
                  </div>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>
