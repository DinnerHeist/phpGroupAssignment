<!DOCTYPE HTML>

<html>
   <head>
      <style>
         table {
           font-family: arial, sans-serif;
           border-collapse: collapse;
         }

         h1 {   background-color:lightgrey; padding-top:20px; padding-bottom:20px;   }
         h3 {   background-color:lightgrey; padding: 8px;   }

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

      <?php
         session_start();

         // define sql database connection variables
         $name = "localhost";
         $uname = "root";
         $password = "";
         $db_name = "group_assignment";

         // declaring connection
         $connection = mysqli_connect($name, $uname, $password, $db_name);
      ?>

      <center>
         <img src="https://logodix.com/logo/89918.png" width="25%" height="25%"/>
         <h1>Request Of Service</h1>
      </center>

      <div>
         <center>

            <?php

               // this process was implemented by member: Siew Joe Kane

               // retrieving the request number from request_of_service.php
               // via sesion
               $request_number = $_SESSION['requestNumber'];
               $description = $_SESSION['description'];
               $transportationtype = $_SESSION['transportType'];

               // initializing empty tracking number variable
               $tracking_number = "";

               $query = "select `ShippingLocation` from `request` where RequestNumber like '%$request_number'";
               $result = mysqli_query($connection, $query);
               $row = mysqli_fetch_array($result);
               $destinationAddress = $row['ShippingLocation'];

               // check if the insertion was successful or not
               if($result) {

                  // creating query to fetch for tracking number in checking_of_service_and_status
                  $query = "select `trackingNumber` from `checking_of_service_and_status` where `RequestNumber` like '%$request_number'";
                  $result = mysqli_query($connection, $query);

                  $row = mysqli_fetch_array($result);
                  $tracking_number = $row['trackingNumber'];
               } else {
                  echo mysqli_error($connection);
               }
            ?>
            <img src="https://www.clker.com/cliparts/2/k/n/l/C/Q/transparent-green-checkmark-md.png" alt="Green_Check.png" width="5%" height="5%"/>
            <h2>Order Confirmed!</h2>
            <h2>Your Tracking Number is: <?php echo $tracking_number; ?></h2>
            <a href="../registration/customer_homescreen.php">Return to customer portal.</a>
         </center>
      </div>
   </body>
</html>
