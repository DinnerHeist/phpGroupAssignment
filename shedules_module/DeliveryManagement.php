<!DOCTYPE html>
   <html>
   <head>

      <link rel="stylesheet" href="../payments_module/style.css" />

      <style>
         table {
           font-family: arial, sans-serif;
           border-collapse: collapse;
           width: 100%;
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

         .scroll {
            width: 100%;
            overflow: auto;
         }
      </style>
   </head>

   <body>
      <center>
         <img src="https://logodix.com/logo/89918.png" width="25%" height="25%"/>
         <h1>Management Module: Schedules Management</h1>
      </center>

      <div style="float: left; ">
         <center>
            <table style="margin-left: auto; margin-right: auto;">
               <tr><td><a href="../homescreen/homescreen.php">Home Dashboard</a></td></tr>
               <tr><td><a href="../customer_accounts/customer_accounts_module.php">Customer Accounts Management</a></td></tr>
               <tr><td><a href="">Delivery Schedule Management</a></td></tr>
               <tr><td><a href="../payment_module/payment_module.php">Payments Management</a></td></tr>
               <tr><td><a href="../services_module/service_management.php">Service Management</a></td></tr>
               <tr><td><a href="../request_management/request_management.php">Request Management</a></td></tr>
               <tr><td><a href = "../homescreen/logout.php"> Logout </a></td></tr>
            </table>
         </center>
      </div>

      <div style="display: inline-block; float: center; width: 80%; margin-top: -1.2%; margin-left: 14px; ">

         <center>
            <h3>Pending Schedules Add Requests</h3>
            <form action="DeliveryManagement.php" method="POST" class="scroll">
               <table>
                  <th>Billing Name:</th>
                  <th>Origin Address:</th>
                  <th>Destination Address:</th>
                  <th>Delivery Mode:</th>
                  <th>Status:</th>
                  <th>Estimated Delivery Time(days):</th>
                  <th>Delivery Date:</th>
                  <th>Unit Price:</th>
                  <th>Maximum Capacity(kilograms):</th>

                  <tr>
                     <?php

                        session_start();

                        if(file_exists("add_schedules.dat")) {
                           $data = file("add_schedules.dat");
                           foreach($data as $lines) {
                              echo "<td>".$lines."</td>";
                           }
                        }

                        if($_SESSION['position'] === 'manager' && filesize("add_schedules.dat") > 0) {
                           echo "<td><input type='submit' value='Approve' name='approve_add' /></td>";
                        }

                        if(isset($_POST['approve_add'])) {
                           $data = file("add_schedules.dat");
                           $temp = array();

                           $counter = 0;
                           foreach($data as $lines) {
                              $temp[$counter] = $lines;
                              $counter++;
                           }

                           if(filesize("add_schedules.dat") > 0) {

                              // define sql database connection variables
                              $name = "localhost";
                              $uname = "root";
                              $password = "";
                              $db_name = "group_assignment";

                              // declaring connection
                              $connection = mysqli_connect($name, $uname, $password, $db_name);

                              $query = "INSERT INTO `delivery_schedule` (`DeliveryDate`, `DeliveryStatus`, `BillingName`, `OriginLocation`, `DestinationLocation`, `DeliveryMode`, `UnitPrice`, `MaximumCapasity`, `EstimatedTimeDelivery`)
                              VALUES (
                                 '$temp[0]',
                                 '$temp[1]',
                                 '$temp[2]',
                                 '$temp[3]',
                                 '$temp[4]',
                                 '$temp[5]',
                                 '$temp[6]',
                                 '$temp[7]',
                                 '$temp[8]')";

                              $result = mysqli_query($connection, $query);

                              if($result > 0) {
                                 $fp = fopen("add_schedules.dat", 'w');
                                 fwrite($fp, "");
                                 fclose($fp);
                                 echo "<p>Delivery Schedule Added!</p>";

                              } else {
                                 echo mysqli_error($connection);
                              }
                           }
                        }
                     ?>
                  </tr>

               </table>
            </form>
         </center>

         <center>
            <h3>Pending Schedules Update Requests</h3>
            <form action="DeliveryManagement.php" method="POST" class="scroll">
               <table style="margin-bottom: 8px; ">
                  <th>Delivery ID: </th>
                  <th>Origin Address: </th>
                  <th>Destination Address: </th>
                  <th>Delivery Mode: </th>
                  <th>Status: </th>
                  <th>Estimated Delivery Time: </th>

                  <tr>
                     <?php
                        if(file_exists("update_schedule.dat")) {
                           $data = file("update_schedule.dat");
                           foreach($data as $lines) {
                              echo "<td>".$lines."</td>";
                           }
                        }

                        if($_SESSION['position'] === 'manager' && filesize("update_schedule.dat") > 0) {
                           echo "<td><input type='submit' value='Approve' name='ApproveScheduleUpdate' /></td>";
                        }

                        if(isset($_POST['ApproveScheduleUpdate'])) {
                           $data = file("update_schedule.dat");
                           $temp = array();

                           $counter = 0;
                           foreach($data as $lines) {
                              $temp[$counter] = $lines;
                              $counter++;
                           }

                           if(filesize("update_schedule.dat") > 0) {
                              // define sql database connection variables
                              $name = "localhost";
                              $uname = "root";
                              $password = "";
                              $db_name = "group_assignment";

                              // declaring connection
                              $connection = mysqli_connect($name, $uname, $password, $db_name);

                              // constructing query for searching the record
                              $query = "select * from delivery_schedule where ScheduleID = '$temp[0]'";

                              // checks if the primary key exist within the database
                              $check = mysqli_query($connection, $query);

                              // check if the record has been updated successfully
                              if(mysqli_num_rows($check) > 0) {

                                 // constructing query for updating record
                                 $query = "update delivery_schedule set
                                 OriginLocation = '$temp[1]',
                                 DestinationLocation = '$temp[2]',
                                 DeliveryMode = '$temp[3]',
                                 DeliveryStatus = '$temp[4]',
                                 EstimatedTimeDelivery = '$temp[5]'
                                 where ScheduleID = '$temp[0]'";

                                 $result = mysqli_query($connection, $query);

                                 if($result > 0) {
                                    $fp = fopen("update_schedule.dat", 'w');
                                    fwrite($fp, "");
                                    fclose($fp);
                                    echo "<p>Delivery Schedule Updated!</p>";
                                 } else {
                                    echo mysqli_error($connection);
                                 }

                                 // this query is to update the checking_of_service_and_status (tracking) table the attribute estimated time delivery
                                 $query = "update checking_of_service_and_status set estimatedDeliveryDateTime = $temp[5]";
                                 $result = mysqli_query($connection, $query);
                              } else {
                                 echo "<p style = 'color: red;'> Delivery Record not found! </p>";
                                 echo mysqli_error($connection);
                             }
                           }
                        }
                     ?>
                  </tr>

               </table>
            </form>
         </center>

         <table style="margin-bottom: 8px; ">
            <tr>
               <td style="text-align: center; "><a href="add_schedules.php">Add Schedules</a></td>
               <td style="text-align: center; "><a href="update_schedules.php">Update Schedules</a></td>
            </tr>
         </table>

         <div class="scroll">
            <?php
               /* Attempt MySQL server connection. Assuming you are running MySQL
               server with default setting (user 'root' with no password) */
               $link = mysqli_connect("localhost", "root", "", "group_assignment");

               // Check connection
               if($link === false){
                     die("ERROR: Could not connect. " . mysqli_connect_error());
               }

               // Attempt select query execution
               $sql = "SELECT * FROM delivery_schedule";

               if($result = mysqli_query($link, $sql)){
                     if(mysqli_num_rows($result) > 0){
                        echo "<table>";
                           echo "<tr>";
                           echo "<th>ScheduleID</th>";
                           echo "<th>DeliveryDate</th>";
                           echo "<th>DeliveryStatus</th>";
                           echo "<th>BillingName</th>";
                           echo "<th>OriginLocation</th>";
                           echo "<th>DestinationLocation</th>";
                           echo "<th>DeliveryMode</th>";
                           echo "<th>UnitPrice</th>";
                           echo "<th>MaximumCapacity</th>";
                           echo "<th>Estimated Delivery Time</th>";
                           echo "</tr>";

                        while($row = mysqli_fetch_array($result)){
                           echo "<tr>";
                           echo "<td>" . $row['ScheduleID'] . "</td>";
                           echo "<td>" . $row['DeliveryDate'] . "</td>";
                           echo "<td>" . $row['DeliveryStatus'] . "</td>";
                           echo "<td>" . $row['BillingName'] . "</td>";
                           echo "<td>" . $row['OriginLocation'] . "</td>";
                           echo "<td>" . $row['DestinationLocation'] . "</td>";
                           echo "<td>" . $row['DeliveryMode'] . "</td>";
                           echo "<td>" . $row['UnitPrice'] . "</td>";
                           echo "<td>" . $row['MaximumCapasity'] . "</td>";
                           echo "<td>" . $row['EstimatedTimeDelivery'] . "</td>";
                           echo "</tr>";
                        }
                        echo "</table>";

                        // Free result set
                        mysqli_free_result($result);

                     } else{
                        echo "No records matching your query were found.";
                     }
               } else{
                     echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
               }

               // Close connection
               mysqli_close($link);
            ?>
         </div>
      </div>

   </body>
</html>
