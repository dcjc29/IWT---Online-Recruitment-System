<?php
    require "dbCOnnection.php";
    session_start();
    if(isset($_SESSION['uname']))
    {
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Page</title>
<link rel="stylesheet" type="text/css" href="CSS\Stylesheet.css">
<link rel="stylesheet" type="text/css" href="CSS\admin.css">
</head>

<body>
   <?php
    include "adminHeader.php";
   ?>
<div class="content">
<h2>Administrator Panel</h2>
<div class="details">
    <h3>Welcome Back</h3><br>
    <?php echo "<p style='color:#44ABA0; font-size:25px; text-align:center;'>".$_SESSION['uname']."</p>";?>
    <img src="src\img_506378.png" class="details">
    <input type="button" value="Log Out" class="details" onClick="location.href='logout.php'"><br><br>
    <a href="homepage.php"><input type="button" value="Go Back To Home" class="details"></a>
</div>    
<div class="menu">
<ul class="menu">
        <a href="viewCompanyList.php" class="menu"><li class="menu" >View Company List</li></a>
        <a href="viewJobSeekersList.php" class="menu"><li class="menu">View Candidate List</li></a>
        <a href="viewMessages.php" class="menu"><li class="menu">View Messages</li></a>
        <a href="https:\\www.gmail.com" class="menu" target="#"><li class="menu">E-mail</li></a>
        <a href="adminPass.php" class="menu"><li class="menu">Change Password</li></a>
        <a href="adminAdd.php" class="menu"><li class="menu">Add An Admin</li></a>
    
</ul>
</div>
<div class="recent">
    <h3 style="color:#44ABA0;text-decoration:underline;font-size:25px;">Recent Statistics</h3><br>
    <h4>Number Of Registered Companies</h4><br>
    <?php
        $query="SELECT * FROM company";
        $result=mysqli_query($con,$query);
        $number=(mysqli_num_rows($result));
        echo $number;
    ?>
    <br><h4>Number Of Registered Job Seekers</h4><br>
    <?php
        $query="SELECT * FROM jobseeker";
        $result=mysqli_query($con,$query);
        $number=(mysqli_num_rows($result));
        echo $number;
    ?>
    <br><h4>Number Of Administrators</h4><br>
    <?php
        $query="SELECT * FROM administrator";
        $result=mysqli_query($con,$query);
        $number=(mysqli_num_rows($result));
        echo $number;
    ?>
     <br><h4>Number Of Unreplied Messages</h4><br>
    <?php
        $query = "SELECT * FROM messages WHERE toPerson = 'admin' AND replied = 0 ";
        $result = mysqli_query($con, $query);
        $number=(mysqli_num_rows($result));
        echo $number;
    ?>
</div>  
</div>
  <?php
    include "adminFooter.php";
    }
    else
        header("location:login_Admin.php");
   
   ?>            

        


</body>

</html>