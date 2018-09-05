
 <div style="position: fixed; width: 100%;">	    
        <header>
        <h1>HIRED.COM</h1>
        <div style="float: right;">
<img href="">    
<?php
    if(isset($_SESSION['uname'])){
        echo $_SESSION['uname'];
    }
    else{
    echo"<a class='account' href='login.php'>Log In</a>&nbsp&nbsp;";
    echo "<a class='account' href='Registration.html'>Register</a>";
    }
?>

</div>
        </header>
        <hr>
        
        <hr>
        </div>