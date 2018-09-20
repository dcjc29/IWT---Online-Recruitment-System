<!DOCTYPE html>
<html>
<head>
<title>Home Page</title>
<link rel="stylesheet" type="text/css" href="CSS\Stylesheet.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<div style="width: 100%;">	    
<header>
<h1 style="display:inline;">HIRED</h1>
<div style="float: right; display:inline;">   
<?php
    if(isset($_SESSION['unameC'])){
        $uName = $_SESSION['unameC'];
                            $query = "SELECT * FROM company WHERE uName = '$uName'";
                            $results = mysqli_query($con,$query);
                            while($rows = mysqli_fetch_assoc($results)){
                                echo"<span><img style = 'height:35px;width:80px; display:inline;' src = 'data:image/jpeg;base64,".base64_encode($rows['comLogo'])."'></span>";
                               echo"&nbsp;&nbsp;";echo "<h3 style='display:inline;'>";echo $rows['comName'];echo"</h3><br>";
                                echo"<a href='logout.php' style='text-decoration:none; color:white;'>Log Out</a>";
    }
}
    else{
    echo"<a class='account' href='login.php'>Log In</a>&nbsp&nbsp;";
    echo "<a class='account' href='Registration.html'>Register</a>";
    }
?>
</div>
</header>
<hr>
<div>
<nav>
    <ul>
        <li><a href="homepage.php" >Home</a></li>
        <li><a href="jobs.html" >Jobs</a></li>
        <li><a href="companies.html" >Companies</a></li>
        <li><a href="AboutUs.html">About Us</a></li>
        <li><a href="contactUs.php">Contact Us</a></li>
    </ul>    
</nav>
</div>
