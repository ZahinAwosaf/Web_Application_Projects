<?php
session_start();


if(isset($_SESSION["user_id"])) {
	header("location: homepage.php");
}


$error_msg = '';


if(isset($_POST["submit"])) {

	include('db_connection.php');
	$pass = $_POST["password"];


	$sql = "select * from user_info where email='".$_POST["email"]."'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();

	if ($result->num_rows > 0) {

		if($row["password"] == $pass) {

			$_SESSION["name"] = $row["name"];
			$_SESSION["email"] = $row["email"];
			$_SESSION["user_id"] = $row["user_id"];
			$_SESSION["dept_id"] = $row["dept_id"];
			$_SESSION["image"] = $row["image"];
			$_SESSION["aiub_id"] = $row["aiub_id"];


			$sql7 = "select name from department where dept_id=".$row["dept_id"];
			$result7 = $conn->query($sql7);
			$row7 = $result7->fetch_assoc();


			$_SESSION["dept_name"] = $row7["name"];

			date_default_timezone_set("Asia/Dhaka");
			$c_date = date('Y-m-d H:i:s');


			$sql = 'insert into login_details(user_id,last_activity) values('.$row["user_id"].',"'.$c_date.'")';
			$conn->query($sql);
			$sql = 'select login_id from login_details where user_id = "'.$row["user_id"].'" order by last_activity desc limit 1';
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
			$_SESSION["login_details_id"] = $row['login_id'];
			header("location: homepage.php");
		} else
			$error_msg = "Wrong Password!!!";
	} else
		$error_msg = "Wrong Email!!!";


	$conn->close(); 
}


?>






<!DOCTYPE html>
<html>
<head>
	<title>LogIn</title>
	<style type="text/css">
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}
		#main {
			height: 100vh;
			display: flex;
			justify-content: space-between;
			/*align-items: center;*/
			background-color: #88DCD7;
			padding: 50px;
		}
		#login {
			border-radius: 50px;
			padding: 20px;
			width: 400px;
			height: 450px;
			background-color: #00B3AA;
			display: flex;
			justify-content: center;
			align-items: center;
			align-self: center;
			box-shadow: 5px 5px 10px;
		}
		#form-login {
			list-style: none;
		}
		#form-login li {
			display: flex;
			flex-direction: column;
			justify-content: flex-end;
			margin-bottom: 30px;
		}
		#btn {
			width: 100px;
			align-self: flex-end;
			height: 30px;
			border-style: none;
			border: 1px solid #00B3AA;
			color: black;
		}
		#btn:hover {
			cursor: pointer;
		}
		.text {
			text-align: center;
			height: 30px;
			border-radius: 10px;
			border-style: none;
			border: 1px solid #00B3AA;
		}
		#form-login li label {
			margin-bottom: 10px;
			color: white;
		}
		#form-page {
			width: 100%;
			padding: 15px;
		}
		#header-login {
			font-size: 35px;
			margin-top: 40px;
			align-self: center;
			/*text-shadow: 1px 1px 1px;*/
		}
		#form-login li label a {
			color: white;
		}
		#error {
			color: red;
			margin-top: 5px;
		}
		#text-for-index {
			width: 50%;
		}
		#text-for-index h1 {
			font-size: 50px;
			color: white;
			font-weight: bold;
			background-color: #00B3AA;
			padding: 20px;
			border-radius: 15px;
			text-align: center;
		}
		#text-for-index p {
			color: white;
			background-color: #00B3AA;
			padding: 20px;
			margin-top: 50px;
			border-radius: 15px;
			text-align: justify;
			border: 1px solid white;
		}
	</style>
</head>
<body>
<div id="main">
	<div id="text-for-index">
		<h1>Welcome Aiub Gaggle</h1>
		<p>We are very happy to see you in here. We are very happy to see you in here. We are very happy to see you in here.We are very happy to see you in here.We are very happy to see you in here.We are very happy to see you in here.We are very happy to see you in here.We are very happy to see you in here.We are very happy to see you in here.We are very happy to see you in here.We are very happy to see you in here.We are very happy to see you in here.We are very happy to see you in here.We are very happy to see you in here.We are very happy to see you in here.We are very happy to see you in here.We are very happy to see you in here.We are very happy to see you in here.We are very happy to see you in here.We are very happy to see you in here.We are very happy to see you in here.We are very happy to see you in here.We are very happy to see you in here.We are very happy to see you in here.We are very happy to see you in here.We are very happy to see you in here.We are very happy to see you in here.We are very happy to see you in here.We are very happy to see you in here.We are very happy to see you in here.We are very happy to see you in here.We are very happy to see you in here.We are very happy to see you in here.We are very happy to see you in here.We are very happy to see you in here.We are very happy to see you in here.We are very happy to see you in here.We are very happy to see you in here.We are very happy to see you in here.We are very happy to see you in here.We are very happy to see you in here.We are very happy to see you in here.We are very happy to see you in here.We are very happy to see you in here.We are very happy to see you in here.We are very happy to see you in here.We are very happy to see you in here.We are very happy to see you in here.</p>
	</div>
	<div id="login">
		<form action="index.php" method="POST" id="form-page">
			<ul id="form-login">
				<li>
					<label id="header-login">Login</label>
				</li>
				<li>
					<label>Email</label>
					<input type="email" name="email" required="" class="text">
				</li>
				<li>
					<label>Password</label>
					<input type="password" name="password" required="" class="text">
					<p id="error"><?php echo $error_msg; ?></p>
				</li>
				<li>
					<input type="submit" name="submit" id="btn">
				</li>
				<li>
					<label><a href="forget_password.php">Forget Password</a></label>
					<label><a href="registration.php">Regisration</a></label>
				</li>
			</ul>
		</form>
	</div>
</div>
</body>
</html>
