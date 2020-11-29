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
         background-color: #FF0000;
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
         width: 350px;
         margin:auto;
         background-color:white;
         }

         body{
            font-size:20px;
            font-family:calibri;
            background-image:url('city.jpg');
            height: 500px; /* You must set a specified height */
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

      <?php session_start(); ?>
      <center>
         <a href="../main_page.php">
            <img src="https://logodix.com/logo/89918.png" width="25%" height="25%"/>
         </a>

         <h1> Login </h1>
      </center>

      <center>

         <?php if (isset($_GET['error'])) { ?>
         <p class="error"><?php echo $_GET['error']; ?></p>
         <?php } ?>

         <fieldset>
            <form method="POST" action="login.php">

               <table>
                  <tr>
                     <td>Email: </td>
                     <td><input  class="textBoxWidth" type="text" name="customerEmail" placeholder="Enter your email."/></td>
                  </tr>

                  <tr>
                     <td>Password: </td>
                     <td><input  class="textBoxWidth" type="password" name="customerPassword" placeholder="Enter your Password."/></td>
                  </tr>
               </table>

               <a style="margin: 8px;" href="registration.php">Sign Up Now!</a><br />
               <ul class="list">
                  <li><input style="margin: 8px;" type="submit" name="submit" value="Login" /></li>
               </ul>
            </form>
         </fieldset>

         <?php
            session_unset();
            session_destroy();
         ?>
   </body>
</html>
