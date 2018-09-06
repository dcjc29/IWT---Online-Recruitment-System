<?php
        include "dbConnection.php";
        session_start();
        if(isset($_SESSION['uname']))
{
?>
<html>
<head>
<title>Admin Page</title>
<link rel="stylesheet" type="text/css" href="CSS\Stylesheet.css">
<link rel="stylesheet" type="text/css" href="CSS\admin.css">
<script>
        function adminPassValidate (){
        var newpass = document.getElementById('newpass').value;
        var conpass = document.getElementById('conpass').value;
        var oldpass = document.getElementById('oldpass').value;

        if(newpass=="" || conpass=="" || oldpass=="")
        {
                alert("Fields Cannot Be Blank");
                return false;
        }
        else if(newpass != conpass)
        {
                alert("New Password Doesn't match.Try Again");
                return false;
        }
        else{
                return true;
        }
}  

</script>  
</head>

<body>
<?php include "adminHeader.php" ?>    
<div class="content">

<h2>Administrator Password Manager</h2>
<a href = "adminMenu.php"><img id = "back"  src = "src\back.png"></a>
<div class="passChange">
        <form class="passChange" onsubmit="return adminPassValidate();"  method="post">
                <h3 class="search">Admin Account</h3><br>
                <span><?php
    if(isset($_POST['passChange']))
    {
        $opass = $_REQUEST["opass"];
        $npass = $_REQUEST["npass"];
        $cpass = $_REQUEST["cpass"];
        $uname = $_SESSION['uname'];
        
        $result = mysqli_query($con,"SELECT passw FROM administrator WHERE uname = '$uname'");
        $rows = mysqli_fetch_assoc($result);
        $oldpass=$rows['passw'];
        if ($oldpass == $opass){
           mysqli_query($con,"UPDATE administrator SET passw = '$npass' WHERE uname = '$uname';");
            echo "<p class='Result'>Successfully Changed!!!</p>";
            session_destroy();
            header("refresh:2;url=login_Admin.php");
            }
        else    
            echo" <p class='noResult'> Invalid Password.Try Again!!!</p>";
    }
?></span>
                <input type="password" class="passChange" name = "opass" placeholder="Enter Old Password" id="oldpass"><br>
                <input type="password" class="passChange" name = "npass" placeholder="Enter New Password" id ="newpass"><br>
                <input type="password" class="passChange"  name ="cpass" placeholder="Confirm New Password" id="conpass"><br>
                <input name="passChange" type="submit" class="passChange" value="Change Now"><br>
                <input type="reset" class="passChange" value="Reset"><br>
                </form>
      
</div>


<div id="footerAdmin">

</div>
</body>
</html>
<?php
}

    else
        header("location:login_Admin.php");
   
?>

