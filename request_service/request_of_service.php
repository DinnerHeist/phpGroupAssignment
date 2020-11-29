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

      input{
         width: 90%;
         padding: 2px;
         margin: 2px;
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
         session_Start();

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
         <h1>Make Delivery</h1>
      </center>

         <div style="float: left; display: inline-block; ">
            <center>
               <table style="margin-left: -27%; ">
                  <tr><td><a href="../registration/customer_homescreen.php">Homescreen</a></td></tr>
                  <tr><td><a href="../checking_service_status/tracking.php">Track My Delivery Status</a></td></tr>
                  <tr><td><a href="../request_service/request_of_service.php">Make Delivery</a></td></tr>
                  <tr><td><a href="../checking_service_status/check_service.php">Check Services</a></td></tr>
                  <tr><td><a href="../registration/logout.php">Logout</a></td></tr>
               </table>

               <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRVjzmKVXWk0VbDEd9yWEvUA4nbWRGmNVfM1g&usqp=CAU" style="width: 70%; height: 70%; margin-top: 10%; " />

            </center>
         </div>

         <div style="float: right; ">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQuzMUKbfOmPmiRhyj0ZdjPkDp-3IAvvcWCOQ&usqp=CAU" style="margin-right: 50%; "/>
         </div>

      <center>
         <div style="display: inline-block; float: left; margin-left: 10%; width: 40%; padding: 8px; ">
            <form action="request_of_service.php" method="POST">
               <table style="width: 90%; border:solid black 1px; ">

                 <tr>
                     <td>Client Name</td>
                     <td><input type="text" name="clientName" value="<?php echo $_SESSION['name']; ?>" required/></td>
                  </tr>

                <tr>
                     <td>Contact Number: </td>
                     <td><input type="number" name="contactNumber" required/></td>
                  </tr>

                <tr>
                     <td>Client Address: </td>
                     <td><input type="text" name="clientAdress" required/></td>
                  </tr>

                  <tr>
                     <td>Delivery Service: </td>
                     <td>
                        <select name="deliveryService" style="width: 90%%; ">
                           <option value="Domestic">Domestic</option>
                           <option value="International">International</option>
                        </select>
                     </td>
                  </tr>

                  <tr>
                     <td>Shipping Date: </td>
                     <td><input type="date" name="shippingDate" required/></td>
                  </tr>

                  <tr>
                     <td>Shipping Location: </td>
                     <td><input type="text" name="shippingLocation" required /></td>
                  </tr>

                  <tr>
                     <td>Transportation Type: </td>
                     <td>
                        <select name="transportationType" style="width: 90%; ">
                           <?php
                              // functionality done by member: Siew Joe Kane
                              // this feature will check database for all available functions
                              // this is to ensure that the functions available will be updated automatically
                              // based on changes made to the database
                              // query will select all transportation types from database
                              $query = "select `Transportation` from services";
                              $result = mysqli_query($connection, $query);

                              if($result) {
                                 while($row = mysqli_fetch_array($result)) {
                                    $temp = $row['Transportation'];
                                    echo "<option value = '$temp'>$temp</option>";
                                 }
                              } else {
                                 echo mysqli_error($connection);
                              }
                           ?>
                        </select>
                     </td>
                  </tr>

                  <tr>
                     <td>Capacity (Kilograms): </td>
                     <td><input type="number" name="capacity" required/></td>
                  </tr>

                 <tr>
                     <td>Credit Card Number: </td>
                     <td><input type="number" name="creditCardNo" required/></td>
                  </tr>

                  <tr>
                      <td>Bank Account Number: </td>
                      <td><input type="number" name="bankAccountNumber" required/></td>
                   </tr>

                   <tr>
                      <td>Description (Optional): </td>
                      <td><textarea name="description" placeholder="Enter description here..." style="width: 91%; height: 50%; margin-right: 5%; "></textarea></td>
                   </tr>
               </table>

               <?php
                  if(isset($_POST['submit'])) {
                     // DIRECT USER TO CONFIRMATION PAGE
                     // header("Location: confirmation_page.php");

                     // fetching values from form
                     $clientname = $_POST["clientName"];
                     $contactnumber = $_POST["contactNumber"];
                     $clientaddress = $_POST["clientAdress"];
                     $deliveryservice = $_POST["deliveryService"];
                     $shippingdate = $_POST["shippingDate"];
                     $shippinglocation = $_POST["shippingLocation"];
                     $transportationtype = $_POST["transportationType"];
                     $capacity = $_POST["capacity"];
                     $creditcardno = $_POST["creditCardNo"];
                     $bankAccountNumber = $_POST['bankAccountNumber'];
                     $description = $_POST['description'];

                     $_SESSION['description'] = $description;
                     $_SESSION['transportType'] = $transportationtype;

                     // condition variable proceed
                     $proceed = "false";

                     if($capacity >  70) {
                        echo "<script>alert('Capacity cannot be higher than 70kg!')</script>";
                     } else {
                        $proceed = "true";
                     }

                     if($proceed === "true") {

                        // construct insertion $query
                        $query = "INSERT INTO `request` (`ClientName`, `ContactNumber`,`ClientAddress`, `DeliveryService`, `ShippingDate`, `ShippingLocation`, `TransportationType`, `Capacity`, `CreditCardNo` )
                        values (
                           '$clientname',
                           '$contactnumber',
                           '$clientaddress',
                           '$deliveryservice',
                           '$shippingdate',
                           '$shippinglocation',
                           '$transportationtype',
                           '$capacity',
                           '$creditcardno')";

                        $result_insert = mysqli_query($connection, $query);
                        // this process was created by member: Siew Joe Kane
                        // get request number
                        // the objective of this function is to retrieve the request number based on the
                        // details input by the client
                        // in the html form

                        // initializing empty request number variable
                        $request_number = "";

                        // below query will fetch for request number from request table
                        $query_request_number = "select `RequestNumber` from request where
                        `ClientName` like '%$clientname' AND
                        `ContactNumber` like '%$contactnumber' AND
                        `ClientAddress` like '%$clientaddress' AND
                        `DeliveryService` like '%$deliveryservice' AND
                        `ShippingLocation` like '%$shippinglocation' AND
                        `CreditCardNo` like '%$creditcardno' AND
                        `Capacity` like '%$capacity' AND
                        `TransportationType` like '%$transportationtype'";

                        $result = mysqli_query($connection, $query_request_number);

                        if($result) {
                           $row = mysqli_fetch_array($result);
                           $request_number = $row['RequestNumber'];
                           $_SESSION['requestNumber'] = $request_number;
                        } else {
                           echo mysqli_error($connection);
                        }

                        // getting the price of the transportation type
                        // getting the estimated time of delivery from service table
                        $query = "select * from services where Transportation like '%$transportationtype'";
                        $result = mysqli_query($connection, $query);
                        $row = mysqli_fetch_array($result);
                        $totalPrice = $row['Price'];
                        $estimateDeliveryTime = $row['EstimateDeliveryTime'];
                        $maxCapacity = $row['Capacity'];

                        // insert into schedules table
                        $query = "insert into delivery_schedule(
                           `BillingName`,
                           `DeliveryStatus`,
                           `DeliveryDate`,
                           `OriginLocation`,
                           `DestinationLocation`,
                           `DeliveryMode`,
                           `MaximumCapasity`,
                           `EstimatedTimeDelivery`,
                           `RequestNumber`) values (
                              '$clientname',
                              'NOT DELIVERED',
                              '$shippingdate',
                              '$clientaddress',
                              '$shippinglocation',
                              '$transportationtype',
                              '$maxCapacity',
                              '$estimateDeliveryTime',
                              '$request_number')";

                           $result = mysqli_query($connection, $query);
                           if($result) {
                              echo "added to schedules";
                           } else {
                              echo mysqli_error($connection);
                           }

                        // the following process is to add a payment record into the payments table
                        $query_payments = "insert into `payments` (`Comments`, `Amount`, `BillingName`, `CreditCardNumber`, `RequestNumber`, `PaymentDate`, `TransportType`, `InvoiceDate`, `AccountNo`)
                        values (
                           '$description',
                           '$totalPrice',
                           '$clientname',
                           '$creditcardno',
                           '$request_number',
                           '$shippingdate',
                           '$transportationtype',
                           '$shippingdate',
                           '$bankAccountNumber')";

                        $result = mysqli_query($connection, $query_payments);

                        if($result) {
                           echo "added to payments";
                        } else {
                           echo mysqli_error($connection);
                        }

                        // the below query will insert the request number stored in the session variable
                        // $_SESSION['requestNumber']; into the "checking_of_service_and_status" table
                        $query = "insert into checking_of_service_and_status (
                           `RequestNumber`,
                           `availableForPickup`,
                           `pending`,
                           `outOfDelivery`,
                           `received`,
                           `destination`,
                           `description`,
                           `estimatedDeliveryDateTime`)
                        values (
                           '$request_number',
                           'NO',
                           'YES',
                           'NO',
                           'NO',
                           '$shippinglocation',
                           '$description',
                           '$estimateDeliveryTime')";

                        $result = mysqli_query($connection, $query);

                        if($result_insert > 0) {

                           // craft query to select all from request database
                           $query = "select
                              `ClientName`,
                              `ContactNumber`,
                              `ClientAddress`,
                              `ShippingLocation`,
                              `DeliveryService`,
                              `TransportationType`,
                              `Capacity`,
                              `CreditCardNo` from  request";

                           $result = mysqli_query($connection, $query);

                           if($result) {

                              // process created by member: Siew Joe Kane
                              // creating the xml file upon sucessful sql insertion
                              // creating xml dom object
                              $dom = new DomDocument();

                              // creat root element customer info
                              $customerDetails = $dom->createElement("CustomerInfo");
                              $dom->appendChild($customerDetails); // append a child node to "CustomerInfo"

                              while($row = mysqli_fetch_array($result)) {

                                 // create element (customer)
                                 $customer = $dom->createElement("Customer");
                                 $customerDetails->appendChild($customer);

                                 // create element (customerName) and text node. Add to DOM object (child of "Customer")
                                 $name = $dom->createElement("name"); // create a node called "name"
                                 $name->appendChild($dom->createTextNode($row['ClientName'])); // assign to the "name" node the string "jake"
                                 $customer->appendChild($name); // append to the customer node

                                 // create element (customer contact number) and text node. Add to DOM object (child of "Customer")
                                 $contactNumber = $dom->createElement("contact_number"); // create a node called "contactNumber"
                                 $contactNumber->appendChild($dom->createTextNode($row['ContactNumber'])); // assign to the "contactNumber" node the string "1234"
                                 $customer->appendChild($contactNumber); // append to the customer node

                                 // create element (customer contact number) and text node. Add to DOM object (child of "Customer")
                                 $originAddress = $dom->createElement("OriginAddress"); // create a node called "contactNumber"
                                 $originAddress->appendChild($dom->createTextNode($row['ClientAddress'])); // assign to the "contactNumber" node the string "1234"
                                 $customer->appendChild($originAddress); // append to the customer node

                                 // destination address node
                                 $destinationAddress = $dom->createElement("ShippingLocation");
                                 $destinationAddress->appendChild($dom->createTextNode($row['ShippingLocation']));
                                 $customer->appendChild($destinationAddress);

                                 // domestic or international delivery service
                                 $deliveryService = $dom->createElement("DeliveryService");
                                 $deliveryService->appendChild($dom->createTextNode($row['DeliveryService']));
                                 $customer->appendChild($deliveryService);

                                 // transportation type node
                                 $transportationtype = $dom->createElement("TransportType");
                                 $transportationtype->appendChild($dom->createTextNode($row['TransportationType']));
                                 $customer->appendChild($transportationtype);

                                 // capacity node
                                 $capacity = $dom->createElement("Capacity");
                                 $capacity->appendChild($dom->createTextNode($row['Capacity']));
                                 $customer->appendChild($capacity);

                                 // credit card number
                                 $creditcardno = $dom->createElement("CreditCardNumber");
                                 $creditcardno->appendChild($dom->createTextNode($row['CreditCardNo']));
                                 $customer->appendChild($creditcardno);
                              }
                              // write to DOM object XML file
                              $dom->save("customers_requests.xml");
                              echo "The XML file is created.";

                           } else {
                              echo mysqli_error($connection);
                           }
                           echo "<p>A new request of service has been added!</p>";
                           ?>
                           <!--This Javascript code will redirect the user to the confirmation page-->
                           <!--Using header() function will not work since the header is occupied with user input data-->
                           <!--Javascript will only execute when the submit button is pressed-->
                           <script type="text/javascript">location.href = 'confirmation_page.php';</script>
                        <?php
                  		} else {
                  		   echo "<center><p>Insertion of new request failed.</p></center>";
                           echo mysqli_error($connection);
                        }
                     }
                  }
                  $proceed = "false";
               ?>
               <input type="submit" name="submit" value="Submit" style="margin-top: 8px; margin-bottom: 8px; width: 10%; " />

            </form>
            <a href="../registration/customer_homescreen.php">Return to Homescreen</a>
         </div>
      </center>
   </body>
</html>
