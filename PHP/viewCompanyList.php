<?php
    include "dbConnection.php";
?>
<html>
<head>
<title>Admin-Company</title>
<link rel="stylesheet" type="text/css" href="CSS\Stylesheet.css">
<link rel="stylesheet" type="text/css" href="CSS\admin.css">


</head>

<body>
<?php
        include "adminHeader.php";
    ?>
<div class="content">       
<h2>Company List</h2>
<a href="adminMenu.php"><img id = "back" src = "src\back.png"></a>
<div class="search">
        
    <form class="search" method="GET">
    <h3 class="search">Search Console</h3><br>
    <input type="text" class="search" placeholder="Enter Company Name" name="passTxt" required>
    <input type="submit" value="Search" class="search" name="search">
    <input type="reset"  value="Reset" class="search">
    </form>
    <form action="" method="post">
    <input type="submit"  value="View All"  name ="view" class="addAdmin">
    </form>
</div>
<div class="adminCompany">
        <table class="adminCompany">
                <tr>
                    <th>Company ID</th>
                    <th>Company Logo</th>
                    <th>Company Name</th>
                    <th>E-mail</th>
                    <th>Telephone Number</th>
                    <th>Options</th>
                </tr>
            <?php
                if(isset($_POST['view'])){
                
                            $query = "SELECT * FROM company";
                            $result = mysqli_query($con,$query);
                            while($rows = mysqli_fetch_assoc($result)){
            ?>
              <tr>
                  <td><?php echo $rows['comID'];?></td>
                  <td><?php echo"<img class = dec2 src = 'data:image/jpeg;base64,".base64_encode($rows['comLogo'])."'>"?></td>
                  <td><?php echo $rows['comName'];?></td>
                  <td><?php echo $rows['comMail'];?></td>
                  <td><?php echo $rows['comTel'];?></td>
                  <td><?php echo "<input type='button' value='Delete Company'  class='adminCompany'>" ?></td>
                 
              </tr>
      <?php  
            }
         }
       ?> 
        <?php
                if(isset($_GET['search'])){
                
                    $passText = $_GET['passTxt'];
                    $query = "SELECT * FROM company WHERE comName LIKE '%" .$passText. "%'";
                    $result = mysqli_query($con,$query);
              	    while($rows = mysqli_fetch_assoc($result)){
            ?>
              <tr>
                  <td><?php echo $rows['comID'];?></td>
                  <td><?php echo"<img class = dec2 src = 'data:image/jpeg;base64,".base64_encode($rows['comLogo'])."'>"?></td>
                  <td><?php echo $rows['comName'];?></td>
                  <td><?php echo $rows['comMail'];?></td>
                  <td><?php echo $rows['comTel'];?></td>
                  <td><?php echo "<input type='button' value='Delete Company'  class='adminCompany' id='button'>" ?></td>
                 
              </tr>
      <?php  
            }
         }
       ?> 
               
            </table>
                  
</div>    
 

</div>
<div id="footer">
       
       
               

</div>

</body>

</html>