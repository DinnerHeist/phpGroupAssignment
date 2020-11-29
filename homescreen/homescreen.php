<!DOCTYPE HTML>

<html>

   <head>
      <style>
         h1 {   background-color:lightgrey; padding-top:20px; padding-bottom:20px;   }

         table {
           font-family: arial, sans-serif;
           border-collapse: collapse;
           width: 100%;
         }

         td, th {
           border: 1px solid #dddddd;
           text-align: left;
           padding: 8px;
         }

         tr:nth-child(even) {
           background-color: #dddddd;
         }

         body{
            background-image: url("dhl_wallpaper.jpg");
            height: 600px; /* You must set a specified height */
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
         <h1>Management Module: Homescreen</h1>
      </center>

      <div style="float: left; ">
         <center>
            <table style="margin-left: auto; margin-right: auto; background: #fff; ">
               <tr><td><a href="">Home Dashboard</a></td></tr>
               <tr><td><a href="../customer_accounts/customer_accounts_module.php">Customer Accounts Management</a></td></tr>
               <tr><td><a href="../shedules_module/DeliveryManagement.php">Delivery Schedule Management</a></td></tr>
               <tr><td><a href="../payment_module/payment_module.php">Payments Management</a></td></tr>
               <tr><td><a href="../services_module/service_management.php">Service Management</a></td></tr>
               <tr><td><a href="../request_management/request_management.php">Request Management</a></td></tr>
               <tr><td><a href = "logout.php"> Logout </a></td></tr>
            </table>
         </center>
      </div>

      <div style="float: center; border: solid black 1px; width: 60%; display: inline-block; margin-left: 4%; background: #fff; ">
         <center>
            <h2>Welcome back, <?php echo $_SESSION['name']; ?></h2>
            <h2>Your position is <?php echo $_SESSION['position']; ?></h2>
         </center>
      </div>

   </body>

</html>
