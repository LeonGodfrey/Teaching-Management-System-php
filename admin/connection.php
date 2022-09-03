<?php 
date_default_timezone_set("Africa/Kampala");//setting the timezone to local time zone
$host = "localhost";
$username = "admin";
$password = "admin";
$DBname = "tms";

$conn = mysqli_connect($host, $username, $password, $DBname);

if( $conn == true) {
	 //echo "successful";
}else{
	echo mysqli_error($conn);
}

 ?>

 