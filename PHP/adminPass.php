
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
}
</script>  
</head>

<body>
<?php include "adminHeader.php" ?>    
<div class="content">

<h2>Administrator Password Manager</h2>
<a href = "adminMenu.php"><img id = "back"  src = "src\back.png"></a>
<div class="passChange">
        <form class="passChange" onsubmit="return adminPassValidate()" method="post">
                <h3 class="search">Admin Account</h3><br>
                
                <input type="text" class="passChange" name = "opass" placeholder="Enter Old Password" id="oldpass"><br>
                <input type="password" class="passChange" name = "npass" placeholder="Enter New Password" id ="newpass"><br>
                <input type="password" class="passChange"  name ="cpass" placeholder="Confirm New Password" id="conpass"><br>
                <input name="passChange" type="submit" class="passChange" value="Change Now"><br>
                <input type="reset" class="passChange" value="Reset"><br>
                <?php
    include "dbConnection.php";
    if(isset($_POST['passChange']))
    {
        $opass = $_REQUEST["opass"];
        $npass = $_REQUEST["npass"];
        $cpass = $_REQUEST["cpass"];
        
        
        $oldpass = mysqli_query($con,"SELECT passw FROM administrator WHERE uname = 'dure'");
        if ($opass == 1234){
           mysqli_query($con,"UPDATE administrator SET passw = '$npass' WHERE uname = 'dure';");
            echo "<p style='text-align:center;'>Successfully Changed!!!</p>";
            }
        else    
            echo" <p style='text-align:center;color:red;'> Invalid Password.Check Your Password Again!!!</p>";
    }
?>
                </form>
      
</div>


<div class="footerAdmin">

</div>
</body>

</html>
