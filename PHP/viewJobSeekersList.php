<?php
    require "dbConnection.php";
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin-Candidate</title>
<link rel="stylesheet" type="text/css" href="CSS\Stylesheet.css">
<link rel="stylesheet" type="text/css" href="CSS\admin.css">
</head>

<body>
<?php
        include "adminHeader.php";
    ?>
<div class="content">

<h2>Job Seekers List</h2>
<a href="adminMenu.php"><img id = "back" src = "src\back.png"></a>
<div class="search">
    <form class="search"  action="" method="get">
    <h3 class="search">Search Console</h3><br>
    <input id="searchTxt" type="text" class="search" placeholder="Enter Candidate Name" name="seekerName"required>
    <input type="submit"  value="Search" class="search" name="search">
    <input type="reset"  value="Reset" class="search">
    </form>
    <form action="" method="post">
    <input type="submit"  value="View All"  name ="view" class="addAdmin">
    </form>
</div>
<div class="adminCandidate">
        <table class="adminCandidate">
        <tr>
                    <th>Job Seeker ID</th>
                    <th>Personal Image</th>
                    <th>Name</th>
                    <th>E-mail</th>
                    <th>Telephone Number</th>
                    <th>Options</th>
                </tr>
            <?php
                if(isset($_POST['view'])){
     
                            $query = "SELECT * FROM jobseeker";
                            $result = mysqli_query($con,$query);
                            while($rows = mysqli_fetch_assoc($result)){
            ?>
              <tr>
                  <td><?php echo $rows['jobSeekerID'];?></td>
                  <td><?php echo"<img class = dec src = 'data:image/jpeg;base64,".base64_encode($rows['jobSeekerPic'])."'>"?></td>
                  <td><?php echo $rows['jobSeekerName'];?></td>
                  <td><?php echo $rows['jobSeekerMail'];?></td>
                  <td><?php echo $rows['jobSeekerTel'];?></td>
                  <td><?php echo "<input type='button' value='Delete Job Seeker'  class='adminCompany'>" ?></td>
                 
              </tr>
      <?php  
            }
         }
       ?> 
        <?php
                if(isset($_GET['search'])){
                
                    $nameText = $_GET['seekerName'];
                    $query = "SELECT * FROM jobseeker WHERE jobSeekerName LIKE '%" .$nameText. "%'";
                    $result = mysqli_query($con,$query);
              	    while($rows = mysqli_fetch_assoc($result)){
            ?>
              <tr>
              <td><?php echo $rows['jobSeekerID'];?></td>
                  <td><?php echo"<img class = dec src = 'data:image/jpeg;base64,".base64_encode($rows['jobSeekerPic'])."'>"?></td>
                  <td><?php echo $rows['jobSeekerName'];?></td>
                  <td><?php echo $rows['jobSeekerMail'];?></td>
                  <td><?php echo $rows['jobSeekerTel'];?></td>
                  <td><?php echo "<input type='button' value='Delete Job Seeker'  class='adminCompany'>" ?></td>
                 
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