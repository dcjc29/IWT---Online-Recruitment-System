<?php require "dbConnection.php"?>
<!DOCTYPE html>
<html>
<head>
<title>Admin-Company</title>
<link rel="stylesheet" type="text/css" href="CSS\Stylesheet.css">
<link rel="stylesheet" type="text/css" href="CSS\admin.css">
<script>
        function goBack(){
        window.history.back();
    }
    </script>
</head>

<body>
    <div style="position: fixed; width: 100%;">	    
        <header>
        <h1>HIRED.COM</h1>
        </header>
        <hr>
        <hr>
        </div>
<div class="contentMsg">

<h2>Admin Messages</h2>
<div class="message">
<a href="adminMenu.php"><img id = "back" src = "src\back.png"></a>
    <form class="message">
    <h3 class="message">Messages</h3><br>
    <table>
        <col width="20%">
        <col width="60%">
        <col width="20%">
        <tr>
            
            <th styles="width:20%;">From</th>
            <th styles="width:20%;">Message</th>
            <th styles="width:20%;">Options</th>
            <th hidden>ID</th>
        </tr>
        <?php
     
                $query = "SELECT * FROM message WHERE personTo = 'admin' ";
                $result = mysqli_query($con,$query);
                while($rows = mysqli_fetch_assoc($result)){
            ?>
              <tr>
                 
                  <td styles="width:20%;"><?php echo $rows['personFrom'];?></td>
                  <td styles="width:60%;"><?php echo $rows['message'];?></td>
                  <td styles="width:20%;"><?php echo "<input type='button' value='Reply' class='message'><br><input type='button' value='Delete' class='messageDel'>" ?></td>
                  <td hidden><?php echo $rows['messageID'];?></td>
              </tr>
      <?php  
            
         }
       ?> 
    </table>
    </form>
</div>
 
<div class="message2">
        <form class="message2">
            <h3 class="message2">Send A Message</h3><br>
            <input type="text" class="message2" placeholder="Enter Username">
            <textarea placeholder="Input Your Message"></textarea><br>
            <input type="button" class="message2" value="Send">
            <input type="reset" class="message2" value="Reset">
        </form>

</div>

</div>
<div id="footerAdmin">
       
       
               

</div>

</body>

</html>