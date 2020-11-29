<!DOCTYPE html>

<html>

   <head>
      <link rel="stylesheet" href="style.css" />
   </head>

   <body>

      <center>
         <img src="https://logodix.com/logo/89918.png" width="25%" height="25%"/>
         <h1> Management Module: Sales Management Module</h1>
      </center>

      <?php
         // setting up database variables
         $name = "localhost";
         $uname = "root";
         $password = "";
         $db_name = "group_assignment";

         // declaring connection
         $connection = mysqli_connect($name, $uname, $password, $db_name);
      ?>

      <center>
         <form method="POST" action="update_service.php">
            <table>
               <tr>
                  <td>Transport ID to update: </td>
                  <td><input type="text" name="transportID"  />
               </tr>

               <tr>
                  <td>Transport Name: </td>
                  <td><input type="text" name="transportName"  />
               </tr>

               <tr>
                  <td>Price: </td>
                  <td><input type="text" name="transportPrice"  />
               </tr>

               <tr>
                  <td>Distance </td>
                  <td><input type="text" name="transportDistance"  />
               </tr>

               <tr>
                  <td>Capacity: </td>
                  <td><input type="text" name="transportCapacity"  />
               </tr>

               <tr>
                  <td>Foreign Taxation: </td>
                  <td><input type="text" name="transportTaxation"  />
               </tr>
            </table>

            <input type="submit" name="Submit" value="Submit" />

         </form>

         <?php
            if(isset($_POST['Submit'])) {
               $fp = fopen("update_data.dat", 'w');

               // get all the form data
               $update_list = array(
                  "transportID" => $_POST['transportID'],
                  "transportName" => $_POST['transportName'],
                  "transportPrice" => $_POST['transportPrice'],
                  "transportDistance" => $_POST['transportDistance'],
                  "transportCapacity" => $_POST['transportCapacity'],
                  "transportTaxation" => $_POST['transportTaxation'],
                  "status" => "pending"
               );

               $counter = 0;
               $update_array = array();
               foreach($update_list as $attribute => $values) {
                  fwrite($fp, $values."\n");
               }
               
               fclose($fp);
            }
         ?>
      </center>

      <center>
            <table>

               <th>TransportID</th>
               <th>Transport Type</th>
               <th>Price</th>
               <th>Distance</th>
               <th>Capacity</th>
               <th>Foreign Taxation</th>

               <?php
                  $query = "SELECT * FROM `services`";
                  $result = mysqli_query($connection, $query);

                  if($result) {
                     while($row = mysqli_fetch_array($result)) {
                        echo "<tr><td>".$row['transportID']."</td>";
                        echo "<td>".$row['Transportation']."</td>";
                        echo "<td>".$row['Price']."</td>";
                        echo "<td>".$row['Distance']."</td>";
                        echo "<td>".$row['Capacity']."</td>";
                        echo "<td>".$row['ForeignTaxation']."</td></tr>";
                     }
                  } else {
                     echo "no result";
                  }
               ?>
            </table>

            <a href="service_management.php">Go back to service management</a>
      </center>
   </body>

</html>
