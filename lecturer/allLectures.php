<?php  include 'connection.php'; //includes the connection file 
session_start();
$lecturerId = $_SESSION['lecturerId'];
?>

<!DOCTYPE html PUBLIC "-//w3c//DTD XHTML 1.1//EN""
 http//www.w3.org/TR/xtml 11/DTD/xhtml 11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<title>All lectures</title>

<link href="style.css" rel="stylesheet" type="text/css">
<link href="app.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.css" rel="stylesheet" />

</head>

<?php include 'header.php';?>  
      <div class="main" >

     

        <!-- the display table starts here -->

        <div style="width: 100%; padding:30px;">
          <h2 align="center">All your Lectures</h2>
          
        <table style="width: 100%; text-align: center; " border="1" >

<?php

//select php
$retreive = "SELECT * FROM lecture where personId = '$lecturerId'";
$sql_query = mysqli_query($conn, $retreive);
?>
          <tr>
                <th>#</th>
                <th>Day</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Course</th>
                <th>Lecturer</th>
                <th>Room</th>                               
                
          </tr>            
<?php 
$counter = 1;
while ($rows = mysqli_fetch_assoc($sql_query) ) {
?>
          <tr>
            <td><?php   echo $counter ?></td>
            <td><?php   echo $rows['lectureDay']; ?></td>
            <td><?php   echo $rows['plannedStartTime']; ?></td>
            <td><?php   echo $rows['plannedEndTime']; ?></td>
<?php
$PKID =  $rows['courseId'];
$retreive1 = "SELECT * FROM course where courseId = '$PKID'";
$sql_query1 = mysqli_query($conn, $retreive1);
$rows1 = mysqli_fetch_assoc($sql_query1);
 ?>
            <td><?php   echo $rows1['courseName']; ?></td> 
<?php  
$PKID1 =  $rows['personId'];
$retreive2 = "SELECT * FROM person where personId = '$PKID1'";
$sql_query2 = mysqli_query($conn, $retreive2);
$rows2 = mysqli_fetch_assoc($sql_query2);
 ?>
            <td><?php   echo $rows2['personName']; ?></td>
<?php
$PKID2 =  $rows['roomId']; 
$retreive3 = "SELECT * FROM room where roomId = '$PKID2'";
$sql_query3 = mysqli_query($conn, $retreive3);
$rows3 = mysqli_fetch_assoc($sql_query3);
 ?>
            <td><?php   echo $rows3['roomName']; ?></td>              
          
          </tr> 
          <?php $counter++;  
          } 
          ?>  
        </table>
    </div>
 
    <!-- the display table ends here -->

    </div>
   
  </div>
  
  <div class="footer" style="height: 5vh;">
        <p align="center">Copyright &copy; To Infinity and Beyound. All rights reserved </p>
    </div>

</div>

</body>
</html>