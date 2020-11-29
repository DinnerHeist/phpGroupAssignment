<!DOCTYPE HTML>
<html>
   <head>
      <style>
         ul.list{
         list-style-type: none;
         text-align:center;
         }

         ul.list li{
         width:250px;
         margin-bottom:15px;
         text-align: center;
         }

         ul.list li input{
         width:250px;
         text-align:center;
         padding:10px 0px;
         border:none;
         background-color:#FF0000;
         border-radius:20px;
         }
         ul.list li input[type="button"]{
         background-color: #4690fb ;
         color:#fff;
         }
         ul.list li:nth-child(5){
         color:red;
         }
         fieldset{
         border: 1px solid;
         width: 50%;
         margin:auto;
         background-color:white;
         }

         body{
            font-size:20px;
            font-family:calibri;
            background-image:url('city.jpg');
            height: 100%; /* You must set a specified height */
            background-position: center; /* Center the image */
            background-repeat: no-repeat; /* Do not repeat the image */
            background-size: cover;
         }

         header h2 { letter-spacing: 0.5em;background: #000; border-radius: 0.25em; color: #FFF; margin: 0 0 1em; padding: 0.5em 0; text-align: center; }
         form:valid [type=submit] {
            background:#8b0000;
         }
         input[type=submit] {
            color: white;
         }
         .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width:10%;
         }
         img {
            width:60%;
            margin-left:auto;
            margin-right:auto;
            display: block;
         }

         body {
            margin-top:5%;
         }

         h1 {   background-color:lightgrey; padding-top:20px; padding-bottom:20px;   }

         table, tr, td {
            margin: 10px;
         }

         input{
            padding: 5px;
            margin: 10px;
         }

         .textBoxWidth{
            width: 100%;
         }

         label {

            margin: 5px;
         }

         .error{
            background: #F2DEDE;
            color: #A94442;
            padding: 10px;
            width: 95%;
            border-radius: 5px;
         }

         button:hover{
            opacity: .7;
         }

         button {
            background: #555;
            padding: 10px 15px;
            color: #fff;
            border-radius: 5px;
            margin: 10px;
            border: none;
         }

      </style>
   </head>

   <body>
      <center>
         <a href="../main_page.php">
            <img src="https://logodix.com/logo/89918.png" width="25%" height="25%"/>
         </a>
         <h1> Signup </h1>
      </center>

      <center>
         <fieldset>
            <form method="POST" action="registration.php">
               <table>
                  <tr>
                     <td>Title: </td>
                     <td>
                        <select name="customerTitle" style="margin-left: 10.5px; width: 50%; ">
                           <option></option>
                           <option value="Dr.">Dr.</option>
                           <option value="Mr.">Mr.</option>
                           <option value="Ms.">Ms.</option>
                           <option value="Mrs.">Mrs.</option>
                           <option value="Miss.">Miss.</option>
                        </select>
                     </td>
                  </tr>

                  <tr>
                     <td>Name: </td>
                     <td><input required class="textBoxWidth" type="text" name="customerName" placeholder="Enter your name."/></td>
                  </tr>

                  <tr>
                     <td>Email: </td>
                     <td><input required class="textBoxWidth" type="text" name="customerEmail" placeholder="Enter your email."/></td>
                  </tr>

                  <tr>
                     <td>Phone: </td>
                     <td><input required class="textBoxWidth" type="text" name="customerPhone" placeholder="Enter your contact number.."/></td>
                  </tr>

                  <tr>
                     <td>Company: </td>
                     <td><input class="textBoxWidth" type="text" name="customerCompany" placeholder="Enter your company name. (Optional)"/></td>
                  </tr>
                  <tr>
                     <td>Country: </td>
                     <td><input required class="textBoxWidth" type="text" name="customerCountry" placeholder="Enter your country."/></td>
                  </tr>

                  <tr>
                     <td>Postal Code: </td>
                     <td><input required class="textBoxWidth" type="text" name="customerPostalCode" placeholder="Enter your postal code."/></td>
                  </tr>

                  <tr>
                     <td>City: </td>
                     <td><input required class="textBoxWidth" type="text" name="customerCity" placeholder="Enter your city."/></td>
                  </tr>

                  <tr>
                     <td>State: </td>
                     <td><input required class="textBoxWidth" type="text" name="customerState" placeholder="Enter your state."/></td>
                  </tr>

                  <tr>
                     <td>Address: </td>
                     <td><input required class="textBoxWidth" type="text" name="customerAddress" placeholder="Enter your address."/></td>
                  </tr>

                  <tr>
                     <td>Password: </td>
                     <td><input required class="textBoxWidth" type="text" name="customerPassword" placeholder="Enter your password."/></td>
                  </tr>
               </table>

               <ul class="list">
                  <li><input style="margin-left: 100%;" type="submit" name="submit" value="Signup" /></li>
               </ul>

               <?php

                  if(isset($_POST['submit'])) {
                     // declaring the database linking variables
                     $name = "localhost";
                     $uname = "root";
                     $password = "";
                     $db_name = "group_assignment";

                     // declaring connection
                     $connection = mysqli_connect($name, $uname, $password, $db_name);

                     // fetching values from form
                     $customerTitle = $_POST["customerTitle"];
                     $customerName = $_POST["customerName"];
                     $customerEmail = $_POST["customerEmail"];
                     $customerPhone = $_POST["customerPhone"];
                     $customerCompany = $_POST["customerCompany"];
                     $customerCountry = $_POST["customerCountry"];
                     $customerPostalCode = $_POST["customerPostalCode"];
                     $customerCity = $_POST["customerCity"];
                     $customerState = $_POST["customerState"];
                     $customerAddress = $_POST["customerAddress"];
                     $customerPassword = $_POST["customerPassword"];

                     // construct insertion $query
                     $query = "INSERT INTO customers (`CustomerID`, `Title`, `Name`, `Email`, `Phone`, `Company`, `Country`, `PostalCode`, `City`, `State`, `Address`, `Status`, `Comments`, `Password`) values (
                        '',
                        '$customerTitle',
                        '$customerName',
                        '$customerEmail',
                        '$customerPhone',
                        '$customerCompany',
                        '$customerCountry',
                        '$customerPostalCode',
                        '$customerCity',
                        '$customerState',
                        '$customerAddress',
                        'TRUSTED',
                        '',
                        '$customerPassword')";

                        $result = mysqli_query($connection, $query);

                        if($result>0) {
                           echo "<center><h3>Successfully Registered</h3>";
                  		} else {
                  		   echo "<center><h3>Registration Failed!</h3></center>";
                           echo mysqli_error($connection);
                        }

                        mysqli_close($connection);
                     }
                  ?>
               </form>
            <a href='customer_login.php'>Already have an account?</a>
         </fieldset>
      </center>
   </center>
   </body>
</html>
