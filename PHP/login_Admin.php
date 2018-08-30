<?php
    
    include "dbConnection.php";
?>
<!DOCTYPE html>
<html>
<head>
<title>Log In</title>
<link rel="stylesheet" type="text/css" href="CSS\Stylesheet.css">
<link rel="stylesheet" type="text/css" href="CSS\Secondary.css">
</head>

<body>
<?php
    include "header.php";
?>    
<div>
<form name="loginForm" id="loginF" class="login" method="post">
	<h1 class="login">Log In</h1>
	<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Account Type<br>
	<select id="accType" class="login" disabled>
		<option value="jobSeeker">Job Seeker</option>
		<option value="company">Company/Employee</option>
		<option value="admin" selected>Administrator</option>
	</select>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Username<br>
	<input type="text" id="unametxt" name="unametxt" placeholder="Enter Username" class="login" required><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Password<br>
	<input type="password" id="passtxt" name="passtxt" placeholder="Enter Password" class="login" required><br>
    <input name="login" type="submit" value="Login" class="login">&nbsp&nbsp;
	<input type="reset" value="Reset" class="login">
	<a ><input type="button" value="Forgot Password" class="login"></a>
	<h3>&nbsp;&nbsp;&nbsp;&nbsp;Don't have an account ? <a href="Registration.html">Register Now</a></h3>
	
</form>

<?php
    if(isset($_POST['login']))
    {
        $uname = $_REQUEST["unametxt"];
        $pass = $_REQUEST["passtxt"];

        $query = mysqli_query($con,"SELECT * FROM administrator WHERE uname = '$uname' AND passw = '$pass'");
        
        
        if(mysqli_num_rows($query) == 1){
            $_SESSION["uname"] = $uname;
            header('location:adminMenu.php'); 
         }   
         else{
            echo "<script>
            alert('Invalid Username or Password.Try Again!!!');
            </script>";
         }    
    }
?>
<div style="float: right; display: inline; margin-top: 150px; margin-right: 50px; height: 400px;width: 400px;">
        <img src="src\login.png">
        
</div>
<div>
<?php
    include 'footerclass.php';
?>
</div>

</body>

</html>
