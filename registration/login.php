<?php
	session_start();

   // declaring the database linking variables
   $name = "localhost";
   $uname = "root";
   $password = "";
   $db_name = "group_assignment";

   // declaring connection
   $connection = mysqli_connect($name, $uname, $password, $db_name);

	if(isset($_POST['customerEmail']) && isset($_POST['customerPassword'])) {

		function validate($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}

		$customerEmail = validate($_POST['customerEmail']);
		$customerPassword = validate($_POST['customerPassword']);

   	if (empty($customerEmail)) {
   		header("Location: customer_login.php?error=Email is required");
   	    exit();

   	}else if(empty($customerPassword)){
           header("Location: customer_login.php?error=Password is required");
   	    exit();

   	}else{
   		$query = "SELECT * FROM customers WHERE Email = '$customerEmail' AND Password = '$customerPassword'";
   		$result = mysqli_query($connection, $query);

   		if(mysqli_num_rows($result) === 1){
   			$row = mysqli_fetch_assoc($result);

   			if($row['Email'] === $customerEmail && $row['Password'] === $customerPassword){

   				$_SESSION['name'] = $row['Name'];
   				$_SESSION['status'] = $row['Status'];

   				header("Location: customer_homescreen.php");
   				exit();
   			}

   		} else {
   			header("Location: customer_login.php?error=Incorrect Staff ID or Password!");
   		}
	     }
   }else{
   	header("Location: customer_login.php");
   	exit();
   }
?>
