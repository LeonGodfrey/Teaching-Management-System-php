
<?php
session_start();

if(isset($_POST['submit'])){
  
$email = $_POST['email'];
$password1 = md5($_POST['password']);

include 'connection.php'; //includes the connection file

$select = "SELECT * FROM person WHERE personEmail = '$email' AND personPassword = '$password1' AND personRole = 'Admin'";

$sql_query = mysqli_query($conn, $select);
$count=mysqli_num_rows($sql_query);
if ($count > 0){
	$rows = mysqli_fetch_assoc($sql_query);
$_SESSION['adminId'] = $rows['personId'];
  header("Location: adminDashboard.php"); //take me to dashboard
}else{
  // echo mysqli_error($conn);
	echo '
	<h2 align="center" style{ color: darkred;}>Wrong Passwor or Email! Please try again.</h2>	';
}

}

?>

<!DOCTYPE html PUBLIC "-//w3c//DTD XHTML 1.1//EN""
 http//www.w3.org/TR/xtml 11/DTD/xhtml 11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	
<head>
	<title>Admin LogIn</title>
	<link rel="stylesheet" type="text/css" href="style1.css">
</head>

<body class="Abody">
	<div class="Aheader">
	<h2>Admin LogIn</h2>
</div>

<form method="post" action="" class="Aform">
	<div class="input-groupA">
		<label>Admin Email</label>
		<input type="text" name="email">

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




</form>

</body>
</html>