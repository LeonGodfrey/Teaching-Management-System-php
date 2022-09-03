<?php 
session_start();
if($_SESSION['adminId'] != ""){
$adminId = $_SESSION['adminId'];
 include 'connection.php'; //includes the connection file ?>

<?php
// insert starts here
if(isset($_POST['submit'])){
	$old = md5($_POST['old']);
  $new = md5($_POST['new']);
  
$select = "SELECT * FROM person WHERE personId = '$adminId' AND personPassword = '$old'";
$sql_query = mysqli_query($conn, $select);
$count = mysqli_num_rows($sql_query);
        if ($count > 0){         
        $update_query = "UPDATE `person` SET `personPassword` = '$new' WHERE `person`.`personId` = '$adminId'";
        $sql_query = mysqli_query($conn, $update_query);
        if ($sql_query == true){
          echo "Password Changed";
         //header('Location: setting.php');
            }else{
              echo mysqli_error($conn);
                }             
      
    }else{
          // echo mysqli_error($conn);
     echo 'Wrong old Password! Please try again';
          
          }
        }
 
?>
<!DOCTYPE html PUBLIC "-//w3c//DTD XHTML 1.1//EN""
 http//www.w3.org/TR/xtml 11/DTD/xhtml 11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<title>setting</title>

<link href="style.css" rel="stylesheet" type="text/css">
<link href="app.css" rel="stylesheet" type="text/css">

<link href="css/font-awesome.css" rel="stylesheet" />
</head>
<?php include 'header.php'; ?>
      <div class="main" >
        
        <!--change password  -->
      <div class="headerA">
        <h2>Change password.</h2>
      </div>
  
        <form method="post" action="" class="form"id="form">
          <div id="msg"></div>
            <div class="input-groupA">
              <label>Old password</label>
              <input type="text" name="old" >              
            </div>             
          <div class="input-groupA">
             <label>New password</label>
            <input type="text" name="new"id="pass1" >              
            </div>

              <div class="input-groupA">
                <label>Confirm New Password</label>
                <input type="text" name="new1"id="pass2">
              </div>
               <div class="input-groupA">
              <button type="submit" name="submit" class="btnA">Save Changes</button>
            </div>
            </form>
        
    </div>
   
  </div>
  
  <div class="footer" style="height: 5vh;">
        <p align="center">Copyright &copy; To Infinity and Beyound. All rights reserved </p>
    </div>

</div>
<script>
var myForm = document.getElementById('form');
var pass1 = document.getElementById('pass1');
var pass2 = document.getElementById('pass2');
var msg = document.getElementById('msg');

myForm.addEventListener('submit', onSubmit);

function onSubmit(e) {
    e.preventDefault();

    if (pass1.value != pass2.value) {
            msg.innerHTML = '<h1 style="color:darkred;">Error? password mismatch</h1>';

        setTimeout(() => msg.remove(), 10000); //the time out function takes time as aparameter in miliseconds

    } else {

        msg.innerHTML = '<h1 style="color:green;">password changed</h1>';
        
    }
}
</script>

</body>
</html>
<?php   }else{ header('Location: index.php');} ?>