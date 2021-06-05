
<?php
 session_start();
$time;
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
   header("location: index.php");
   exit;
}
require_once "config.php";
    
    if(isset($_POST["submit"]) == "delete" && isset($_POST["eventID"]) != "")
    {
        echo $_POST["eventID"];
    }
    
    $sql = "SELECT appointment_id as id, notes as description, start_event as start, end_event as end, professor_name as title FROM appointments_list WHERE student_id='".$_SESSION['id']."'";
    $result = mysqli_query($link,$sql);
    $myArray = array('hello');
    if ($result->num_rows > 0) {
    // output data of each row
        while($row = $result->fetch_assoc()) {
            $myArray[] = $row;
        }
        $json = json_encode($myArray);
        //$json = str_replace( '"allDay":"0"', '"allDay":false', $json );
    }
    else
    {
        $json = json_encode($myArray);
        //echo "0 results";
    }

?>
<!DOCTYPE html>
<html>
   <head>
<link href='https://unpkg.com/@fullcalendar/core@4.3.1/main.min.css' rel='stylesheet' />


  <link href='https://unpkg.com/@fullcalendar/daygrid@4.3.0/main.min.css' rel='stylesheet' />

  <link href='https://unpkg.com/@fullcalendar/timegrid@4.3.0/main.min.css' rel='stylesheet' />


<script src='/assets/demo-to-codepen.js'></script>

<script src='https://unpkg.com/@fullcalendar/core@4.3.1/main.min.js'></script>




  <script src='https://unpkg.com/@fullcalendar/daygrid@4.3.0/main.min.js'></script>

  <script src='https://unpkg.com/@fullcalendar/timegrid@4.3.0/main.min.js'></script>
      <link rel="stylesheet" type="text/css" href="CSS/styles.css">


      

      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/fullcalendar.css" />
      
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


      <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/interaction/main.js"></script>

      <style>
         body{
         font-size: 14px;
         }
         @import url(https://fonts.googleapis.com/css?family=Open+Sans);

         body{
           background: #f2f2f2;
           font-family: 'Open Sans', sans-serif;
         }
      </style>
      <script>

        document.addEventListener('DOMContentLoaded', function() {
          var date = new Date();
          var d = date.getDate();
          var m = date.getMonth();
          var y = date.getFullYear();
          var calendarEl = document.getElementById('calendar');
          
          var calendar = new FullCalendar.Calendar(calendarEl, {
            schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
            allDaySlot: false,
            allDayDefault: false,
            plugins: [ 'dayGrid','timeGrid','interaction' ],
            defaultDate: new Date(),
            header: {
              left:   'today,prev,next',
              center: 'title',
              right:  'timeGridWeek,dayGridMonth'
            },
            defaultView: 'dayGridMonth',
            //navLinks: true, // can click day/week names to navigate views
            selectable: true,
            eventLimit: 3,
            dateClick: function(info) {
                                                   if(info.view.type =="dayGridMonth"){
                                                   calendar.changeView('timeGridWeek', info.date);
                                                   }
                                                   else if(info.view.type =="timeGridWeek"){
                                                   }
              //alert('Clicked on: ' + info.dateStr);
              //alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
              //alert('Current view: ' + info.view.type);
              // change the day's background color just for fun
              //info.dayEl.style.backgroundColor = 'red';
            },
                                                   eventClick: function(info) {
                                                   $('#eventID').html(info.event.id);
                                                   $('#modalTitle').html('Meeting with ' + info.event.title);
                                                   $('#modalBody').html(info.event.description);
                                                    $('#calendarModal').modal();
                                                   },
                                                   
            events: <?php echo $json; ?>

          });

          calendar.render();
        });

      </script>
   </head>
   <body>
      <div class="container-fluid" style='height: 65px !important; padding-left: 0%; max-height: 65px'>
         <nav class="navbar navbar-expand-sm bg-dark navbar-dark" style='padding-left: 0%'>
            <div class="col-md-12" style='padding-left: 0%'>
               <a style='padding-left: 0%' class="navbar-brand" href="index.php"><img style='padding-left: 0%; max-height: 55px' src="icon_images/logo.png" Alt="logo"></a>
               <h4 style='padding-top: 22px; margin-bottom:-3px; max-height: 55px'><?php echo htmlspecialchars($_SESSION["name"])," "; ?>,<a href="logout.php">Logout</a></h4>
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
            <!--Start Cal--->
            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-9 calendar" style='font-size:17px'>
               <div class="modal fade" id="successModal" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                  <form action="cal.php" method="post">
                                  <div class="form-group">
                                    <label for="eventnotes"> Any notes for your professor?:</label>
                                    <input type="eventNotes" name="eventNotes" class="form-control" id="eventNotes" required="">
                                    <input type="hidden" name="eventDate" class="form-control" id="eventDate">
                                    <input type="hidden" name="eventEndDate" class="form-control" id="eventEndDate">
                                
                                  </div>
                                  <button type="submit" value="submit" name="submit" >Schedule My Appointment!</button>
                                </form>
                                </div>
                              </div>
                              </div>
                              </div>
                     <div id="calendarModal" class="modal fade">
                                         <div class="modal-dialog">
                                             <div class="modal-content">
                                                 <div class="modal-header">
                                                     
                                                     <h4 id="modalTitle" class="modal-title"></h4>
                                                 </div>
                                                 <div id="modalBody" class="modal-body"> </div>
                                                 <div class="modal-footer">
                     <form action="cal.php" method="post">
                     <div class="form-group">

                     <input type="hidden" name="eventID" class="form-control" id="eventID">
                     
                     </div>

                     <!--<button type="submit" value="delete" name="delete" >Delete my appointment</button>-->

                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     </form>

                                                 </div>
                                             </div>
                                         </div>
                                         </div>
                     
                     <div id='calendar'></div>
                 
            </div>
            
         </div>
      </div>
   </body>
</html>
