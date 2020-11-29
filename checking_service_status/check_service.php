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
         width: 120px;
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
         // this process was completed by member: Siew Joe Kane
         session_Start();

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
         <h1>Check Service</h1>
      </center>

      <div style="float: left; margin-bottom: 100%; width: 13%; ">
         <center>
            <table style="margin-left: auto; margin-right: auto; margin-bottom: 10px; ">
               <tr><td><a href="../registration/customer_homescreen.php">Homescreen</a></td></tr>
               <tr><td><a href="tracking.php">Track My Delivery Status</a></td></tr>
               <tr><td><a href="../request_service/request_of_service.php">Make Delivery</a></td></tr>
               <tr><td><a href="../checking_service_status/check_service.php">Check Services</a></td></tr>
               <tr><td><a href="../registration/logout.php">Logout</a></td></tr>
            </table>
            <img src="https://cdn3.iconfinder.com/data/icons/ecommerce-100/50/Ecommerce__shipping-dhl-truck-delivery-parcel-logistics-512.png"
            alt="delivery_truck" style="width: 80%; height: 80%; "/>
         </center>
      </div>

      <div>
         <center>
            <form action="check_service.php" method="POST">
               <table style="width: 80%; margin-bottom: 2%; ">
                  <tr>
                     <td style="border: solid black 1px; text-align: center; "><strong>Search for Service:</strong> </td>
                     <td style="border: solid black 1px; text-align: center; "><input style="width: 90%; " type="text" name="search_service_name" required/></td>
                     <td style="border: solid black 1px; text-align: center; "><button class="button" name="search_service_submit"><span>Search Service</span></button></td>
                  </tr>
               </table>
            </form>

               <?php
                  // in this process, the system will check whether the search button was pressed
                  // if so, only will the table headers display. Otherwise, remain hidden from end user
                  if(isset($_POST['search_service_submit'])) {

                     ?>
                        <table style="width: 80%; margin-bottom: 5%; ">

                           <th> Transport Mode: </th>
                           <th> Price </th>
                           <th> Distance </th>
                           <th> Capacity </th>
                           <th> Estimated Transit Time </th>
                           <th> Foreign Taxation </th>

                     <?php
                     // in this process, the system will get the input from the end user via post method from the form
                     $service_name = $_POST['search_service_name'];

                     // the query below will select all records from services matching the service name
                     // allowing the end user to search based on the keyword they entered
                     $query = "SELECT * FROM `services` WHERE `Transportation` like '%$service_name%'";

                     $result = mysqli_query($connection, $query);

                     if(!$result) {
                        echo mysqli_error($connection);
                        echo "<p>No result for that particular service.</p>";
                     } else {
                        while($row = mysqli_fetch_array($result)) {
                           echo "<tr><td>".$row['Transportation']."</td>";
                           echo "<td>".$row['Price']."</td>";
                           echo "<td>".$row['Distance']."</td>";
                           echo "<td>".$row['Capacity']."</td>";
                           echo "<td>".$row['EstimateDeliveryTime']."</td>";
                           echo "<td>".$row['ForeignTaxation']."</td></tr>";
                        }
                     }
                  }
               ?>
            </table>
         </center>
      </div>

      <div>
         <center>
            <table style="width: 80%; ">
               <th> Transport Mode: </th>
               <th> Price </th>
               <th> Distance </th>
               <th> Capacity </th>
               <th> Estimated Transit Time </th>
               <th> Foreign Taxation </th>

               <?php

                  // creating the query
                  $query = "SELECT * FROM `services`";

                  // creating the result to send sql statements to database
                  $result = mysqli_query($connection, $query);

                  while($row = mysqli_fetch_array($result)) {
                     echo "<tr><td>".$row['Transportation']."</td>";
                     echo "<td>".$row['Price']."</td>";
                     echo "<td>".$row['Distance']."</td>";
                     echo "<td>".$row['Capacity']."</td>";
                     echo "<td>".$row['EstimateDeliveryTime']."</td>";
                     echo "<td>".$row['ForeignTaxation']."</td></tr>";
                  }
               ?>
            </table>
         </center>
      </div>

      <?php

         // below is Liew Ee-Ling's Contribution which was not used in the final version of the client module
         // as it was irrelevant to the topic concerned
         // the below process enables end users to enter specific data relating to the user which is only concerned in the
         // request for information process
         // thus, considered redundant and irrelevant
         // and only serves as Liew Ee-Ling's proof of contribution

         if(isset($_POST['submit'])) {
            $name = "localhost";
            $uname = "root";
            $password = "";
            $db_name = "group_assignment";

            $connection = mysqli_connect($name, $uname, $password, $db_name);

            $trackingnumber = $_POST["trackingNumber"];
            $availableforpickup = $_POST["availableForPickup"];
            $Exception = $_POST["exception"];
            $Expired = $_POST["expired"];
            $Pending = $_POST["pending"];
            $outofdelivery = $_POST["outOfDelivery"];
            $Received = $_POST["received"];
            $itemname = $_POST["itemName"];
            $deliveryid = $_POST["deliveryID"];
            $Paid = $_POST["paid"];
            $Returned = $_POST["returned"];
            $Destination = $_POST["destination"];
            $estimateddeliverydatetime = $_POST["estimatedDeliveryDateTime"];
            $waybillnumber = $_POST["wayBillNumber"];
            $nextstep = $_POST["nextStep"];
            $Description = $_POST["description"];

            $query = "INSERT INTO service and status (`TrackingNumber`, `AvailableForPickup`, `Exception`, `Expired`, `Pending`, `OutOfDelivery`, `Received`, `ItemName`, `DeliveryID`, `Paid`, `Returned`, `Destination`, `EstimatedDeliveryDateTime`, `WayBillNumber`, `NextStep`, `Description`) values (
            '$trackingnumber',
            '$availableforpickup',
            '$Exception',
            '$Expired',
            '$Pending',
            '$outofdelivery',
            '$Received',
            '$itemname',
            '$deliveryid',
            '$Paid',
            '$Returned',
            '$Destination',
            '$estimateddeliverydatetime',
            '$waybillnumber',
            '$nextstep',
            '$Description')";
         }
      ?>
   </body>
</html>
