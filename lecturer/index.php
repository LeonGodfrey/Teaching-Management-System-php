
<?php
session_start();

if(isset($_POST['submit'])){
  
$email = $_POST['email'];
$password1 = md5($_POST['password']);

include 'connection.php'; //includes the connection file

$select = "SELECT * FROM person WHERE personEmail = '$email' AND personPassword = '$password1' AND personRole = 'lecturer'";

$sql_query = mysqli_query($conn, $select);
$count = mysqli_num_rows($sql_query);
if ($count > 0){
	$rows = mysqli_fetch_assoc($sql_query);
$_SESSION['lecturerId'] = $rows['personId'];
  header("Location: lecturerDashboard.php"); //take me to dashboard
}else{
  // echo mysqli_error($conn);
	echo '
	<h3 align="center" style{ color: red;}>Wrong Passwor or Email! Please try again.</h2>	';
}

}

?>


<!DOCTYPE html PUBLIC "-//w3c//DTD XHTML 1.1//EN""
 http//www.w3.org/TR/xtml 11/DTD/xhtml 11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Lecturer LogIn</title>
	<link rel="stylesheet" type="text/css" href="style1.css">
</head>

<body class="Abody">
	<div class="Aheader">
	<h2> LogIn</h2>
</div>

<form method="post" action="" class="Aform">
	<div class="input-groupA">
		<label> Email</label>
		<input type="email" name="email">

	</div>
	<div class="input-groupA">
		<label>Password</label>
		<input id="myInput" type="Password" name="password"></div>
		<div>
			<label>
		<center><input id ="myInput"type="checkbox" onclick="myFunction()">Show Password
</center></label> 
        </div>
	<script>
	  function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
	x.type = "text";
  } else {
	x.type = "password";
  }
} 
	</script>

	<div class="input-groupA">
		<button type="submit" name="submit" class="btnA"> Login</button>
 	</div>
	<p>
			Don't have an account? 
			<a href="lecturerSignup.php">Sign up </a>
	</p>

</form>

</body>
</html>