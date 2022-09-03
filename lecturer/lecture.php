<?php 

session_start();
if($_SESSION['lecturerId'] != ""){
  $lecturerId = $_SESSION['lecturerId'];
   include 'connection.php'; //includes the connection file 
?>

<?php
if(array_key_exists('startLecture', $_REQUEST) == true or array_key_exists('endLecture', $_REQUEST) == true){ 

  $date = date('Y-m-d');
  $week = "";
  $day = date('l');
  $start = date('H:i');
  
$retreive1 = "SELECT * FROM semester";
$sql_query1 = mysqli_query($conn, $retreive1);
$row = mysqli_fetch_assoc($sql_query1);

//================= selecting week ==============================

$startdate1T = strtotime($row['startDate']);
$startdate1 = date('Y-m-d', $startdate1T);
$enddate1T = strtotime("+1 weeks", $startdate1T);//time stamp
$enddate1 = date('Y-m-d', $enddate1T);//real date
if($date >= $startdate1 and $date < $enddate1 ){
  $week = "1";}

$enddate2T = strtotime("+1 weeks", $enddate1T);//time stamp
$enddate2 = date('Y-m-d', $enddate2T);//real date
if($date >= $enddate1 and $date < $enddate2 ){
  $week = "2";}

$enddate3T = strtotime("+1 weeks", $enddate2T);//time stamp
$enddate3 = date('Y-m-d', $enddate3T);//real date
if($date >= $enddate2 and $date < $enddate3 ){
  $week = "3";}

$enddate4T = strtotime("+1 weeks", $enddate3T);//time stamp
$enddate4 = date('Y-m-d', $enddate4T);//real date
if($date >= $enddate3 and $date < $enddate4 ){
  $week = "4";}

$enddate5T = strtotime("+1 weeks", $enddate4T);//time stamp
$enddate5 = date('Y-m-d', $enddate5T);//real date
if($date >= $enddate4 and $date < $enddate5 ){
  $week = "5";}

$enddate6T = strtotime("+1 weeks", $enddate4T);//time stamp
$enddate6 = date('Y-m-d', $enddate6T);//real date
if($date >= $enddate5 and $date < $enddate6 ){
  $week = "6";}

$enddate7T = strtotime("+1 weeks", $enddate6T);//time stamp
$enddate7 = date('Y-m-d', $enddate7T);//real date
if($date >= $enddate6 and $date < $enddate7 ){
  $week = "7";}

$enddate8T = strtotime("+1 weeks", $enddate7T);//time stamp
$enddate8 = date('Y-m-d', $enddate8T);//real date
if($date >= $enddate7 and $date < $enddate8 ){
  $week = "8";}

$enddate9T = strtotime("+1 weeks", $enddate8T);//time stamp
$enddate9 = date('Y-m-d', $enddate9T);//real date
if($date >= $enddate8 and $date < $enddate9 ){
  $week = "9";}

$enddate10T = strtotime("+1 weeks", $enddate9T);//time stamp
$enddate10 = date('Y-m-d', $enddate10T);//real date
if($date >= $enddate9 and $date < $enddate10 ){
  $week = "10";}

$enddate11T = strtotime("+1 weeks", $enddate10T);//time stamp
$enddate11 = date('Y-m-d', $enddate11T);//real date
if($date >= $enddate10 and $date < $enddate11 ){
  $week = "11";}

$enddate12T = strtotime("+1 weeks", $enddate11T);//time stamp
$enddate12 = date('Y-m-d', $enddate12T);//real date
if($date >= $enddate11 and $date < $enddate12 ){
  $week = "12";}

$enddate13T = strtotime("+1 weeks", $enddate12T);//time stamp
$enddate13 = date('Y-m-d', $enddate13T);//real date
if($date >= $enddate12 and $date < $enddate13 ){
  $week = "13";}

$enddate14T = strtotime("+1 weeks", $enddate13T);//time stamp
$enddate14 = date('Y-m-d', $enddate14T);//real date
if($date >= $enddate13 and $date < $enddate14){
  $week = "14";}

$enddate15T = strtotime("+1 weeks", $enddate14T);//time stamp
$enddate15 = date('Y-m-d', $enddate15T);//real date
if($date >= $enddate14 and $date < $enddate15 ){
  $week = "15";}

$enddate16T = strtotime("+1 weeks", $enddate15T);//time stamp
$enddate16 = date('Y-m-d', $enddate16T);//real date
if($date >= $enddate15 and $date < $enddate16 ){
  $week = "16";}
  
  //================================================================================ 


  

  // insert starts here
if(isset($_REQUEST['startLecture'])){

$lecId = $_REQUEST['startLecture'];  
 
  $insert = "INSERT INTO `taught` (`dateTaught`, `dayTaught`, `startTime`, `week`, `lectureId`, `personId`) VALUES ('$date', '$day', '$start', '$week', '$lecId', '$lecturerId')";
  $sql_query = mysqli_query($conn, $insert);
  if ($sql_query == true){
    echo "";  
    //header('Location: lecture.php');
  }else{
    echo mysqli_error($conn);
  }
  }
//insert ends here

if(isset($_REQUEST['endLecture'])){
$lecId = $_REQUEST['endLecture'];
$end = date('H:i');

//get taught id
$retreive1 = "SELECT * FROM taught where lectureId = '$lecId' and week = '$week'";
$sql_query1 = mysqli_query($conn, $retreive1);
$row = mysqli_fetch_assoc($sql_query1);
$taughtId = $row['taughtId'];

$update = "UPDATE `taught` SET `endTime` = '$end' WHERE `taught`.`taughtId` = '$taughtId'";
  $sql_query = mysqli_query($conn, $update);
  if ($sql_query == true){
    echo "";  
    //header('Location: lecture.php');
  }else{
    echo mysqli_error($conn);
  }
  
}  

}
 
?>
<!DOCTYPE html PUBLIC "-//w3c//DTD XHTML 1.1//EN""
 http//www.w3.org/TR/xtml 11/DTD/xhtml 11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<title>lectures</title>

<link href="style.css" rel="stylesheet" type="text/css" />
<link href="app.css" rel="stylesheet" type="text/css" />
<link href="css/font-awesome.css" rel="stylesheet" />

</head>

<?php include 'header.php';?> 
      <div class="main" >

     
        <!-- the display table starts here -->

        <div style="width: 100%; padding:30px;">
          <h2 align="center">Today's Lectures</h2>
          
        <table style="width: 100%; text-align: center; " border="1" >

<?php

//select php
$today = date('l');
$retreive = "SELECT * FROM lecture where personId = '$lecturerId' AND lectureDay = '$today'";
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
                <th>Action</th>
                <th>Action</th>
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
            <!-- to trigger an action ?delete=PK -->
            <td style="background-color: forestgreen;">
            
            <a href="#?startLecture=<?php  echo $rows['lectureId'];  ?>" id="myButton1" onclick="timer();swap();end();">start</a>

            <td style="background-color: forestgreen;"> 
           
        <a href="#?endLecture=<?php   echo $rows['lectureId'];?>" onclick="stop();swap();end();end2();"  
        id="myButton2">End</a>

          </tr> 
          <?php $counter++;
          } 
          ?>  
        </table>
    </div>
  
    <!-- the display table ends here -->
    <script>
            function end(){
                var x = document.getElementById("myButton1");
                if( x.textContent ==="start"){
                   x.textContent ="ongoing...";
                        }  
                    else {
                        x.textContent="Ended";
                        
                    }  }
            
        </script>
         <script>
            function end2(){
                var x = document.getElementById("myButton2");
                if( x.textContent ==="start"){
                   x.textContent ="ongoing...";
                        }  
                    else {
                        x.textContent="Ended";
                        
                    }  }
            
        </script>
        <center><div id="swaptext"style="font-size:large;">Lecture not yet started</div></center>
        <script>
            function swap(){
                var x = document.getElementById("swaptext");
               if( x.innerHTML ==="Lecture not yet started"){
                   x.innerHTML = "Your Lecture has started";
                }
                 else{
                     x.innerHTML = "Your lecture has ended";
                 }
            }
        </script>
<div style="color:green;font-size:xx-large;">
        <center><label id="hours">00</label>:
        <label id="minutes">00</label>:
        <label id="seconds">00</label></center></div>

        <script>
     function timer(){ 

var hoursLabel   = document.getElementById("hours");
var minutesLabel = document.getElementById("minutes");
var secondsLabel = document.getElementById("seconds");
var totalSeconds = 0;
var totalMinutes = 0;
check = setInterval(setTime, 1000);

function setTime() {
  ++totalSeconds;
  secondsLabel.innerHTML = pad(totalSeconds % 60);
  minutesLabel.innerHTML = pad(parseInt(totalSeconds / 60));
  totalMinutes += totalMinutes;
  hoursLabel.innerHTML = pad(parseInt(totalMinutes / 60));
}

function pad(val) {
  var valString = val + "";
  if (valString.length < 2) {
    return "0" + valString;
  } else {
    return valString;
  }
}
     }
     

</script>
<script>
    function stop() {
           clearInterval(check);
           check = null;
           document.getElementById("myButton2").innerHTML = '0';
       }
   </script>

    </div>
   
  </div>
  
  <div class="footer" style="height: 5vh;">
        <p align="center">Copyright &copy; To Infinity and Beyound. All rights reserved </p>
    </div>

</div>

</body>
</html>
<?php   }else{ header('Location: index.php');} ?>