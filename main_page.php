<!DOCTYPE HTML>

<html>
   <head>
      <style>
         .button {
            border-radius: 4px;
            background-color: #f4511e;
            border: none;
            color: #FFFFFF;
            text-align: center;
            font-size: 32px;
            padding: 5px;
            width: 240px;
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

         h1 {   background-color:lightgrey; padding-top:20px; padding-bottom:20px; width: 80}

         body{
            background-image: url("dhl_wallpaper.jpg");
            height: 720px; /* You must set a specified height */
            background-position: center; /* Center the image */
            background-repeat: no-repeat; /* Do not repeat the image */
            background-size: cover;
         }

         .background_card_left {
            background-color: #fff;
            border: none;
            color: white;
            padding: 16px 32px;
            margin: 4px 2px;
            opacity: 0.6;
            transition: 0.3s;
            float: left;
            border: solid black 1px;
            width: 30%;
            height: 800px;
            margin-left: 15%;
            margin-top: 2%;
            background-image: url("client.jpg");
            background-repeat: no-repeat;
            background-size: cover;
         }

         .background_card_right {
            background-color: #fff;
            border: none;
            color: white;
            padding: 16px 32px;
            margin: 4px 2px;
            opacity: 0.6;
            transition: 0.3s;
            float: right;
            border: solid black 1px;
            width: 30%;
            height: 800px;
            margin-right: 15%;
            margin-top: 2%;
            background-image: url("management.jpg");
            background-repeat: no-repeat;
            background-size: cover;
         }

         .background_card_left:hover {opacity: 1}
         .background_card_right:hover {opacity: 1}

      </style>
   </head>

   <!--this page was created by member: Siew Joe Kane-->
   <!--As a starting page for both the client and management-->
   <body>

      <?php
         if(isset($_POST['client'])) {
            header("Location: registration/customer_login.php");
         } else if(isset($_POST['management'])) {
            header("Location: homescreen/staff_login.php");
         }
      ?>

      <center>
         <img src="https://logodix.com/logo/89918.png" style="height: 25%; width: 25%; "/>
         <h1>Welcome to myDHL</h1>
      </center>

      <form action="main_page.php" method="POST">
         <div class="background_card_left">
            <center>
               <button name="client" class="button" style="margin-top: 100%; "><span>Client</span></button>
            </center>
         </div>

         <div class="background_card_right">
            <center>
               <button name="management" class="button" style="margin-top: 100%; "><span>Management</span></button>
            </center>
         </div>
      </form>
   </body>
</html>
