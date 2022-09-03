
<?php  include 'connection.php'; //includes the connection file ?>

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

if($_POST['add'] != ""){

$insert = "INSERT INTO `person` (`personName`, `personEmail`, `personGender`, `personNIN`, `personPassword`, `personPhoto`, `personRole`) VALUES ('$personName', '$personEmail', '$personGender', '$personNIN', '$personPassword', '$personPhoto', '$personRole')";
$sql_query = mysqli_query($conn, $insert);
if ($sql_query == true){
  //echo "Data submitted";	
  header('Location: index.php');
}else{
  echo mysqli_error($conn);
}
}

//insert ends here
}

?>

<!DOCTYPE html PUBLIC "-//w3c//DTD XHTML 1.1//EN""
 http//www.w3.org/TR/xtml 11/DTD/xhtml 11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Lecturer Signup</title>
	<!--<link href="style.css" rel="stylesheet" type="text/css">
<link href="app.css" rel="stylesheet" type="text/css">!-->
<link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body class="bodyA">
	<div class="headerA">
	<h2>Lecturer Registration</h2>
</div>

        <form method="post" action="" class="formA" enctype="multipart/form-data" id="myForm">

        <h3 id="msg"></h3>
      
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
        <label for="password">Password</label>
      <input type="password" id="password" name="password"
       pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
       title="Must contain at least one number and 
       one uppercase and lowercase letter, and at least 8 or more characters" required>
  
  </script>
       <div id="message">
    <h3>Password must contain the following:</h3>
    <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
    <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
    <p id="number" class="invalid">A <b>number</b></p>
    <p id="length" class="invalid">Minimum <b>8 characters</b></p>
  </div>
          
  <script>
  var myInput = document.getElementById("password");
  var letter = document.getElementById("letter");
  var capital = document.getElementById("capital");
  var number = document.getElementById("number");
  var length = document.getElementById("length");
  
  // When the user clicks on the password field, show the message box
  myInput.onfocus = function() {
    document.getElementById("message").style.display = "block";
  }
  
  // When the user clicks outside of the password field, hide the message box
  myInput.onblur = function() {
    document.getElementById("message").style.display = "none";
  }
  
  // When the user starts to type something inside the password field
  myInput.onkeyup = function() {
    // Validate lowercase letters
    var lowerCaseLetters = /[a-z]/g;
    if(myInput.value.match(lowerCaseLetters)) {  
      letter.classList.remove("invalid");
      letter.classList.add("valid");
    } else {
      letter.classList.remove("valid");
      letter.classList.add("invalid");
    }
    
    // Validate capital letters
    var upperCaseLetters = /[A-Z]/g;
    if(myInput.value.match(upperCaseLetters)) {  
      capital.classList.remove("invalid");
      capital.classList.add("valid");
    } else {
      capital.classList.remove("valid");
      capital.classList.add("invalid");
    }
  
    // Validate numbers
    var numbers = /[0-9]/g;
    if(myInput.value.match(numbers)) {  
      number.classList.remove("invalid");
      number.classList.add("valid");
    } else {
      number.classList.remove("valid");
      number.classList.add("invalid");
    }
    
    // Validate length
    if(myInput.value.length >= 8) {
      length.classList.remove("invalid");
      length.classList.add("valid");
    } else {
      length.classList.remove("valid");
      length.classList.add("invalid");
    }
  }
  </script>

<div>
<input id ="password"type="checkbox" onclick="myFunction()"><br>
<center>Show Password</center>
        </div>

	<script>
	  function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
	x.type = "text";
  } else {
	x.type = "password";
  }
} 
	</script>

		</div>
		<div class="input-group">
			<label>Upload Passport Photo</label>
			<input type="file" name="fileToUpload">
		</div>	
         <div class="input-groupA">
         	<input type="hidden" name="add" value="add">
         	<input type="hidden" name="update" value="">
            <button type="submit" name="submit" class="btnA"
            onclick="onSubmit()">signup</button>
            </div>
           
          <p>
					Already have an account? 
                    <a href="index.php">Sign in </a>
				</p>   
                     
        </form>	

</body>
</html>