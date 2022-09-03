
<?php 
session_start();
if($_SESSION['lecturerId'] != ""){
   include 'connection.php'; //includes the connection file 
?>

<!DOCTYPE html PUBLIC "-//w3c//DTD XHTML 1.1//EN""
 http//www.w3.org/TR/xtml 11/DTD/xhtml 11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<title>report</title>

<link href="style.css" rel="stylesheet" type="text/css">
<link href="app.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.css" rel="stylesheet" />

</head>
<?php include 'header.php';?>
    
        <div style="width: 100%; padding:30px;">
          

<?php 
if(isset($_POST['submit'])){
	$week = $_POST['week'];

$personId = $_SESSION['lecturerId'];

//select from person
$selectP = "SELECT personName FROM person where personId = '$personId'";
$sql_queryP = mysqli_query($conn, $selectP);
$rowsP = mysqli_fetch_assoc($sql_queryP);
?>
	<h2 align="center">Lectures Taught and Missed by <?php echo $rowsP['personName']; ?></h2>
	<button><a href="report.php">Back</a></button>
  <h1>Lectures Taught</h1>
	<table style="width: 100%; text-align: center; " border="1" >

<?php

//select from taught 
$selectT = "SELECT * FROM taught where personId = '$personId' AND week = '$week'" ;
$sql_queryT = mysqli_query($conn, $selectT);

?>
	
	 <tr>
                <th>#</th>
                <th>Date</th>
                <th>Day</th>
                <th>Started at</th>
                <th>Ended at</th>
                <th>Course</th>                
                <th>Room</th>                           
                
          </tr>            
<?php 
$totalLectures = 0; 
$counter1 = 1;
$taughtL = array();
while ($rowsT = mysqli_fetch_assoc($sql_queryT) ) {
?>
          <tr>
            <td><?php   echo $counter1 ?></td>
            <td><?php   echo $rowsT['dateTaught']; ?></td>
            <td><?php   echo $rowsT['dayTaught']; ?></td>
            <td><?php   echo $rowsT['startTime']; ?></td>
            <td><?php   echo $rowsT['endTime']; ?></td>
<?php

//select from lecture
$lectureId = $rowsT['lectureId'];
$selectL = "SELECT * FROM lecture where lectureId = '$lectureId' " ;
$sql_queryL = mysqli_query($conn, $selectL);
$rowsL = mysqli_fetch_assoc($sql_queryL);

$PKID =  $rowsL['courseId'];
$retreive1 = "SELECT * FROM course where courseId = '$PKID'";
$sql_query1 = mysqli_query($conn, $retreive1);
$rows1 = mysqli_fetch_assoc($sql_query1);
 ?>
            <td><?php   echo $rows1['courseName']; ?></td> 

<?php
//select from lecture
$lectureId = $rowsT['lectureId'];
$selectL = "SELECT * FROM lecture where lectureId = '$lectureId' " ;
$sql_queryL = mysqli_query($conn, $selectL);
$rowsL = mysqli_fetch_assoc($sql_queryL);

$PKID2 =  $rowsL['roomId'];
$retreive3 = "SELECT * FROM room where roomId = '$PKID2'";
$sql_query3 = mysqli_query($conn, $retreive3);
$rows3 = mysqli_fetch_assoc($sql_query3);
 ?>
            <td><?php   echo $rows3['roomName']; ?></td>           
           
          </tr> 
          <?php
          $totalLectures = $counter1; 

           $counter1++; 
          array_push($taughtL, $rowsT['lectureId']); 
          
          }?> 
           <tr>
            <th colspan="6">Total lectures Taught</th>
            <td><?php echo $totalLectures; ?></td>
          </tr>
           
        </table>
        <?php //echo $taughtL[0];  ?>

<!-- Not taught lectures -->
<h1>Lectures Not Taught</h1>
 <table style="width: 100%; text-align: center; " border="1" >

<?php

//select from lecture
$retreiveLec = "SELECT * FROM lecture where personId = '$personId'";
$sql_queryLec = mysqli_query($conn, $retreiveLec);
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
$counter2 = 1;
$totalLectures1 = 0; 
while ($rowsLec = mysqli_fetch_assoc($sql_queryLec) ) {
  if(in_array($rowsLec['lectureId'], $taughtL)){
    continue;
  }
?>
          <tr>
            <td><?php   echo $counter2 ?></td>
            <td><?php   echo $rowsLec['lectureDay']; ?></td>
            <td><?php   echo $rowsLec['plannedStartTime']; ?></td>
            <td><?php   echo $rowsLec['plannedEndTime']; ?></td>
<?php
$PKID2 =  $rowsLec['courseId'];
$retreive12 = "SELECT * FROM course where courseId = '$PKID2'";
$sql_query12 = mysqli_query($conn, $retreive12);
$rows12 = mysqli_fetch_assoc($sql_query12);
 ?>
            <td><?php   echo $rows12['courseName']; ?></td> 
<?php  
$PKID13 =  $rowsLec['personId'];
$retreive23 = "SELECT * FROM person where personId = '$PKID13'";
$sql_query23 = mysqli_query($conn, $retreive23);
$rows23 = mysqli_fetch_assoc($sql_query23);
 ?>
            <td><?php   echo $rows23['personName']; ?></td>
<?php
$PKID24 =  $rowsLec['roomId']; 
$retreive34 = "SELECT * FROM room where roomId = '$PKID24'";
$sql_query34 = mysqli_query($conn, $retreive34);
$rows34 = mysqli_fetch_assoc($sql_query34);
 ?>
            <td><?php   echo $rows34['roomName']; ?></td>         
            
          </tr> 
          <?php
          $totalLectures1 = $counter2;

          $counter2++;  
           
          }?>  
          <tr>
            <th colspan="6">Total lectures Missed</th>
            <td><?php echo $totalLectures1; ?></td>
          </tr>
           
        </table>

<?php }else{ ?>

			<center><h2>Teaching Report</h2></center>
         	 <div class="headerA">
        		<h2>Select Week</h2>
		      </div>
		        <form method="post" action="" class="form">
		      
		            <div class="input-groupA">
		              <label>Semester Week Report</label>              
		              <select name="week" >  
		               <center> <option>Select Week of the Semester</option></center>
		                <option>1</option>
		                <option>2</option>
		                <option>3</option>
		                <option>4</option>
		                <option>5</option>
		                <option>6</option>
		                <option>7</option>
		                <option>8</option>
		                <option>9</option>
		                <option>10</option>
		                <option>11</option>
		                <option>12</option>
                    <option>13</option>
                    <option>14</option>
                    <option>15</option>
		              </select>
		           </div>
		           <div class="input-groupA">
            		<button type="submit" name="submit" class="btnA">Submit</button>
          			</div>  
		        </form>
<?php }  ?>

   			</div>  

    </div>
   
  </div>
  
  <div class="footer" style="height: 5vh;">
        <p align="center">Copyright &copy; To Infinity and Beyound. All rights reserved </p>
    </div>

</div>

</body>
</html>
<?php   }else{ header('Location: ../index.php');} ?>