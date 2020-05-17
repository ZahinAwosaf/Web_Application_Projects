
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
			justify-content: center;
			align-items: center;
			background-color: #88DCD7;
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
		}
		#form-login li label a {
			color: white;
		}
		#error {
			color: red;
			margin-top: 5px;
		}
	</style>
</head>
<body>
<div id="main">
	<div id="login">
		<form action="forget_pasword.php" method="POST" id="form-page">
			<ul id="form-login">
				<li>
					<label id="header-login">Forget Password</label>
				</li>
				<li>
					<label>Email</label>
					<input type="email" name="email" required="" class="text">
				</li>
				
				<li>
					<input type="submit" name="submit" id="btn">
				</li>
				<li>
					<label><a href="index.php">Login</a></label>
					<label><a href="registration.php">Regisration</a></label>
				</li>
			</ul>
		</form>
	</div>
</div>
</body>
</html>
