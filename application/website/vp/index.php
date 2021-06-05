<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
            <title>GatorDater Professor Lookup</title>
            <style type="text/css">
                body{
                    font-family: Arail, sans-serif;
                }
            /* Formatting search box */
            .search-box{
                width: 300px;
                position: relative;
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
                margin: 0;
                padding: 7px 10px;
                border: 1px solid #CCCCCC;
                border-top: none;
                cursor: pointer;
            }
            .result p:hover{
                background: #f2f2f2;
            }
            </style>
            <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
            <script type="text/javascript">
var username;

                $(document).ready(function(){
                                  $('.search-box input[type="text"]').on("keyup input", function(){
                                                                         /* Get input value on change */
                                                                         var inputVal = $(this).val();
                                                                         var resultDropdown = $(this).siblings(".result");
                                                                         if(inputVal.length){
                                                                         $.get("backend-search.php", {term: inputVal}).done(function(data){
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
                                                 username = $(this).text().replace(/\s/g,'');
                                                 
                                                 window.open("user-page.php?user="+username);

                                                 
                                                 });
                                  });
                </script>
            </head>
    <body>
        <p><h1>GatorDater Admin Professor Add/Lookup Tool</h1></p>
<p>
<button onclick="window.location.href = 'add_professor.html';">Click Here To Add Professor</button>
</p>
        <div class="search-box">
            <input type="text" autocomplete="off" placeholder="Start Typing Professor Name" />
            <div class="result"></div>
        </div>


    </body>
</html>
