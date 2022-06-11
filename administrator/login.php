<?php
require('connection.php');
$now=date("Y-m-d H:i:s");
if(isset($_POST['submit']))
{
	$username 			= $_POST['username'];
	$password 			= $_POST['password'];
	if($username=="")
	{
		$msg_username 	= "Username is required";
	}
	if($password=="")
	{
		$msg_password 	= "Password is required";
	}
	if($username!=""&&$password!="")
	{
		$pass 			= md5($password);
		if($username!='developer')
		{	
			$query 			= mysqli_query($con,"SELECT * from admin WHERE username='$username' AND password='$pass' AND visible='Y'");
		}
		else
		{
			$query 			= mysqli_query($con,"SELECT * from admin WHERE username='$username' AND password='$pass'");
		}	
		$sum_query 			= mysqli_num_rows($query);
		if($sum_query>0)
		{
			$update 		= mysqli_query($con,"UPDATE admin SET last_login='$now' WHERE username='$username' AND password='$pass'");
			$_SESSION["username"] = $username;
			header("location: index.php?p=admin");
		}
		else
		{
			$msg 		= "The username or password is incorrect";
		}	

	}	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	<title>Laksana Administrator</title>
	<!-- Favicon
	<link rel="icon" href="assets/images/laksana/icomoon.woff2" type="image/x-icon">-->
	<!-- Plugins Core Css -->
	<link href="assets/css/app.min.css" rel="stylesheet">
	<!-- Custom Css -->
	<link href="assets/css/style.css" rel="stylesheet" />
	<link href="assets/css/pages/authentication.css" rel="stylesheet" />
</head>

<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="POST" action="">
					<span class="login100-form-title p-b-45">
						Administrator
					</span>
					<center><?php if(isset($msg)){ ?><font color="red"><?php echo $msg ?></font><?php } ?></center>
					<div class="wrap-input100 validate-input" data-validate="Username is required">
						<font color="rgb(41, 41, 43)">&nbsp&nbsp&nbsp Username
						<input class="input100" type="text" name="username"></font>
					</div>
					<?php if(isset($msg_username)){ ?><font color="red"><?php echo $msg_username ?></font><?php } ?>

					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<font color="rgb(41, 41, 43)">&nbsp&nbsp&nbsp Password
						<input class="input100" type="password" name="password"></font>
					</div>
					<?php if(isset($msg_password)){ ?><font color="red"><?php echo $msg_password ?></font><?php } ?>

					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn" name="submit" value="submit">Login</button>
					</div>
				</form>

				<div class="login100-more" style="background-image: url('assets/images/laksana/logo-laksana.png');background-size: 80%;">
				</div>
			</div>
		</div>
	</div>

	<!-- Plugins Js -->

	<script src=assets/js/app.min.js"></script>

	<!-- Extra page Js -->
	<script src="assets/js/pages/examples/pages.js"></script>

</body>

</html>