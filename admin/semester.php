<?php  include 'connection.php'; //includes the connection file 
session_start();
if($_SESSION['adminId'] != ""){//checks wether you are signed in as admin
?>

<?php
// insert starts here
if(isset($_POST['submit'])){
	$state = $_POST['state'];
  $start = $_POST['start'];
  $end = $_POST['end'];

if($_POST['add'] != ''){
$insert = "INSERT INTO `semester` (`semesterDetail`, `startDate`, `endDate`) VALUES ('$state', '$start', '$end')";
$sql_query = mysqli_query($conn, $insert);
if ($sql_query == true){
  //echo "Data submitted";
  header('Location: semester.php');
}else{
  echo mysqli_error($conn);
}

//insert ends here
}

//update
if($_POST['update'] != ''){
  $semesterId = $_POST['semesterId'];

  $update_query = "UPDATE `semester` SET `semesterDetail` = '$state', `startDate` = '$start', `endDate` = '$end' WHERE `semester`.`semesterId` = '$semesterId'";

      $sql_query2 = mysqli_query($conn, $update_query);
    if ($sql_query2 == true){
      header("Location: semester.php");  
    }else{
      echo mysqli_error($conn);
    }
  }//end update
 }

// delete starts here
    if(isset($_REQUEST['delete'])){     
      $PKID = $_REQUEST['delete'];
      $delete_query="DELETE FROM semester WHERE semesterId='$PKID'";
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
<title>Semester</title>

<link href="style.css" rel="stylesheet" type="text/css">
<link href="app.css" rel="stylesheet" type="text/css">

<link href="css/font-awesome.css" rel="stylesheet" />
</head>
<?php include 'header.php'; ?> 
      <div class="main" >

     <?php
    if(isset($_REQUEST['update'])){      
    $semesterId = $_REQUEST['update'];        
    $statement1 = "SELECT * FROM semester WHERE semesterId = '$semesterId' ";
    $sql_query1 = mysqli_query($conn, $statement1);
    $updateRow = mysqli_fetch_assoc($sql_query1); 
      ?> 
    
 
         <!--the update form starts here  -->
      <div class="headerA">
        <h2>Update Semester</h2>
      </div>
        <form method="post" action="" class="form">
      
            <div class="input-groupA">
              <label>Semester State</label>
              <select name="state">
              <option>Choose State</option>
              <option value="FIRST" <?php if($updateRow['semesterDetail'] == 'FIRST'){echo 'selected = "selected"';} ?>>First</option>
              <option value="SECOND" <?php if($updateRow['semesterDetail'] == 'SECOND'){echo 'selected = "selected"';} ?>>Second</option>  
              </select>
            </div>

            <div class="input-groupA">
              <label>Start Date</label>
              <input type="date" name="start" <?php echo 'value = "'.$updateRow['startDate'].'"'; ?> >              
            </div>

            <div class="input-groupA">
              <label>End Date</label>
              <input type="date" name="end" <?php echo 'value = "'.$updateRow['endDate'].'"'; ?>>
              <input type="hidden" name="add" value="">
              <input type="hidden" name="update" value="update">
              <input type="hidden" name="semesterId" value="<?php echo $updateRow['semesterId']; ?>">
            </div>
             <div class="input-groupA">
            <button type="submit" name="submit" class="btnA">Update Semester</button>
          </div>            
        </form>
      <?php }elseif(isset($_POST['addSemester'])){ ?>
        <!-- the update form ends here -->

        <!--the add form starts here  -->


      <div class="headerA">
        <h2>Add Semester</h2>
      </div>
        <form method="post" action="" class="form">
      
            <div class="input-groupA">
              <label>Semester State</label>
              <select name="state">
              <option>Choose State</option>
              <option value="FIRST">First</option>
              <option value="SECOND">Second</option>  
              </select>
            </div>

            <div class="input-groupA">
              <label>Start Date</label>
              <input type="date" name="start" >              
            </div>

            <div class="input-groupA">
              <label>End Date</label>
              <input type="date" name="end">
              <input type="hidden" name="add" value="add">
              <input type="hidden" name="update" value="">
            </div>
             <div class="input-groupA">
            <button type="submit" name="submit" class="btnA">Add Semester</button>
          </div>            
        </form>
      <?php } else{ ?>
        <!-- the add form ends here -->

        <!-- the display table starts here -->

        <div style="width: 100%; padding:30px;">
          <h2 align="center">Current Semester</h2>
          <!-- form to add a submit button to bring the add form -->
        <form method="post">
        <button type="submit" name="addSemester" class="btnA" style="margin-left:100px;">Add New Semester</button>
        </form>
        <table style="width: 100%; text-align: center; " border="1" >

<?php
//select php
$retreive = "SELECT * FROM semester";
$sql_query = mysqli_query($conn, $retreive);
?>
          <tr>
                <th>ID</th>
                <th>Semester</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Remove</th>                          
                <th>Edit</th>
          </tr>            
<?php 
$counter = 1;
while ($rows = mysqli_fetch_assoc($sql_query) ) {
?>
          <tr>
            <td><?php   echo $counter ?></td>
            <td><?php   echo $rows['semesterDetail']; ?></td>
            <td><?php   echo $rows['startDate']; ?></td>
            <td><?php   echo $rows['endDate']; ?></td>              
            <!-- to trigger an action ?delete=PK -->
            <td style="background-color: forestgreen;"><a  href="?delete=<?php   echo $rows['semesterId']; ?>"
            onclick="return confirm('Are you sure you want to delete' )">delete </a></td>
            <td style="background-color: forestgreen;"> <a href="?update=<?php   echo $rows['semesterId']; ?>">update </a></td>
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
<?php   }else{ header('Location: ../index.php');}//takes you to the login page ?>