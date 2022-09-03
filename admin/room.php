<?php  include 'connection.php'; //includes the connection file 
session_start();
if($_SESSION['adminId'] != ""){//checks wether you are signed in as admin
?>

<?php
// insert starts here
if(isset($_POST['submit'])){
	$name = $_POST['name'];
  $block = $_POST['block'];
  $level = $_POST['level'];


$insert = "INSERT INTO `room` (`roomName`, `block`, `level`) VALUES ('$name', '$block', '$level')";
$sql_query = mysqli_query($conn, $insert);
if ($sql_query == true){
  //echo "Data submitted";
  header('Location: room.php');
}else{
  echo mysqli_error($conn);
}
}
//insert ends here
 

// delete starts here
    if(isset($_REQUEST['delete'])){     
      $PKID = $_REQUEST['delete'];
      $delete_query="DELETE FROM room WHERE roomId='$PKID'";
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
<title>Rooms</title>

<link href="style.css" rel="stylesheet" type="text/css">
<link href="app.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.css" rel="stylesheet" />
</head>
<?php include 'header.php'; ?>  
      <div class="main" >

     <?php
    if(isset($_REQUEST['update'])){      
    $roomId = $_REQUEST['update'];        
    $statement1 = "SELECT * FROM room WHERE roomId = '$roomId' ";
    $sql_query1 = mysqli_query($conn, $statement1);
    $updateRow = mysqli_fetch_assoc($sql_query1);  

if(isset($_POST['updateRoom'])){
$roomName = $_POST['name'];
$block = $_POST['block'];
$level = $_POST['level'];

  $update_query = "UPDATE `room` SET `roomName` = '$roomName', `block` = '$block', `level` = '$level' WHERE `room`.`roomId` = '$roomId'";

      $sql_query2 = mysqli_query($conn, $update_query);
    if ($sql_query2 == true){
      header("Location: room.php");  
    }else{
      echo mysqli_error($conn);
    }
     }  ?> 
    
 
         <!--the update form starts here  -->
      <div class="headerA">
        <h2>Add Room</h2>
      </div>
        <form method="post" action="" class="form">
      
            <div class="input-groupA">
              <label>Room Name</label>
              <input type="text" name="name" value="<?php echo $updateRow['roomName']; ?>" >
            </div>

            <div class="input-groupA">
              <label>Block</label>
              <input type="text" name="block" value="<?php  echo $updateRow['block']; ?>" >              
            </div>

            <div class="input-groupA">
              <label>level</label>
              <input type="text" name="level" value="<?php  echo $updateRow['level']; ?>">             
            </div>
             <div class="input-groupA">
            <button type="submit" name="updateRoom" class="btnA">Update Room</button>
          </div>            
        </form>
      <?php }elseif(isset($_POST['addRoom'])){ ?>
        <!-- the update form ends here -->

        <!--the add form starts here  -->

      <div class="headerA">
        <h2>Add Room</h2>
      </div>
        <form method="post" action="" class="form">
      
            <div class="input-groupA">
              <label>Room Name</label>
              <input type="text" name="name" >
            </div>

            <div class="input-groupA">
              <label>Block</label>
              <input type="text" name="block" >              
            </div>

            <div class="input-groupA">
              <label>level</label>
              <input type="text" name="level">
            </div>
             <div class="input-groupA">
            <button type="submit" name="submit" class="btnA">Add Room</button>
          </div>            
        </form>
      <?php } else{ ?>
        <!-- the add form ends here -->

        <!-- the display table starts here -->

        <div style="width: 100%; padding:30px;">
          <h2 align="center">View all rooms</h2>
          <!-- form to add a submit button to bring the add form -->
        <form method="post">
        <button type="submit" name="addRoom" class="btnA" style="margin-left:100px;">Add New Room</button>
        </form>
        <table style="width: 100%; text-align: center; " border="1" >

<?php
//select php
$retreive = "SELECT * FROM room";
$sql_query = mysqli_query($conn, $retreive);
?>
          <tr>
                <th>ID</th>
                <th>Room Name</th>
                <th>Level</th>
                <th>Block</th>                               
                <th>Remove</th>
                <th>Edit</th>
          </tr>            
<?php 
$counter = 1;
while ($rows = mysqli_fetch_assoc($sql_query) ) {
?>
          <tr>
            <td><?php   echo $counter ?></td>
            <td><?php   echo $rows['roomName']; ?></td>
            <td><?php   echo $rows['level']; ?></td>
            <td><?php   echo $rows['block']; ?></td>              
            <!-- to trigger an action ?delete=PK -->
            <td style="background-color: forestgreen;"><a  href="?delete=<?php   echo $rows['roomId']; ?>"
            onclick="return confirm('Are you sure you want to delete' )">delete </a></td>
            <td style="background-color: forestgreen;"> <a href="?update=<?php   echo $rows['roomId']; ?>">update </a></td>
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