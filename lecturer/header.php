<body class="b">
<div class="header" style="height: 10vh;">  
<h1>
<center><img src="../uploads/tmslog.png" width=" "/></center></h1>      
      </div>
  <div class="wrapper" style="height: 100vh;">
      
      <div class="body" >
          <div class="sidebar" style="background-color:#forestgreen;">
            <ul>         
              <a class="active" href="lecturerDashboard.php" style="text-decoration: none;"><li> <i class="fa fa-dashboard "></i>Lecturer Dashboard</li></a>
              <a href="lecture.php" style="text-decoration: none;"><li> <i class="fa fa-th-large"></i>Lectures Today</li></a>
              <a href="allLectures.php" style="text-decoration: none;"><li> <i class="fa fa-th-large"></i>All Lectures</li></a>
              <a href="report.php" style="text-decoration: none;"><li> <i class="fa fa-file-pdf-o "> </i>Reports</li></a> 
                <a href="setting.php" style="text-decoration: none;"><li> <i class="fa fa-cogs "> </i>Settings</li></a>             
                <a href="" id="logout"style="text-decoration: none;"
                 onclick="logout()"><li> <i class="fa fa-power-off"></i>Logout</li></a>      
            </ul>
          </div>
          <script>
          function logout(){
        var reallyLogout=confirm("Do you really want to log out?");
        if(reallyLogout){
            location.href="../index.php";
        }
}
var el = document.getElementById("logout");
if (el.addEventListener) {
        el.addEventListener("click", logoutfunction, false);
    } else {
        el.attachEvent('onclick', logoutfunction);
}  
</script>