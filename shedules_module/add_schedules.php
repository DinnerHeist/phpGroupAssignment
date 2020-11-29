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
         <h1>Management Module: Schedules Management (Add Schedules)</h1>
      </center>

      <center>
         <!-- Table to add schedules -->
         <form action="add_schedules.php" method="POST">
            <table>

               <tr>
                  <td>Billing Name: </td>
                  <td><input type="text" name="billing_name" required /></td>
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

               <tr>
                  <td>Delivery Date: </td>
                  <td><input type="date" name="deliveryDate" required /></td>
               </tr>

               <tr>
                  <td>Unit Price: </td>
                  <td><input type="number" name="unit_price" required /></td>
               </tr>

               <tr>
                  <td>Maximum Capacity(kilograms): </td>
                  <td><input type="number" name="capacity" required /></td>
               </tr>

            </table>

            <input style="margin: 8px; " type="submit" name="add_schedule" value="Add Schedule" />
         </form>

         <a href="DeliveryManagement.php">Return to Delivery Management</a>

         <?php

            session_start();

            if(isset($_POST['add_schedule'])) {

               // fetch POST variables
               $billing_name = $_POST['billing_name'];
               $origin = $_POST['origin'];
               $destination = $_POST['destination'];
               $deliverydate = $_POST['deliveryDate'];
               $deliveryMode = $_POST['transportationType'];
               $deliveryStatus = $_POST['deliveryStatus'];
               $estimtedDeliveryTime = $_POST['estimtedDeliveryTime'];
               $unit_price = $_POST['unit_price'];
               $capacity = $_POST['capacity'];

               // declare array to store VALUES
               $counter = 0;
               $fp = fopen("add_schedules.dat", 'w');

               $add_array = array(
                  "billing_name" => $billing_name,
                  "origin" => $origin,
                  "destination" => $destination,
                  "deliveryDate" => $deliverydate,
                  "transportationType" => $deliveryMode,
                  "deliveryStatus" => $deliveryStatus,
                  "estimtedDeliveryTime" => $estimtedDeliveryTime,
                  "unit_price" => $unit_price,
                  "capacity" => $capacity);

               foreach($add_array as $attributes => $values) {
                  fwrite($fp, $values."\n");
               }

               fclose($fp);
               unset($_POST['add_schedule']);

               // if($result > 0) {
               //    echo "<p>Delivery Schedule Added!</p>";
               // } else {
               //    echo mysqli_error($connection);
               // }
            }
         ?>
      </center>
   </body>
</html>
