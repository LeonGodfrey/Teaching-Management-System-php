<?php 
session_start();
if($_SESSION['adminId'] != ""){

include 'connection.php'; //includes the connection file
//count lectures
$select = "SELECT * FROM person where personRole = 'lecturer'";
$sql_query = mysqli_query($conn, $select);
$countLecturer = mysqli_num_rows($sql_query);

//count lectures
$select1 = "SELECT * FROM lecture";
$sql_query1 = mysqli_query($conn, $select1);
$countLecture = mysqli_num_rows($sql_query1);

//count rooms
$select3 = "SELECT * FROM room";
$sql_query3 = mysqli_query($conn, $select3);
$countRoom = mysqli_num_rows($sql_query3);
 ?>

<!DOCTYPE html PUBLIC "-//w3c//DTD XHTML 1.1//EN""
 http//www.w3.org/TR/xtml 11/DTD/xhtml 11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<title>Admin Dashboard</title>

<link href="style.css" rel="stylesheet" type="text/css">
<link href="app1.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.css" rel="stylesheet" />
</head>
<?php include 'header.php'; ?>
          <div class="main" >
          <?php
          $personId1 = $_SESSION['adminId']; 
         
          $select9 = "SELECT * FROM person where personId = '$personId1'";
          $sql_query9 = mysqli_query($conn, $select9);
          $rows9 = mysqli_fetch_assoc($sql_query9);
          ?>
            <h1> <?php echo $rows9['personName'];?> Dashboard</h1>
            <div class="man">            
                    <div class="room">
                      <h2>Total Rooms</h2>
                    
                      <h3 style="color: white; font-size: 80px; "><?php echo $countRoom; ?></h>
                    </div>    
                    <div class="lecture">
                        
                       <h2>Total Lectures</h2> 
                        <h3 style="color: white; font-size: 80px; "><?php echo $countLecture; ?></h> 
                    </div>            
                    <div class="lecturer">
                       <h2>Total Lecturers</h2> 
                        <h3 style="color: white; font-size: 80px; "><?php echo $countLecturer; ?></h>                   
                    </div>
            </div>            
          </div>
   
    </div>  
  
    <div class="footer" style="height: 5vh;">
        <p align="center" style ="color:darkgreen;">Copyright &copy; To Infinity and Beyound. All rights reserved </p>
    </div>
  </div>

</body>
</html>
<?php   }else{ header('Location: ../index.php');} ?>