<!DOCTYPE HTML>

<html>
   <head>
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
      </style>
   </head>

   <body>
      <?php
         // this process was created entirely by member: Siew Joe Kane
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
         <h1>Request Management</h1>
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

      <div>
         <form method="POST" action="request_management.php">
            <?php
               if(isset($_POST['refresh']))
            ?>
            <input type="submit" style="margin: 8px; " name="refresh" value="Refresh" />
         </form>

         <center>
            <table style="width: 83.5%; ">

               <th>Request Number</th>
               <th>Client Name</th>
               <th>Contact Number</th>
               <th>Origin Address</th>
               <th>Destination Address</th>
               <th>Payment Date</th>
               <th>Domestic/International</th>
               <th>Transport Type</th>
               <th>Capacity (Kilograms)</th>

               <tr>
                  <?php
                     $query = "SELECT
                     `RequestNumber`,
                     `ClientName`,
                     `ContactNumber`,
                     `ClientAddress`,
                     `ShippingLocation`,
                     `ShippingDate`,
                     `DeliveryService`,
                     `TransportationType`,
                     `Capacity`  FROM `request`";
                     $result = mysqli_query($connection, $query);
                     if($result) {
                        while($row = mysqli_fetch_array($result)) {
                           echo "<tr><td>".$row['RequestNumber']."</td>";
                           echo "<td>".$row['ClientName']."</td>";
                           echo "<td>".$row['ContactNumber']."</td>";
                           echo "<td>".$row['ClientAddress']."</td>";
                           echo "<td>".$row['ShippingLocation']."</td>";
                           echo "<td>".$row['ShippingDate']."</td>";
                           echo "<td>".$row['DeliveryService']."</td>";
                           echo "<td>".$row['TransportationType']."</td>";
                           echo "<td>".$row['Capacity']."</td></tr>";
                        }
                     }
                  ?>
               </tr>
            </table>
         </center>
      </div>
   </body>
</html>
