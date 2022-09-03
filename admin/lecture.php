<?php  include 'connection.php'; //includes the connection file 
session_start();
if($_SESSION['adminId'] != ""){
?>

<?php
// insert starts here
if(isset($_POST['submit'])){
  $day = $_POST['day'];
  $start = $_POST['start'];
  $end = $_POST['end'];
  $courseId = $_POST['courseId'];
  $personId = $_POST['personId'];
	$roomId = $_POST['roomId'];
 
  if($_POST['add'] !== ""){

  $insert = "INSERT INTO `lecture` (`lectureDay`,  `plannedStartTime`, `plannedEndTime`, `courseId`, `personId`, `roomId`) VALUES ('$day', '$start', '$end','$courseId', '$personId', '$roomId')";
  $sql_query = mysqli_query($conn, $insert);
  if ($sql_query == true){
    //echo "Data submitted";  
    header('Location: lecture.php');
  }else{
    echo mysqli_error($conn);
  }
  }

  //insert ends here

  if($_POST['update'] !== ""){
    $lectureId = $_POST['lectureId'];

    $update_query = "UPDATE `lecture` SET `lectureDay` = '$day', `plannedStartTime` = '$start', `plannedEndTime` = '$end', `courseId` = '$courseId', `personId` = '$personId', `roomId` = '$roomId' WHERE `lecture`.`lectureId` = '$lectureId'";

        $sql_query2 = mysqli_query($conn, $update_query);
      if ($sql_query2 == true){
        header("Location: lecture.php");  
      }else{
        echo mysqli_error($conn);
      }
       }
//update ends here
 }
 

// delete starts here
    if(isset($_REQUEST['delete'])){     
      $PKID = $_REQUEST['delete'];
      $delete_query="DELETE FROM lecture WHERE lectureId='$PKID'";
      $sql_query = mysqli_query($conn, $delete_query);

      if($sql_query==TRUE){
         header('Location: lecture.php');
        //echo "RECORD DELETED";
      }
      else
        { echo mysqli_error($conn);}

    }
  //delete ends here
?>
<!DOCTYPE html PUBLIC "-//w3c//DTD XHTML 1.1//EN""
 http//www.w3.org/TR/xtml 11/DTD/xhtml 11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  
<head>
<meta charset="utf-8">
<title>lectures</title>

<link href="style.css" rel="stylesheet" type="text/css">
<link href="app.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.css" rel="stylesheet" />
</head>
<?php include 'header.php'; ?>        
      <div class="main" >

     <?php
    if(isset($_REQUEST['update'])){      
    $lectureId = $_REQUEST['update'];        
    $statement1 = "SELECT * FROM lecture WHERE lectureId = '$lectureId' ";
    $sql_query1 = mysqli_query($conn, $statement1);
    $updateRow = mysqli_fetch_assoc($sql_query1); 
    //$day1 = $updateRow['lectureDay']; 
  ?> 
    
 
         <!--the update form starts here  -->
      <div class="headerA">
        <h2>Update Lecture</h2>
      </div>
        <form method="post" action="" class="form">
      
            <div class="input-groupA">
              <label>Day</label>              
              <select name="day" >  
                <option>Select Day of the week</option>
                <option <?php   if($updateRow['lectureDay'] == 'Monday'){echo 'selected="selected"';} ?>>Monday</option>
                 <option <?php   if($updateRow['lectureDay'] == 'Tuesday'){echo 'selected="selected"';} ?>>Tuesday</option>
                  <option <?php   if($updateRow['lectureDay'] == 'Wednesday'){echo 'selected="selected"';} ?>>Wednesday</option>
                   <option <?php   if($updateRow['lectureDay'] == 'Thursday'){echo 'selected="selected"';} ?>>Thursday</option>
                    <option <?php   if($updateRow['lectureDay'] == 'Friday'){echo 'selected="selected"';} ?>>Friday</option>
                     <option <?php   if($updateRow['lectureDay'] == 'Saturday'){echo 'selected="selected"';} ?>>Saturday</option>
                      <option <?php   if($updateRow['lectureDay'] == 'Sunday'){echo 'selected="selected"';} ?>>Sunday</option>
                </select>
            </div>
            <div class="input-groupA">
              <label>Start Time</label>
              <input type="time" name="start" value="<?php   echo  $updateRow['plannedStartTime']; ?>">
            </div>
            <div class="input-groupA">
              <label>End Time</label>
              <input type="time" name="end"  value="<?php   echo  $updateRow['plannedEndTime']; ?>">
            </div>
            <div class="input-groupA">
              <label>Course </label>
              <select name="courseId" >  
                <option>Select Course</option>
                  <?php
                  $cId = $updateRow['courseId'];
                  $sql = "select * from course";
                  $q = mysqli_query($conn, $sql);              
                  while($r = mysqli_fetch_assoc($q))
                  {  ?>                   
                 
                  <option value=" <php echo $r['courseId']; ?>" <?php  if($cId == $r['courseId']){echo 'selected="selected"';} ?>> <?php   echo $r['courseName']; ?> </option>
                 <?php   } ?>                                  
                  
                  </select>
            </div>

            <div class="input-groupA">
              <label>Lecturer</label>
              <select name="personId" >  
                <option>Select Lecturer</option>
                  <?php
                  $pId = $updateRow['personId']; 
                  $sql1 = "select * from person where personRole = 'lecturer'";
                  $q1 = mysqli_query($conn, $sql1);              
                  while($r = mysqli_fetch_assoc($q1))
                  { ?>                   
                   <option value=" <php echo $r['personId']; ?>" <?php  if($pId == $r['personId']){echo 'selected="selected"';} ?>> <?php   echo $r['personName']; ?> </option>
                  <?php } ?>                 
                  
                  </select>
            </div>

            <div class="input-groupA">
              <label>Lecture Room</label>
              <select name="roomId" >  
                <option>Select lecture room</option>
                  <?php
                  $rId = $updateRow[roomId];
                  $sql2 = "select * from room";
                  $q2 = mysqli_query($conn, $sql2);              
                  while($r = mysqli_fetch_assoc($q2))
                   { ?>                   
                   <option value=" <php echo $r['roomId']; ?>" <?php  if($rId == $r['roomId']){echo 'selected="selected"';} ?>> <?php   echo $r['roomName']; ?> </option>
                  <?php } ?>                 
                                   
                  
                  </select>
            </div>
             <div class="input-groupA">
              <input type="hidden" name="lectureId" value="<?php  echo $updateRow['lectureId']; ?>">
              <input type="hidden" name="add" value="">
              <input type="hidden" name="update" value="update">
            <button type="submit" name="submit" class="btnA">Update lecture</button>
          </div>            
        </form>
      <?php }elseif(isset($_POST['addLecture'])){ ?>
        <!-- the update form ends here -->

        <!--the add form starts here  -->

      <div class="headerA">
        <h2>Add lecture</h2>
      </div>
        <form method="post" action="" class="form">
      
            <div class="input-groupA">
              <label>Day</label>              
              <select name="day" >  
                <option>Select Day of the week</option>
                <option>Monday</option>
                 <option>Tuesday</option>
                  <option>Wednesday</option>
                   <option>Thursday</option>
                    <option>Friday</option>
                     <option>Saturday</option>
                      <option>Sunday</option>
                </select>
            </div>
            <div class="input-groupA">
              <label>Start Time</label>
              <input type="time" name="start" >
            </div>
            <div class="input-groupA">
              <label>End Time</label>
              <input type="time" name="end" >
            </div>
            <div class="input-groupA">
              <label>Course </label>
              <select name="courseId" >  
                <option>Select Course</option>
                  <?php
                  $sql = "select * from course";
                  $q = mysqli_query($conn, $sql);              
                  while($r = mysqli_fetch_assoc($q))
                  {                    
                  echo '<option value="'.$r['courseId'].'"  >'.$r['courseName'].'</option>';
                  }
                  ?>                  
                  
                  </select>
            </div>

            <div class="input-groupA">
              <label>Lecturer</label>
              <select name="personId" >  
                <option>Select Lecturer</option>
                  <?php
                  $sql1 = "select * from person where personRole = 'lecturer'";
                  $q1 = mysqli_query($conn, $sql1);              
                  while($r = mysqli_fetch_assoc($q1))
                  {                    
                  echo '<option value="'.$r['personId'].'"  >'.$r['personName'].'</option>';
                  }
                  ?>                  
                  
                  </select>
            </div>

            <div class="input-groupA">
              <label>Lecture Room</label>
              <select name="roomId" >  
                <option>Select lecture room</option>
                  <?php
                  $sql2 = "select * from room";
                  $q2 = mysqli_query($conn, $sql2);              
                  while($r = mysqli_fetch_assoc($q2))
                  {                    
                  echo '<option value="'.$r['roomId'].'"  >'.$r['roomName'].'</option>';
                  }
                  ?>                  
                  
                  </select>
            </div>
             <div class="input-groupA">
              <input type="hidden" name="add" value="add">
          <input type="hidden" name="update" value="">
            <button type="submit" name="submit" class="btnA">Add lecture</button>
          </div>            
        </form>
      <?php } else{ ?>
        <!-- the add form ends here -->

        <!-- the display table starts here -->

        <div style="width: 100%; padding:30px;">
          <h2 align="center">View all Lectures</h2>
          <!-- form to add a submit button to bring the add form -->
        <form method="post">
        <button type="submit" name="addLecture" class="btnA" style="margin-left:100px;">Add New Lecture</button>
        </form>
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search by course name">
        <table style="width: 100%; text-align: center; " border="1" id="myTable">

<?php

//select php
$retreive = "SELECT * FROM lecture";
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
                <th>Remove</th>
                <th>Edit</th>
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
            <td style="background-color: forestgreen;"><a  href="?delete=<?php   echo $rows['lectureId']; ?>"
            onclick="return confirm('Are you sure you want to delete' )">delete </a></td>
            <td style="background-color: forestgreen;"> <a href="?update=<?php   echo $rows['lectureId']; ?>">update </a></td>
          </tr> 
          <?php $counter++;  
          } 
          ?>  
        </table>
        <script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[4];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
    </div>
  <?php  } ?>
    <!-- the display table ends here -->

    </div>
   
  </div>
  
  <div class="footer" style="height: 5vh;">
        <p align="center">Copyright &copy; To Infinity and Beyound. All rights reserved </p>
    </div>

</div>

</body>
</html>
<?php   }else{ header('Location: ../index.php');}//takes you to the login page ?>