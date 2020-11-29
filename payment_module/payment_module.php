<!DOCTYPE HTML>

<html>

   <head>

      <link rel="stylesheet" href="style.css" />

      <style>
         h1 {   background-color:lightgrey; padding-top:20px; padding-bottom:20px;   }
         table {
           font-family: arial, sans-serif;
           border-collapse: collapse;
           width: 100%;
         }

         td, th {
           border: 1px solid #dddddd;
           text-align: left;
           padding: 8px;
         }

         tr:nth-child(even) {
           background-color: #dddddd;
         }

         .left{float:left;}
         .right{float:right;}
         .center{margin:0 auto;}
         .body1{
            display: flex;
            flex-direction: row;
         }

         #main {
             width: 100%;
             display: flex;
             flex-direction: column;
             align-items: center;
         }

         #body {
             display: flex;
             flex-direction: row;
         }

      </style>
   </head>

   <body>

      <center>
         <img src="https://logodix.com/logo/89918.png" width="25%" height="25%"/>
         <h1> Management Module: Sales Management Module</h1>
      </center>

      <div style="float: left; ">
         <nav>
            <table style="margin-left: auto; margin-right: auto;">
               <tr><td><a href="../homescreen/homescreen.php">Home Dashboard</a></td></tr>
               <tr><td><a href="../customer_accounts/customer_accounts_module.php">Customer Accounts Management</a></td></tr>
               <tr><td><a href="../shedules_module/DeliveryManagement.php">Delivery Schedule Management</a></td></tr>
               <tr><td><a href="">Payments Management</a></td></tr>
               <tr><td><a href="../services_module/service_management.php">Service Management</a></td></tr>
               <tr><td><a href="../request_management/request_management.php">Request Management</a></td></tr>
               <tr><td><a href="../homescreen/logout.php">Logout</a></td></tr>
            </table>
         </nav>
      </div>

      <?php
         // this whole process was done by member: Siew Joe Kane
         session_start();
      ?>

      <div style="display: inline-block; float: middle; width: 80%; border: solid black 1px; margin: 8px; ">
         <center>
            <nav>

               <table>
                  <tr>
                     <?php
                        // checks if the session is created by the manager
                        // if so then display the update and add links
                        if($_SESSION['position'] === "manager") {
                           echo "<td style='text-align: center'><a href='add_payment_record.php'>Add Record</a></td>";
                           echo "<td style='text-align: center'><a href='update_payment_record.php'>Update</a></td>";
                        }
                     ?>
                  </tr>
               </table>

               <form action="payment_module.php" method="POST">
                  <h3>Search Payment Records</h3>
                  <table id="main">
                     <tr>
                        <td>Search InvoiceID: </td>
                        <td><input style="width: 100%; "type="text" name="paymentID" /></td>
                        <td><input type="submit" name="search" value="search" /></td>
                     </tr>
                  </table>
               </form>
            </nav>
         </center>


         <center>
            <table id="records" style="width: 90%; ">
               <?php
                  // initializing database variables
                  $name = "localhost";
                  $uname = "root";
                  $password = "";
                  $db_name = "group_assignment";

                  // declaring connection
                  $connection = mysqli_connect($name, $uname, $password, $db_name);

                  // search functions
                  if(isset($_POST['search'])) {
                     $search = $_POST['paymentID'];

                     // CONSTRUCTING SEARCH QUERY
                     // selects the following attributes regarding the end user's banking details
                     // and display in a table
                     // based on the keyword obtained via POST method from the form input by end user
                     $query = "select `PaymentID`, `InvoiceID`, `OrderID`, `InvoiceNumber`, `InvoiceDate`, `BillingName`, `Amount`, `AccountNo`, `PaymentType`, `PaymentDate`, `TransactionNumber`, `Comments`, `RequestNumber`, `CreditCardNumber`, `TransportType` from payments having InvoiceID like '%$search%'";
                     $result = mysqli_query($connection, $query);
                     if($result) {
                        echo "<center><h3>Record found!</h3>";
               ?>
                     <th> PaymentID </th>
                     <th> InvoiceID </th>
                     <th> OrderID </th>
                     <th> InvoiceNumber </th>
                     <th> InvoiceDate </th>
                     <th> BillingName </th>
                     <th> Amount </th>
                     <th> AccountNo </th>
                     <th> PaymentType </th>
                     <th> PaymentDate </th>
                     <th> TransactionNumber </th>
                     <th> Comments </th>
                     <th> RequestNumber </th>
                     <th> Credit Card Number </th>
                     <th> Transport Type </th>

                  <?php
                        while($row = mysqli_fetch_array($result)) {
                           echo "<tr><td>".$row['PaymentID']."</td>";
                           echo "<td>".$row['InvoiceID']."</td>";
                           echo "<td>".$row['OrderID']."</td>";
                           echo "<td>".$row['InvoiceNumber']."</td>";
                           echo "<td>".$row['InvoiceDate']."</td>";
                           echo "<td>".$row['BillingName']."</td>";
                           echo "<td>".$row['Amount']."</td>";
                           echo "<td>".$row['AccountNo']."</td>";
                           echo "<td>".$row['PaymentType']."</td>";
                           echo "<td>".$row['PaymentDate']."</td>";
                           echo "<td>".$row['TransactionNumber']."</td>";
                           echo "<td>".$row['Comments']."</td>";
                           echo "<td>".$row['RequestNumber']."</td>";
                           echo "<td>".$row['CreditCardNumber']."</td>";
                           echo "<td>".$row['TransportType']."</td></tr></center>";
                        }
                     } else {
                        echo "<center><p>No such records found!</p></center>";
                     }
                  }  // this is to close the above if statement
               ?>
            </table>
         </center>

         <?php
            // declaring $query
            $query = "SELECT * FROM payments";
            $result = mysqli_query($connection, $query);

            if(mysqli_num_rows($result) == 0) {
               echo "<center><p>No record in the Products table.</p></center>";
            } else {
               echo "<center><h3>All Records</h3></center>";
               ?>

               <center>

                  <table id="records">

                     <th> PaymentID </th>
                     <th> InvoiceID </th>
                     <th> InvoiceNumber </th>
                     <th> InvoiceDate </th>
                     <th> OrderID </th>
                     <th> BillingName </th>
                     <th> Amount </th>
                     <th> AccountNo </th>
                     <th> PaymentType </th>
                     <th> PaymentDate </th>
                     <th> TransactionNumber </th>
                     <th> Comments </th>
                     <th> RequestNumber </th>
                     <th> Credit Card Number </th>
                     <th> Transport Type </th>

                     <?php

                        while($row = mysqli_fetch_array($result)) {
                           echo "<tr><td>".$row['PaymentID']."</td>";
                           echo "<td>".$row['InvoiceID']."</td>";
                           echo "<td>".$row['InvoiceNumber']."</td>";
                           echo "<td>".$row['InvoiceDate']."</td>";
                           echo "<td>".$row['OrderID']."</td>";
                           echo "<td>".$row['BillingName']."</td>";
                           echo "<td>".$row['Amount']."</td>";
                           echo "<td>".$row['AccountNo']."</td>";
                           echo "<td>".$row['PaymentType']."</td>";
                           echo "<td>".$row['PaymentDate']."</td>";
                           echo "<td>".$row['Comments']."</td>";
                           echo "<td>".$row['PaymentDate']."</td>";
                           echo "<td>".$row['RequestNumber']."</td>";
                           echo "<td>".$row['CreditCardNumber']."</td>";
                           echo "<td>".$row['TransportType']."</td></tr>";
                        }
                        mysqli_close($connection);
                     ?>
                  </table>
               </center>
            <?php } ?>

      </div>
   </body>
</html>
