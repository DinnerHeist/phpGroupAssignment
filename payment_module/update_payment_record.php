<!DOCTYPE HTML>

<html>

   <head>
      <style>
         h1 {   background-color:lightgrey; padding-top:20px; padding-bottom:20px;   }
         table {   border-collapse: collapse; margin: 8px;   }
         table, tr, td, th{   border: 1px solid black; padding: 10px;  }
      </style>
   </head>

   <body>

      <center>
         <img src="https://logodix.com/logo/89918.png" width="25%" height="25%"/>
         <h1>Update Payment Record</h1>
      </center>

      <center>

         <form action="update_payment_record.php" method="POST">
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
                  <td>Request Number</td>
                  <td><input type="text" name="requestNumber" required/></td>
               </tr>
            </table>

            <td><input type="submit" value="Update" name="update" /></td>
         </form>

         <table>
            <?php
               // define sql database connection variables
               $name = "localhost";
               $uname = "root";
               $password = "";
               $db_name = "group_assignment";

               // declaring connection
               $connection = mysqli_connect($name, $uname, $password, $db_name);

               if(isset($_POST['update'])) {

                  // getting primary key from user input
                  $paymentid = $_POST['paymentID'];

                  // fetching values from form
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

                  // constructing query for searching the record
                  $query = "select * from payments where PaymentID = '$paymentid'";

                  // checks if the primary key exist within the database
                  $check = mysqli_query($connection, $query);

                  // check if the record has been updated successfully
                  if(mysqli_num_rows($check) > 0) {

                     // constructing query for updating record
                     $query = "update payments set
                     InvoiceID = '$invoiceid',
                     OrderID = '$orderid',
                     InvoiceNumber = '$invoiceno',
                     InvoiceDate = '$invoicedate',
                     BillingName = '$billingname',
                     Amount = '$amount',
                     AccountNo = '$accountno',
                     PaymentType = '$paymenttype',
                     PaymentDate = '$paymentdate',
                     TransactionNumber = '$transactionno',
                     Comments = '$comments',
                     RequestNumber = '$requestno'
                     where PaymentID='$paymentid'";

                     $result = mysqli_query($connection, $query);
                     echo "<p>Record for <b>$paymentid</b> updated.</p>";
                  } else {
                     echo "<p style = 'color: red;'> Record does not exist! </p>";
                  }
               }
            ?>
         </table>
         <a href="payment_module.php">Return to Payment Module</a>
      </center>
   </body>
</html>
