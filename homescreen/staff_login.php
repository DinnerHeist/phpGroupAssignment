<!DOCTYPE html>
<html>
	<head>

		<style>

			label {

				margin: 5px;
			}

			input {

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

			body{
				background-image: url("dhl_wallpaper_2.jpg");
				height: 600px; /* You must set a specified height */
            background-position: center; /* Center the image */
            background-repeat: no-repeat; /* Do not repeat the image */
            background-size: cover;
			}

			h1 {   background-color:lightgrey; padding-top:20px; padding-bottom:20px;   }

		</style>

	</head>

	<body>
		<?php session_start();?>
		<div>
			<center>
				<a href="../main_page.php">
					<img src="https://logodix.com/logo/89918.png" width="25%" height="25%"/>
				</a>

				<h1> Management Login </h1>
			</center>
		</div>

		<center>
			<div style="background-color: #fff; width: 50%; float: right; display: inline-block; margin-right: 25%; margin-left: auto; ">
				<form style = "margin: 10px;" action="login.php" method="POST">
					<?php if (isset($_GET['error'])) { ?>
					<p class="error"><?php echo $_GET['error']; ?></p>
					<?php } ?>

					<table>
						<tr>
							<td><label> Staff ID: </label></td>
							<td><input type = "text" name = "staff_id" placeholder = "Staff ID" required><br></td>
						</tr>
						<tr>
							<td><label> Password: </label></td>
							<td><input type = "password" name = "staff_password" placeholder = "Password" required></td>
						</tr>
					</table>
					<button type = "submit"> Login </button>
				</form>
			</div>
		</center>
	</body>
</html>
