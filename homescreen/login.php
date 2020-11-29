<?php
	session_start();
	include "db_conn.php";

	if(isset($_POST['staff_id']) && isset($_POST['staff_password'])) {

		function validate($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}

		$staff_id = validate($_POST['staff_id']);
		$pass = validate($_POST['staff_password']);

		if (empty($staff_id)) {
			header("Location: staff_login.php?error=Staff ID is required");
		    exit();

		}else if(empty($pass)){
	        header("Location: staff_login.php?error=Password is required");
		    exit();

		}else{
			$staff_id = strtoupper($staff_id);
			$sql = "SELECT * FROM staff WHERE StaffID = '$staff_id' AND Password = '$pass'";
			$result = mysqli_query($conn, $sql);

			if(mysqli_num_rows($result) === 1){
				$row = mysqli_fetch_assoc($result);

				if($row['StaffID'] === $staff_id && $row['Password'] === $pass){

					$_SESSION['position'] = $row['Position'];
					$_SESSION['name'] = $row['Name'];

					header("Location: homescreen.php");
					exit();
				}

			} else {
				header("Location: staff_login.php?error=Incorrect Staff ID or Password!");
			}
		}

	}else{
		header("Location: staff_login.php");
		exit();
	}
?>
