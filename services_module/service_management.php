<!DOCTYPE html>

<html>

   <head>
      <link rel="stylesheet" href="style.css" />
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
         <h1> Management Module: Service Management Module</h1>
      </center>

      <div style="float: left; display: inline-block; ">
         <nav>
            <table style="margin-left: auto; margin-right: auto;">
               <tr><td><a href="../homescreen/homescreen.php">Home Dashboard</a></td></tr>
               <tr><td><a href="../customer_accounts/customer_accounts_module.php">Customer Accounts Management</a></td></tr>
               <tr><td><a href="../shedules_module/DeliveryManagement.php">Delivery Schedule Management</a></td></tr>
               <tr><td><a href="../payment_module/payment_module.php">Payments Management</a></td></tr>
               <tr><td><a href="../services_module/service_management.php">Service Management</a></td></tr>
               <tr><td><a href="../request_management/request_management.php">Request Management</a></td></tr>
               <tr><td><a href="../homescreen/logout.php">Logout</a></td></tr>
            </table>
         </nav>
      </div>

      <center>
         <table>
            <tr>
               <td><a href="add_service.php">Add Service</a></td>
               <td><a href="update_service.php">Update Service</a></td>
            </tr>
         </table>
         <br />
      </center>

      <div style="border: solid black 1px; display: inline-block; float: center; margin-top: 8px; margin-left: 100px; width: 78.55%; ">
         <center>

            <h3>Add Request</h3>
            <table style="width: 90%; ">
               <th>Transportation Type</th>
               <th>Price</th>
               <th>Distance</th>
               <th>Capacity</th>
               <th>Foreign Taxation</th>

               <tr>
                  <form method="POST" action="service_management.php">
                     <?php

                        $data = file("data.dat");

                        foreach($data as $line) {
                           echo "<td>".$line."</td>";
                        }

                        if($_SESSION['position'] === "manager"  && (filesize("data.dat") > 0)) {
                           echo "<td><input type='submit' name='approve' value='Approve'/></td>";
                        }

                        if(isset($_SESSION['add_list'])) {
                           // foreach($_SESSION['add_list'] as $attribute => $values) {
                           //    echo "<td>".$values."</td>";
                           // }

                           $fp = fopen("data.dat", 'w');
                           foreach($_SESSION['add_list'] as $attribute => $values) {
                              // $add[$counter] = $values;
                              // $counter++;
                              fwrite($fp, $values."\n");
                           }
                           unset($_SESSION['add_list']);
                           fclose($fp);
                        }

                        if(isset($_POST['approve'])) {
                           // define sql database connection variables
                           $name = "localhost";
                           $uname = "root";
                           $password = "";
                           $db_name = "group_assignment";

                           // declaring connection
                           $connection = mysqli_connect($name, $uname, $password, $db_name);

                           if(filesize("data.dat") > 0) {
                              $add = array();
                              $counter = 0;

                              $data = file("data.dat");

                              foreach($data as $line) {
                                 $add[$counter] = trim($line);
                                 $counter++;
                              }

                              $query = "INSERT INTO  `services` (`Transportation`, `Price`, `Distance`, `Capacity`, `ForeignTaxation`)
                              VALUES ('$add[0]', '$add[1]', '$add[2]', '$add[3]', '$add[4]')";

                              $result = mysqli_query($connection, $query);

                              if($result>0) {
                                 echo "<center><h3>A new service has been added! </h3>";
                                 $fp = fopen("data.dat", 'w');
                                 fwrite($fp, "");
                                 fclose($fp);
                              } else {
                           	   echo "<center><p>Insertion of new product record failed.</p></center>";
                                 echo mysqli_error($connection);
                              }
                           } else {
                              echo "No pending requests";
                           }
                        }
                     ?>
                  </form>
               </tr>
            </table>

            <!--pending update table-->
            <h3>Pending Updates</h3>

            <form method="POST" action="service_management.php">
               <table style="width: 90%; ">

                  <th>TransportID</th>
                  <th>Transport Type</th>
                  <th>Price</th>
                  <th>Distance</th>
                  <th>Capacity</th>
                  <th>Foreign Taxation</th>

                  <tr>
                     <?php

                        $data = file("update_data.dat");

                        foreach($data as $line) {
                           echo "<td>".$line."</td>";
                        }

                        if($_SESSION['position'] === "manager" && (filesize("update_data.dat") > 0)) {
                           echo "<td><input type='submit' name='approveUpdate'value='Approve' /></td>";
                        }

                        if(isset($_POST['approveUpdate'])) {

                           $update = array();
                           $data = file("update_data.dat");
                           $counter = 0;

                           if(filesize("update_data.dat") > 0) {
                              foreach($data as $lines) {
                                 $update[$counter] = $lines;
                                 $counter++;
                              }

                              $query = "update services set
                              Transportation = '$update[1]',
                              Price = '$update[2]',
                              Distance = '$update[3]',
                              Capacity= '$update[4]',
                              ForeignTaxation = '$update[5]'
                              where transportID = '$update[0]'";

                              $result = mysqli_query($connection, $query);

                              if($result>0) {
                                 echo "<center><h3>A service record has been updated! </h3>";
                              } else {
                                 echo "<center><p>Insertion of new product record failed.</p></center>";
                                 echo mysqli_error($connection);
                              }

                              // clear the file
                              $fp = fopen("update_data.dat", 'w');
                              fwrite($fp, "");
                              fclose($fp);
                           } else {
                              echo "There are no pending update requsts.";
                           }
                        }
                     ?>
                  </tr>
               </table>
            </form>
         </center>

         <center>
            <h3>All Services</h3>
            <table style="width: 99%; ">

               <th>Transportation</th>
               <th>Price</th>
               <th>Distance</th>
               <th>Capacity</th>
               <th>ForeignTaxation</th>
               <?php
                  $query = "select * from services";
                  $result = mysqli_query($connection, $query);
                  while($row = mysqli_fetch_array($result)) {
                     echo "<tr><td>".$row['Transportation']."</td>";
                     echo "<td>".$row['Price']."</td>";
                     echo "<td>".$row['Distance']."</td>";
                     echo "<td>".$row['Capacity']."</td>";
                     echo "<td>".$row['ForeignTaxation']."</td></tr>";
                  }
               ?>
            </table>
         </center>
      </div>
   </body>
</html>
