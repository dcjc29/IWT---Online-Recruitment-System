<?php
ini_set( "display_errors", 0); 

        include "dbConnection.php";
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
<script>
        function adminAddValidate (){
        var oldpass = document.getElementById('oldpass').value;
        var newUname = document.getElementById('newUname').value;
        var newPass = document.getElementById('newPass').value;
        var newPassCon = document.getElementById('newPassCon').value;


        if(oldpass=="" || newUname=="" || newPass=="" || newPassCon =="" )
        {
                alert("Fields Cannot Be Blank");
                return false;
        }
        else if(newPass != newPassCon)
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
    <?php
        include "adminHeader.php";
    ?>
<div class="content"></div>
<h2>Administrator Account Manager</h2>
<a href="adminMenu.php"><img id = "back" src = "src\back.png"></a>
<div class="addAdmin">
        <form class="addAdmin" onsubmit=" return adminAddValidate();" method="POST">
                <h3 class="search">Add An Administrator</h3><br>
                <span><?php
                if(isset($_POST['add'])){
                        $pass = $_REQUEST["password"];
                        $uname = $_REQUEST["newuname"];
                        $newpass = $_REQUEST["newpassword"];
                        $adminName=$_SESSION['uname'];
                        $result = mysqli_query($con,"SELECT passw FROM administrator WHERE uname = '$adminName'");
                        $rows = mysqli_fetch_assoc($result);
                        $oldpass=$rows['passw'];
                        $query = mysqli_query($con,"SELECT * FROM administrator WHERE uname = '$uname'");
                if(mysqli_num_rows($query) == 0)
                if ($oldpass == $pass) {
                        mysqli_query($con, "INSERT INTO administrator(uname,passw) VALUES('$uname','$newpass')");
                        echo "<p class='Result'>New Administrator Succesfully Added.</p>";
                    } else
                        echo "<p class='noResult'>Please Check Your Password!!!</p>";
                      
                else {
                        echo"<p class='noResult'>Username Already Exists.Try Another Username!!!</p>";
                }
                }
        
                ?></span>
                <input type="text" class="addAdmin" name="password" placeholder="Enter Your Password" id="oldpass"><br>
                <input type="text" class="addAdmin" name="newuname" placeholder="Enter New Administartor Username" id="newUname"><br>
                <input type="text" class="addAdmin" name="newpassword" placeholder="Enter New Administartor password" id="newPass"><br>
                <input type="text" class="addAdmin" name="newcpassword" placeholder="Confirm New Administartor password" id="newPassCon"><br>
                <input type="submit" class="addAdmin" value="Add Administrator" name="add"><br>
                <input type="reset" class="addAdmin" value="Reset"><br>
                </form>
</div>

<div id="footerAdmin">

</div>
</body>
<?php
}

    else
        header("location:login_Admin.php");
   
?>

</html>