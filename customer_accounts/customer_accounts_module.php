<?php
    session_start();

    if (!isset($_SESSION['name']))
        header('Location: ../homescreen/staff_login.php');
?>

<html>
   <head>
      <link rel="stylesheet" href="style.css">
   </head>

   <body>

   <?php
       include '../customer_accounts/includes/handle_requests.php';
   ?>

   <header>
       <img src="https://logodix.com/logo/89918.png" width="25%" height="50px"/>
       <h1>Management Module - Customer Accounts Module</h1>
   </header>

   <div id="body">
       <nav>
           <table>
               <tbody>
                   <tr><td><a href="../homescreen/homescreen.php">Home Dashboard</a></td></tr>
                   <tr><td><a href="customer_accounts_module.php">Customer Accounts Management</a></td></tr>
                   <tr><td><a href="../shedules_module/DeliveryManagement.php">Delivery Schedule Management</a></td></tr>
                   <tr><td><a href="../payment_module/payment_module.php">Payments Management</a></td></tr>
                   <tr><td><a href="../services_module/service_management.php">Service Management</a></td></tr>
                   <tr><td><a href="../request_management/request_management.php">Request Management</a></td></tr>
                   <tr><td><a href = "../homescreen/logout.php"> Logout </a></td></tr>
               </tbody>
           </table>
       </nav>

       <div id="main">
           <nav>
               <table>
                   <tbody>
                       <tr>
                           <td>
                               <form action="customer_accounts_module.php" method="post">
                                   <input type="submit" name="search" value="Search Customer Accounts"
                                       <?php if ($task === 'search') echo 'class="selected"'; ?>>
                               </form>
                           </td>

                           <?php
                               if ($position === 'manager') {
                           ?>
                           <td>
                               <form action="customer_accounts_module.php" method="post">
                                   <input type="submit" name="approve" value="Approve Status Updates (For Managers)"
                                       <?php if ($task === 'approve') echo 'class="selected"'; ?>>
                               </form>
                           </td>
                           <?php
                               }
                           ?>
                       </tr>
                   </tbody>
               </table>
           </nav>

           <?php
               if ($task === 'search')
                  include 'includes/search.php';
               else if ($task === 'approve')
                  include 'includes/approve.php';
           ?>
       </div>
   </div>

   </body>

   </body>
</html>
