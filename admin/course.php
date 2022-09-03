<?php  include 'connection.php'; //includes the connection file 
session_start();
if($_SESSION['adminId'] != ""){
?>

<?php
// insert starts here
if(isset($_POST['submit'])){
	$name = $_POST['name'];
  $code = $_POST['code'];
  $credit = $_POST['credit'];
  $program = $_POST['program'];
  $semester = $_POST['semester'];
  $year = $_POST['year'];

if($_POST['add'] !== ""){

$insert = "INSERT INTO `course` ( `courseName`, `courseCode`, `creditUnits`, `program`, `semester`, `yearOfStudy`) VALUES ('$name', '$code', '$credit', '$program', '$semester', '$year')";
$sql_query = mysqli_query($conn, $insert);
if ($sql_query == true){
  //echo "Data submitted";
  header('Location: course.php');
}else{
  echo mysqli_error($conn);
}
}

if($_POST['update'] !== ""){
  $courseId = $_POST['courseId'];

  $update_query = "UPDATE `course` SET `courseName` = '$name', `courseCode` = '$code', `creditUnits` = '$credit', `program` = '$program', `semester` = '$semester', `yearOfStudy` = '$year' WHERE `course`.`courseId` = '$courseId'";

      $sql_query2 = mysqli_query($conn, $update_query);
    if ($sql_query2 == true){
      header("Location: course.php");  
    }else{
      echo mysqli_error($conn);
    }
  }
}
//insert ends here
 

// delete starts here
    if(isset($_REQUEST['delete'])){     
      $PKID = $_REQUEST['delete'];
      $delete_query="DELETE FROM course WHERE courseId='$PKID'";
      $sql_query = mysqli_query($conn, $delete_query);

      if($sql_query==TRUE){
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
<title>course</title>

<link href="style.css" rel="stylesheet" type="text/css">
<link href="app.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.css" rel="stylesheet" />
</head>
    
<?php include 'header.php'; ?>
      <div class="main" >

     <?php
    if(isset($_REQUEST['update'])){      
    $courseId = $_REQUEST['update'];        
    $statement1 = "SELECT * FROM course WHERE courseId = '$courseId' ";
    $sql_query1 = mysqli_query($conn, $statement1);
    $updateRow = mysqli_fetch_assoc($sql_query1);
       ?> 
    
 
         <!--the update form starts here  -->
      <div class="headerA">
        <h2>Update Course </h2>
      </div>
        <form method="post" action="" class="form">
      
            <div class="input-groupA">
              <label>Room Name</label>
              <input type="text" name="name" value="<?php echo $updateRow['courseName']; ?>" >
            </div>
            <div class="input-groupA">
              <label>Course Code</label>
              <input type="text" name="code" value="<?php echo $updateRow['courseCode']; ?>">
            </div>
            <div class="input-groupA">
              <label>Credit Units</label>
              <input type="text" name="credit" value="<?php echo $updateRow['creditUnits']; ?>">
            </div>
            <div class="input-groupA">
              <label>Program</label>
              <input type="text" name="program" value="<?php echo $updateRow['program']; ?>">
            </div>
            <div class="input-groupA">
              <label>Semester Of Study</label>
              <input type="text" name="semester" value="<?php echo $updateRow['semester']; ?>">
            </div>
            <div class="input-groupA">
              <label>Year of Study</label>
              <input type="text" name="year" value="<?php echo $updateRow['yearOfStudy']; ?>" >
            </div>
            
             <div class="input-groupA">
              <input type="hidden" name="courseId" value="<?php echo $updateRow['courseId']; ?>">
              <input type="hidden" name="add" value="">
              <input type="hidden" name="update" value="update">
            <button type="submit" name="submit" class="btnA">Update Course</button>
          </div>            
        </form>
      <?php }elseif(isset($_POST['addCourse'])){ ?>
        <!-- the update form ends here -->

        <!--the add form starts here  -->

      <div class="headerA">
        <h2>Add Course</h2>
      </div>
        <form method="post" action="" class="form">
      
            <div class="input-groupA">
              <label>Course Name</label>
              <input type="text" name="name" >
            </div>
            <div class="input-groupA">
              <label>Course Code</label>
              <input type="text" name="code" >
            </div>
            <div class="input-groupA">
              <label>Credit Units</label>
              <input type="text" name="credit" >
            </div>
            <div class="input-groupA">
              <label>Program</label>
              <input type="text" name="program" >
            </div>
            <div class="input-groupA">
              <label>Semester Of Study</label>
              <input type="text" name="semester" >
            </div>
            <div class="input-groupA">
              <label>Year of Study</label>
              <input type="text" name="year" >
            </div>
            
             <div class="input-groupA">
              <input type="hidden" name="add" value="add">
          <input type="hidden" name="update" value="">
            <button type="submit" name="submit" class="btnA">Add Course</button>
          </div>            
        </form>
      <?php } else{ ?>        
        <!-- the add form ends here -->

        <!-- the display table starts here -->

        <div style="width: 100%; padding:30px;">
          <h2 align="center">View all Courses</h2>
          <!-- form to add a submit button to bring the add form -->
        <form method="post">
        <button type="submit" name="addCourse" class="btnA" style="margin-left:100px;">Add New Course</button>
        </form>
        <table style="width: 100%; text-align: center; " border="1" >

<?php
//select php
$retreive = "SELECT * FROM course";
$sql_query = mysqli_query($conn, $retreive);
?>
          <tr>
                <th>ID</th>
                <th>Course Name</th> 
                <th>Course Code</th> 
                <th>Credit Units</th>
                <th>Program</th>
                <th>Semester</th>
                <th>Year</th>                                                
                <th>Remove</th>
                <th>Edit</th>
          </tr>            
<?php 
$counter = 1;
while ($rows = mysqli_fetch_assoc($sql_query) ) {
?>
          <tr>
            <td><?php   echo $counter ?></td>
            <td><?php   echo $rows['courseName']; ?></td>
            <td><?php   echo $rows['courseCode']; ?></td> 
            <td><?php   echo $rows['creditUnits']; ?></td> 
            <td><?php   echo $rows['program']; ?></td> 
            <td><?php   echo $rows['semester']; ?></td>
            <td><?php   echo $rows['yearOfStudy']; ?></td>                      
            <!-- to trigger an action ?delete=PK -->
            <td style="background-color: forestgreen;"><a  href="?delete=<?php   echo $rows['courseId']; ?>" 
            onclick="return confirm('Are you sure you want to delete' )">delete </a></td>
            <td style="background-color: forestgreen;"> <a href="?update=<?php   echo $rows['courseId']; ?>">update </a></td>
          </tr> 
          <?php $counter++;  
          } 
          ?>  
        </table>
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
<?php   }else{ header('Location: ../index.php');} 