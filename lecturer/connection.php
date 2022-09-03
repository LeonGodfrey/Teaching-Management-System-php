<?php 
date_default_timezone_set("Africa/Kampala");//setting the timezone to local time zone
$host = "localhost";
$username = "root";
$password = "";
$DBname = "teachingms";

$conn = mysqli_connect($host, $username, $password, $DBname);

if( $conn == true) {
	// echo "successful";
}else{
	echo mysqli_error($conn);
}

 ?>

 