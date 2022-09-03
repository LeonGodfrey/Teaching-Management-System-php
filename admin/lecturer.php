<?php  include 'connection.php'; //includes the connection file 
session_start();
if($_SESSION['adminId'] != ""){
?>

<?php
// insert starts here
if(isset($_POST['submit'])){
	$personName = $_POST['name'];
  $personEmail = $_POST['email'];
  $personGender = $_POST['sex'];
  $personNIN = $_POST['nin'];
  $personPassword = md5($_POST['password']); 
  $personRole = "lecturer";


    //------------------------------------------------------

$target_dir = "../uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    //echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
//-------------------------------------------------------------------------------------
 $personPhoto = $target_file;

if($_POST['add'] !== ""){

$insert = "INSERT INTO `person` (`personName`, `personEmail`, `personGender`, `personNIN`, `personPassword`, `personPhoto`, `personRole`) VALUES ('$personName', '$personEmail', '$personGender', '$personNIN', '$personPassword', '$personPhoto', '$personRole')";
$sql_query = mysqli_query($conn, $insert);
if ($sql_query == true){
  //echo "Data submitted";	
  header('Location: lecturer.php');
}else{
  echo mysqli_error($conn);
}
}

//insert ends here

if($_POST['update'] !== ""){
	$personId = $_POST['personId'];

  $update_query = "UPDATE `person` SET `personName` = '$personName', `personEmail` = '$personEmail', `personNIN` = '$personNIN', `personPassword` = '$personPassword', `personPhoto` = '$personPhoto' WHERE `person`.`personId` = '$personId'";

      $sql_query2 = mysqli_query($conn, $update_query);
    if ($sql_query2 == true){
      header("Location: lecturer.php");  
    }else{
      echo mysqli_error($conn);
    }
     }
//update ends here
 }
 

// delete starts here
    if(isset($_REQUEST['delete'])){     
      $personId = $_REQUEST['delete'];
      $delete_query="DELETE FROM person WHERE personRole = 'lecturer' AND personId = '$personId'";
      $sql_query = mysqli_query($conn, $delete_query);

      if($sql_query==TRUE){
        //echo "RECORD DELETED";
        header('Location: lecturer.php');
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
<title>Lecturers</title>

<link href="style.css" rel="stylesheet" type="text/css">
<link href="app.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome.css" rel="stylesheet" />
</head>
<?php include 'header.php'; ?>       
      <div class="main" >

     <?php
    if(isset($_REQUEST['update'])){      
    $personId = $_REQUEST['update'];        
    $statement1 = "SELECT * FROM person WHERE personId = '$personId' ";
    $sql_query1 = mysqli_query($conn, $statement1);
    $updateRow = mysqli_fetch_assoc($sql_query1);  

  ?> 
    
 
         <!--the update form starts here  -->
      <div class="headerA">
        <h2>Add Lecturer</h2>
      </div>
        <form method="post" action="" class="form" enctype="multipart/form-data" >
      
            <div class="input-groupA">
				<label>Full Name</label>
				<input type="text" name="name" value="<?php echo $updateRow["personName"]; ?>">
			</div>

			<div class="input-groupA">
				<label>NIN</label>
				<input type="text" name="nin" value="<?php echo $updateRow["personNIN"]; ?>" >
			</div>

			<div class=" ">		
		
				<label>Sex</label> <br>			
							 
				<input type="radio" name="sex" value="M"  checked="<?php if($updateRow["personGender"]=='M'){echo 'checked';} ?>">
				<label  for="inlineRadio1">Male</label>					
			
				<input type="radio" name="sex" value="F" checked="<?php if($updateRow["personGender"]=='F'){echo 'checked';} ?>">
				<label for="inlineRadio2">Female</label>
			</div>
			
		<div class="input-groupA">
			<label>Email address</label>
			<input type="email" name="email" value="<?php echo $updateRow["personEmail"]; ?>">
		</div>

		<div class="input-groupA">
			<label>Password</label>
			<input type="password" name="password" value="<?php echo $updateRow["personPassword"]; ?>">
		</div>
		<div class="input-group">
			<label>Upload Passport Photo</label>
			<br>
			<input type="file" name="fileToUpload" >
			<!-- //chris find a way of displaying the picture that is contained in the $updateRow['personPhoto'] -->
		</div>	
         <div class="input-groupA">
         	<input type="hidden" name="personId" value="<?php echo $updateRow['personId']; ?>">
         	<input type="hidden" name="add" value="">
         	<input type="hidden" name="update" value="update">
            <button type="submit" name="submit" class="btnA">Update Lecturer</button>
          </div>            
        </form>
      <?php }elseif(isset($_POST['addLecturer'])){ ?>
        <!-- the update form ends here -->

        <!--the add form starts here  -->

      <div class="headerA">
        <h2>Add Lecturer</h2>
      </div>
        <form method="post" action="" class="form" enctype="multipart/form-data" >
      
            <div class="input-groupA">
				<label>Full Name</label>
				<input type="text" name="name" >
			</div>

			<div class="input-groupA">
				<label>NIN</label>
				<input type="text" name="nin" >
			</div>

			<div class=" ">		
		
				<label>Sex</label> <br>			
							 
				<input type="radio" name="sex" value="M">
				<label  for="inlineRadio1">Male</label>					
			
				<input type="radio" name="sex" value="F">
				<label for="inlineRadio2">Female</label>
			</div>
			
		<div class="input-groupA">
			<label>Email address</label>
			<input type="email" name="email">
		</div>

		<div class="input-groupA">
			<label>Password</label>
			<input type="password" name="password">

		</div>
		<div class="input-group">
			<label>Upload Passport Photo</label>
			<br>
			<input type="file" name="fileToUpload">
		</div>	
         <div class="input-groupA">
         	<input type="hidden" name="add" value="add">
         	<input type="hidden" name="update" value="">
            <button type="submit" name="submit" class="btnA">Add Lecturer</button>
          </div>            
        </form>
      <?php } else{ ?>
        <!-- the add form ends here -->

        <!-- the display table starts here -->

        <div style="width: 100%; padding:30px;">
          <h2 align="center">View all Lecturers</h2>
          <!-- form to add a submit button to bring the add form -->
        <form method="post">
        <button type="submit" name="addLecturer" class="btnA" style="margin-left:100px;">Add New Lecturer</button>
        </form>
        <table style="width: 100%; text-align: center; " border="1" >

<?php
//select php
$retreive = "SELECT * FROM person where personRole = 'lecturer'" ;
$sql_query = mysqli_query($conn, $retreive);
?>
          <tr>
                <th>ID</th>
                <th>Photo</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>NIN</th>                               
                <th>Remove</th>
                <th>Edit</th>
          </tr>            
<?php 
$counter = 1;
while ($rows = mysqli_fetch_assoc($sql_query) ) {
?>
          <tr>
            <td><?php   echo $counter ?></td>
            

            <td> <img src="<?php  echo $rows['personPhoto']; ?>" alt="<?php   echo $rows['personName'].'photo'; ?>" style="width: 60px;"></td> 
            <td><?php   echo $rows['personName']; ?></td>
            <td><?php   echo $rows['personEmail']; ?></td>
            <td><?php   echo $rows['personGender']; ?></td> 
            <td><?php   echo $rows['personNIN']; ?></td>                           
            <!-- to trigger an action ?delete=PK -->
            <td style="background-color: forestgreen;"><a  href="?delete=<?php   echo $rows['personId']; ?>"
            onclick="return confirm('Are you sure you want to delete' )">delete </a></td>
            <td style="background-color: forestgreen;"> <a href="?update=<?php   echo $rows['personId']; ?>">update </a></td>
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