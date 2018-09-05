<?php
        include "dbConnection.php";
        session_start();
        if(isset($_SESSION['uname']))
{
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
        
    <form class="search" method="post">
    <h3 class="search">Search Console</h3><br>
    <input type="text" class="search" placeholder="Enter Company Name" name="searchTxt" required>
    <input type="submit" value="Search" class="search" name="search">
    <input type="reset"  value="Reset" class="search">
    </form>
    <form action="" method="post">
    <input type="submit"  value="View All"  name ="view" class="addAdmin">
    </form>
</div>
<div class="adminCompany">
        <table class="adminCompany">
        <col width="5%">
        <col width="15%">
        <col width="20%">
        <col width="20%">
        <col width="20%">
        <col width="20%">
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
                            $results = mysqli_query($con,$query);
                            while($rows = mysqli_fetch_assoc($results)){
            ?>
              <tr>
                  <td><?php echo $rows['comID'];?></td>
                  <td><?php echo"<img class = dec2 src = 'data:image/jpeg;base64,".base64_encode($rows['comLogo'])."'>"?></td>
                  <td><?php echo $rows['comName'];?></td>
                  <td><?php echo $rows['comMail'];?></td>
                  <td><?php echo $rows['comTel'];?></td>
                  <td><?php echo "<input type='button' value='Delete Company'  class='adminCompanyDel'>" ?></td>
                 
              </tr>
      <?php  
            }

         }       
       ?> 
        <?php
                if(isset($_POST['search'])){
                    $comNameText = $_POST['searchTxt'];
                    $query = "SELECT * FROM company WHERE comName LIKE '%" .$comNameText. "%'";
                    $result = mysqli_query($con,$query);
                    if(mysqli_num_rows($result) == 0){
                        echo "<p class='noResult'>No Records Found!!!,Try Another Keyword.</p>";
                    }
              	    while($rows = mysqli_fetch_assoc($result)){
            ?>
              <tr>
                  <td><?php echo $rows['comID'];?></td>
                  <td><?php echo"<img class = dec2 src = 'data:image/jpeg;base64,".base64_encode($rows['comLogo'])."'>"?></td>
                  <td><?php echo $rows['comName'];?></td>
                  <td><?php echo $rows['comMail'];?></td>
                  <td><?php echo $rows['comTel'];?></td>
                  <td><?php echo "<input type='button' value='Delete Company'  class='adminCompanyDel' id='button'>" ?></td>   
              </tr>
      <?php  
            }
            
         }
       ?> 
               
            </table>
                  
</div>    
 

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