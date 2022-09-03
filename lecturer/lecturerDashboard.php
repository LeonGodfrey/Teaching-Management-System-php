<?php 
session_start();
if($_SESSION['lecturerId'] != ""){
  $lecturerId = $_SESSION['lecturerId'];

include 'connection.php'; //includes the connection file
//count lectures for today
$today = date('l');
$select = "SELECT * FROM lecture where personId = '$lecturerId' AND lectureDay = '$today' ";
$sql_query = mysqli_query($conn, $select);
$todaysLecture = mysqli_num_rows($sql_query);

//count lectures
$select1 = "SELECT * FROM lecture where personId = '$lecturerId'";
$sql_query1 = mysqli_query($conn, $select1);
$countLecture = mysqli_num_rows($sql_query1);

 ?>
<!DOCTYPE html PUBLIC "-//w3c//DTD XHTML 1.1//EN""
 http//www.w3.org/TR/xtml 11/DTD/xhtml 11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<title>Lecturer Dashboard</title>

<link href="style.css" rel="stylesheet" type="text/css">
<link href="app1.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.css" rel="stylesheet" />
</head>
<?php include 'header.php';?>
          <div class="main" >
            <h1>Your Dashboard</h1>
            <div class="man">            
                    <div class="room">
                      <h2>Todays Lectures</h2>
                      <h3 style="color: white; font-size: 80px; "><?php echo $todaysLecture; ?></h>
                    </div>    
                    <div class="lecture">
                       <h2>Total Lectures</h2> 
                        <h3 style="color: white; font-size: 80px; "><?php echo $countLecture; ?></h> 
                    </div>            
                    
            </div>            
          </div>
   
    </div>  
  
    <div class="footer" style="height: 5vh;">
        <p align="center">Copyright &copy; To Infinity and Beyound. All rights reserved </p>
    </div>
  </div>

</body>
</html>
<?php   }else{ header('Location: index.php');} ?>