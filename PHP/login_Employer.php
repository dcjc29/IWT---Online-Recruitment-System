<?php
    
    include "dbConnection.php";
    session_start();
    if(isset($_SESSION['unameC']))
    { 
        header("location:companyMenu.php");
    }
    else
        {
?>
<!DOCTYPE html>
<html>
<head>
<title>Log In</title>
<link rel="stylesheet" type="text/css" href="CSS\Stylesheet.css">
<link rel="stylesheet" type="text/css" href="CSS\Secondary.css">
<link rel="stylesheet" type="text/css" href="CSS\admin.css">
<script type="text/javascript">

function validateLogin(){
    var uname = document.getElementById('unametxt').value;
    var pass = document.getElementById('passtxt').value;


    if(uname == "" || pass == ""){
        alert("Both Fields Should Be Filled");
        return false;
    } 
    else    
        return true;   

}
   
</script>

</head>

<body>
<?php
    include "header.php";
?>    
<div>
<form name="loginForm" id="loginF" class="login" onsubmit="return validateLogin();" method="post">
	<h1 class="login">Log In</h1>
	<br>
	<?php
    if(isset($_POST['login']))
    {
        $uname = $_REQUEST["unametxt"];
        $pass = $_REQUEST["passtxt"];

        $query = mysqli_query($con,"SELECT * FROM company WHERE uName = '$uname' AND passW = '$pass'");
        
        
        if(mysqli_num_rows($query) == 1){
            session_start();
            $_SESSION['unameC'] = $uname;
            header('location:companyMenu.php'); 
         }   
         else{
            echo "<p class='noResult'>Invalid Username or Password.Try Again!!!</p><br>";
         }    
    }
?>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Account Type<br>
	<select id="accType" class="login" disabled>
		<option value="jobSeeker" >Job Seeker</option>
		<option value="company" selected>Company/Employee</option>
		<option value="admin">Administrator</option>
	</select>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Username<br>
	<input type="text" id="unametxt" name="unametxt" placeholder="Enter Username" class="login" ><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Password<br>
	<input type="password" id="passtxt" name="passtxt" placeholder="Enter Password" class="login" ><br>
    <input name="login" type="submit" value="Login" class="login">&nbsp&nbsp;
	<input type="reset" value="Reset" class="login">
	<a ><input type="button" value="Forgot Password" class="login"></a>
	<h3>&nbsp;&nbsp;&nbsp;&nbsp;Don't have an account ? <a href="Registration.html">Register Now</a></h3>
	
</form>
<div style="float: right; display: inline; margin-top: 150px; margin-right: 50px; height: 400px;width: 400px;">
        <img src="src\login.png">
        
</div>
    

<div>
<?php
    include "footerclass.php";
?>
</div>

</body>

</html>
<?php
        }
?>