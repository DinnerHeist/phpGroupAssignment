<!DOCTYPE html>
<html>
   <head>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <style>

         table
         {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
         }

         h1
         {
            background-color:lightgrey;
            padding-top:20px;
            padding-bottom:20px;
         }

         td, th
         {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
         }

         tr:nth-child(even)
         {
            background-color: #dddddd;
         }

         .header
         {
            height: 50px;
            width: 168%;
            text-align: center;
            background: #D3D3D3;
            color: black;
            font-size: 20px;
         }

         .button {
            border-radius: 4px;
            background-color: #f4511e;
            border: none;
            color: #FFFFFF;
            text-align: center;
            font-size: 12px;
            padding: 5px;
            width: 100px;
            transition: all 0.5s;
            cursor: pointer;
            margin: 5px;
         }

         .button span {
           cursor: pointer;
           display: inline-block;
           position: relative;
           transition: 0.5s;
         }

         .button span:after {
           content: '\00bb';
           position: absolute;
           opacity: 0;
           top: 0;
           right: -20px;
           transition: 0.5s;
         }

         .button:hover span {
           padding-right: 25px;
         }

         .button:hover span:after {
           opacity: 1;
           right: 0;
         }

      </style>
   </head>

   <body>

      <?php
         session_start();

         // initializing database variables
         $name = "localhost";
         $uname = "root";
         $password = "";
         $db_name = "group_assignment";

         // declaring connection
         $connection = mysqli_connect($name, $uname, $password, $db_name);
      ?>

      <center>
         <img src="https://logodix.com/logo/89918.png" width="25%" height="25%"/>
         <h1>Tracking Delivery</h1>
      </center>

      <div style="float: left; margin-bottom: 100%; ">
         <center>
            <table style="margin-left: auto; margin-right: auto; margin-bottom: 10px; ">
               <tr><td><a href="../registration/customer_homescreen.php">Homescreen</a></td></tr>
               <tr><td><a href="">Track My Delivery Status</a></td></tr>
               <tr><td><a href="../request_service/request_of_service.php">Make Delivery</a></td></tr>
               <tr><td><a href="../checking_service_status/check_service.php">Check Services</a></td></tr>
               <tr><td><a href="../registration/logout.php">Logout</a></td></tr>
            </table>
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAg1KWDMjBY4XNBUdItzyQZ4DwlHxVlIKnNQ&usqp=CAU" alt="tracking_package" style="width: 80%; height: 80%; "/>
         </center>
      </div>

      <div style="float: left; margin-left: .5%; width: 80%; ">

         <form action="tracking.php" method="POST" >
            <center>
               <table style="margin-bottom: 10px; border: solid black 1px; ">
                  <tr>
                     <td style="border: solid black 1px; text-align: center; "><strong>Search Tracking Number:</strong> </td>
                     <td style="border: solid black 1px; text-align: center; "><input style="width: 90%; " type="text" name="search_tracking_number" required/></td>
                     <td style="border: solid black 1px; text-align: center; "><button name="search_tracking_submit" class="button"><span>Search</span></button></td>
                  </tr>
               </table>

               <table>
                  <th> Tracking Number </th>
                  <th> Available For Pickup </th>
                  <th> Pending </th>
                  <th> Out For Delivery </th>
                  <th> Received </th>
                  <th> Destination </th>
                  <th> Estimated Delivery Time </th>
                  <th> Description </th>

                  <?php
                     if(isset($_POST['search_tracking_submit'])) {
                        $trackingnumber = $_POST['search_tracking_number'];

                        // CONSTRUCTING SEARCH QUERY
                        $query = "select * from checking_of_service_and_status having trackingNumber like '%$trackingnumber%'";

                        $result = mysqli_query($connection, $query);

                        if(!$result) {
                           echo mysqli_error($connection);
                        } else {
                           while($row = mysqli_fetch_array($result)) {
                              echo "<tr><td>".$row['trackingNumber']."</td>";
                              echo "<td>".$row['availableForPickup']."</td>";
                              echo "<td>".$row['pending']."</td>";
                              echo "<td>".$row['outOfDelivery']."</td>";
                              echo "<td>".$row['received']."</td>";
                              echo "<td>".$row['destination']."</td>";
                              echo "<td>".$row['estimatedDeliveryDateTime']."</td>";
                              echo "<td>".$row['description']."</td></tr>";
                           }

                           unset($_POST['search_tracking_number']);
                           unset($_POST['search_tracking_submit']);
                        }
                     }
                  ?>
               </table>
            </center>
         </form>
      </div>
   </body>
</html>
