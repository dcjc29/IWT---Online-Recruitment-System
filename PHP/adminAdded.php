<?php
  include "dbConnection.php";

    $pass = $_REQUEST["password"];
  
    $uname = $_REQUEST["newuname"];
    $newpass = $_REQUEST["newpassword"];

    $oldpass = mysqli_query($con,"SELECT passw FROM administrator WHERE uname = 'dure'");
   

    if ($pass == 1234){
       mysqli_query($con,"INSERT INTO administrator(uname,passw) VALUES('$uname','$newpass')");
       
    }
    else    
        echo "Failed";

?>