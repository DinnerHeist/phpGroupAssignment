<!DOCTYPE HTML>

<html>

   <head>
      <style>
         h1 {   background-color:lightgrey; padding-top:20px; padding-bottom:20px;   }
         table {   border-collapse: collapse; }
         table, tr, td, th{   border: 1px solid black; padding: 10px;  }

         body{
            background-image: url("homepage_wallpaper.jpg");
            height: 1000px; /* You must set a specified height */
            background-position: center; /* Center the image */
            background-repeat: no-repeat; /* Do not repeat the image */
            background-size: cover;
         }
      </style>
   </head>

   <body>
      <?php session_start();?>
      <center>
            <img src="https://logodix.com/logo/89918.png" width="25%" height="25%"/>
         <h1>My DHL</h1>
      </center>

      <div style="float: left; background: #fff; ">
         <center>
            <table style="margin-left: auto; margin-right: auto;">
               <tr><td><a href="">Homescreen</a></td></tr>
               <tr><td><a href="../checking_service_status/tracking.php">Track My Delivery Status</a></td></tr>
               <tr><td><a href="../request_service/request_of_service.php">Make Delivery</a></td></tr>
               <tr><td><a href="../checking_service_status/check_service.php">Check Services</a></td></tr>
               <tr><td><a href="logout.php">Logout</a></td></tr>
            </table>
         </center>
      </div>

      <div style="border: solid black 1px; width: 80%; display: inline-block; margin-left: 1%; padding: 2%; background: #fff; ">
         <center>
            <h2>Welcome back, <?php echo $_SESSION['name']; ?></h2>
            <!--https://www.youtube.com/watch?v=fvNpn3yfIIQ&ab_channel=ecInsider-->
            <iframe src="https://www.youtube.com/embed/fvNpn3yfIIQ" width="1080" height="720" frameborder="0" allowfullscreen></iframe>

         </center>
      </div>

   </body>

</html>
