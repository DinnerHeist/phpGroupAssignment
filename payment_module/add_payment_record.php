<!DOCTYPE HTML>

<html>

<head>
   <style>
      input{width: 100%; padding: 5px;}
      h1 {   background-color:lightgrey; padding-top:20px; padding-bottom:20px;   }
   </style>
</head>

   <body>

      <?php session_Start(); ?>

      <center>
         <img src="https://logodix.com/logo/89918.png" width="25%" height="25%"/>
         <h1>Add Payment Record</h1>
         <div>

            <form action="add_payment_record.php" method="POST">
               <table>
                  <tr>
                     <td>Payment ID: </td>
                     <td><input type="text" name="paymentID" required/></td>
                  </tr>

                  <tr>
                     <td>Invoice ID: </td>
                     <td><input type="text" name="invoiceID" required/></td>
                  </tr>

                  <tr>
                     <td>Invoice Number: </td>
                     <td><input type="text" name="invoiceNo"  required/></td>
                  </tr>

                  <tr>
                     <td>Invoice Date: </td>
                     <td><input type="date" name="invoiceDate" placeholder="e.g. 2020-11-14	" required/></td>
                  </tr>

                  <tr>
                     <td>Order ID: </td>
                     <td><input type="text" name="orderID" required /></td>
                  </tr>

                  <tr>
                     <td>Billing Name: </td>
                     <td><input type="text" name="billingName" placeholder="e.g. James" required /></td>
                  </tr>

                  <tr>
                     <td>Amount: </td>
                     <td><input type="text" name="amount" placeholder="e.g. 3000" required/></td>
                  </tr>

                  <tr>
                     <td>AccountNo: </td>
                     <td><input type="text" name="accountNo" required/></td>
                  </tr>

                  <tr>
                     <td>Payment Type: </td>
                     <td><input type="text" name="PaymentType" placeholder="e.g. credit card" required/></td>
                  </tr>

                  <tr>
                     <td>Payment Date: </td>
                     <td><input type="date" name="paymentDate" placeholder="e.g. 2020-11-14" required/></td>
                  </tr>

                  <tr>
                     <td>Transaction Number: </td>
                     <td><input type="text" name="transactionNumber" required/></td>
                  </tr>

                  <tr>
                     <td>Comments: </td>
                     <td><input type="text" name="comments" required/></td>
                  </tr>

                  <tr>
                     <td>Request Number: </td>
                     <td><input type="text" name="requestNumber" required/></td>
                  </tr>

                  <tr>
                     <td>Credit Card Number: </td>
                     <td><input type="number" name="creditCardNumber" required/></td>
                  </tr>

                  <tr>
                     <td>Transport Type: </td>
                     <td><input type="text" name="transportType" required/></td>
                  </tr>
               </table>

               <input type="submit" name="submit" value="submit"style="width: 8%; margin: 8px;" />

            </form>
         </div>
      </center>

      <?php
         if(isset($_POST['submit'])) {

            // define sql database connection variables
            $name = "localhost";
            $uname = "root";
            $password = "";
            $db_name = "group_assignment";

            // declaring connection
            $connection = mysqli_connect($name, $uname, $password, $db_name);

            // fetching values from form
            $paymentid = $_POST["paymentID"];
            $invoiceid = $_POST["invoiceID"];
            $invoiceno = $_POST["invoiceNo"];
            $invoicedate = $_POST["invoiceDate"];
            $orderid = $_POST["orderID"];
            $billingname = $_POST["billingName"];
            $amount = $_POST["amount"];
            $accountno = $_POST["accountNo"];
            $paymenttype = $_POST["PaymentType"];
            $transactionno = $_POST["transactionNumber"];
            $comments = $_POST["comments"];
            $requestno = $_POST["requestNumber"];
            $paymentdate = $_POST["paymentDate"];
            $creditCardNumber = $_POST["creditCardNumber"];
            $transportType = $_POST['transportType'];

            // construct insertion $query
            $query = "INSERT INTO payments (`PaymentID`, `InvoiceID`, `OrderID`, `InvoiceNumber`, `InvoiceDate`, `BillingName`, `Amount`, `AccountNo`, `PaymentType`, `PaymentDate`, `TransactionNumber`, `Comments`, `RequestNumber`, `CreditCardNumber`, `TransportType`) values (
               '$paymentid',
               '$invoiceid',
               '$orderid',
               '$invoiceno',
               '$invoicedate',
               '$billingname',
               '$amount',
               '$accountno',
               '$paymenttype',
               '$paymentdate',
               '$transactionno',
               '$comments',
               '$requestno',
               '$creditCardNumber',
               '$transportType')";

            $result = mysqli_query($connection, $query);

            if($result>0) {
               echo "<center><h3>A new payment record has been added! </h3>";
      		} else {
      		   echo "<center><p>Insertion of new product record failed.</p></center>";
               echo mysqli_error($connection);
            }
         }
      ?>

      <center><a href="payment_module.php">Return to Payment Module</a></center>
   </body>

</html>
