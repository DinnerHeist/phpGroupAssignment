<!DOCTYPE html>

<html>

   <head>
      <link rel="stylesheet" href="style.css" />
   </head>

   <body>

      <center>
         <img src="https://logodix.com/logo/89918.png" width="25%" height="25%"/>
         <h1> Management Module: Service Management Module</h1>
      </center>

      <div>
         <center>
            <form action="add_service.php" method="POST">
               <table>
                  <tr>
                     <td>Transportation Type: </td>
                     <td><input required type="text" name="transportation" /></td>
                  </tr>

                  <tr>
                     <td>Price: </td>
                     <td><input required type="number" name="price" /></td>
                  </tr>

                  <tr>
                     <td>Distance: </td>
                     <td><input required type="number" name="distance" /></td>
                  </tr>

                  <tr>
                     <td>Capacity: </td>
                     <td><input required type="number" name="capacity" /></td>
                  </tr>

                  <tr>
                     <td>Foreign Taxation: </td>
                     <td><input required type="number" name="foreignTaxation" /></td>
                  </tr>
               </table>

               <input type="submit" name="Add" value="Submit" />
            </form>

            <a href="service_management.php">Back to Service Management</a>
         </center>

         <?php
            session_start();
            $new_list = array();
            $add_list = array();

            if(isset($_POST['Add'])) {

               if(count($new_list) < 1) {
                  $new_list = array(
                     "transportationType" => $_POST['transportation'],
                     "price" => $_POST['price'],
                     "distance" => $_POST['distance'],
                     "capacity" => $_POST['capacity'],
                     "foreignTaxation" => $_POST['foreignTaxation'],
                     "approved"=>"pending"
                  );
               }
               $_SESSION['add_list'] = array_merge($new_list, $add_list);
            }
         ?>
      </div>
   </body>
</html>
