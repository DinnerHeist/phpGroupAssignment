<!DOCTYPE HTML>

<html>
   <head>

      <link rel="stylesheet" href="style.css" />
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
         // this process was developed by member: Siew Joe Kane
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
         <h1> Make Delivery</h1>
      </center>

      <div style="border: solid black 1px; ">
         <center>
            <h3>CONFIRMATION</h3>

            <?php

               if(isset($_POST['go_back'])) {
                  header("Location: request_of_service.php");
               }

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

                  // we are going to extract the price for the transport type inputted by the end user in the html forms
                  // in the previous page
                  $type = $_POST['transportationType'];
                  $query = "select `Price` from services where Transportation like '%$type' ";
                  $result =  mysqli_query($connection, $query);
                  $row = mysqli_fetch_array($result);
                  $totalPrice = $row['Price'];

                  $_SESSION['description'] = $description;
                  $_SESSION['transportType'] = $transportationtype;
                  ?>
                  <!--This table is used to display all of the input given by the user in the previous page-->
                  <!--using the POST method-->

                  <table>
                     <tr>
                        <th>Client Name: </th>
                        <td><?php echo $clientname; ?></td>
                     </tr>

                     <tr>
                        <th>Contact Number: </th>
                        <td><?php echo $contactnumber; ?></td>
                     </tr>

                     <tr>
                        <th>Client Address:	</th>
                        <td><?php echo $clientaddress; ?></td>
                     </tr>

                     <tr>
                        <th>Delivery Service:	</th>
                        <td><?php echo $deliveryservice; ?></td>
                     </tr>

                     <tr>
                        <th>Shipping Date: </th>
                        <td><?php echo $shippingdate; ?></td>
                     </tr>

                     <tr>
                        <th>Shipping Location:	</th>
                        <td><?php echo $shippinglocation; ?></td>
                     </tr>

                     <tr>
                        <th>Transportation Type:	</th>
                        <td><?php echo $transportationtype; ?></td>
                     </tr>

                     <tr>
                        <th>Capacity (Kilograms):	</th>
                        <td><?php echo $capacity; ?></td>
                     </tr>

                     <tr>
                        <th>Credit Card Number:	</th>
                        <td><?php echo $creditcardno; ?></td>
                     </tr>

                     <tr>
                        <th>Bank Account Number:	</th>
                        <td><?php echo $bankAccountNumber; ?></td>
                     </tr>

                     <tr>
                        <th>Total Price:	</th>
                        <td><?php echo $totalPrice; ?></td>
                     </tr>
                  </table>

                  <table>
                     <tr>
                        <td><a href="request_of_service.php">Go Back</a></td>
                        <td><a href="confirmation_page_2.php">next</a></td>
                     </tr>
                  </table>

                  <?php
                  }
                  if(isset($_POST['next'])) {
                     // condition variable proceed
                     $proceed = "true";

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

                        // the following process is to add a payment record into the payments table
                        $query = "insert into `payments` (`Comments`, `BillingName`, `CreditCardNumber`, `RequestNumber`, `PaymentDate`, `TransportType`, `InvoiceDate`, `AccountNo`)
                        values (
                           '$description',
                           '$clientname',
                           '$creditcardno',
                           '$request_number',
                           '$shippingdate',
                           '$transportationtype',
                           '$shippingdate',
                           '$bankAccountNumber')";

                        $result = mysqli_query($connection, $query);

                        if($result) {
                           echo "added to payments";
                        } else {
                           echo mysqli_error($connection);
                        }


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

                           $proceed = "false";
                           ?>
                           <!-- <script type="text/javascript">location.href = 'confirmation_page.php';</script> -->
                           <?php
                        } else {
                           echo "<center><p>Insertion of new request failed.</p></center>";
                           echo mysqli_error($connection);
                        }
                     }
                  }
               ?>
            <a href="../registration/customer_homescreen.php">Return to Homescreen</a>
         </center>
      </div>
   </body>
</html>
