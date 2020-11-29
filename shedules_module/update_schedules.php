<!DOCTYPE HTML>

<html>
   <head>
      <link rel="stylesheet" href="../payments_module/style.css" />

      <style>
         table {
           font-family: arial, sans-serif;
           border-collapse: collapse;
         }

         h1 {   background-color:lightgrey; padding-top:20px; padding-bottom:20px;   }

         td, th {
           border: 1px solid #dddddd;
           text-align: left;
           padding: 8px;
         }

         tr:nth-child(even) {
           background-color: #dddddd;
         }
         .header {
           height: 50px;
           width: 168%;
           text-align: center;
           background: #D3D3D3;
           color: black;
           font-size: 20px;
         }
      </style>
   </head>

   <body>

      <center>
         <img src="https://logodix.com/logo/89918.png" width="25%" height="25%"/>
         <h1>Management Module: Schedules Management (Update Schedules)</h1>
      </center>

      <center>
         <form action="update_schedules.php" method="POST">
            <!-- table to update schedules -->
            <table>

               <tr>
                  <td>Schedule ID: </td>
                  <td><input type="text" name="scheduleID" required /></td>
               </tr>

               <tr>
                  <td>Origin Address: </td>
                  <td><input type="text" name="origin" required /></td>
               </tr>

               <tr>
                  <td>Destination Address: </td>
                  <td><input type="text" name="destination" required /></td>
               </tr>

               <tr>
                  <td>Delivery Mode: </td>
                  <td><input type="text" name="transportationType" required /></td>
               </tr>

               <tr>
                  <td>Status: </td>
                  <td><input type="text" name="deliveryStatus" required /></td>
               </tr>

               <tr>
                  <td>Estimated Delivery Time(days): </td>
                  <td><input type="number" name="estimtedDeliveryTime" required /></td>
               </tr>
            </table>

            <input style="margin: 8px; " type="submit" name="update_schedule" value="Update Schedule" />
         </form>

         <?php

            session_start();

            if(isset($_POST['update_schedule'])) {

               $scheduleID = $_POST['scheduleID'];
               $origin = $_POST['origin'];
               $destination = $_POST['destination'];
               $deliveryMode = $_POST['transportationType'];
               $deliveryStatus = $_POST['deliveryStatus'];
               $estimtedDeliveryTime = $_POST['estimtedDeliveryTime'];

               $_SESSION['$schedule_update_array'] = array(
                  "scheduleID" => $scheduleID,
                  "origin" => $origin,
                  "destination" => $destination,
                  "transportationType" => $deliveryMode,
                  "deliveryStatus" => $deliveryStatus,
                  "estimtedDeliveryTime" => $estimtedDeliveryTime,
                  "status" => "pending"
               );

               $fp = fopen("update_schedule.dat", 'w');

               foreach($_SESSION['$schedule_update_array'] as $attribute => $values) {
                  fwrite($fp, $values."\n");
               }

               fclose($fp);

               // unset array session
               unset($_SESSION['$schedule_update_array']);
            }
         ?>
         <a href="DeliveryManagement.php">Return to Delivery Management</a>
      </center>
   </body>
</html>
