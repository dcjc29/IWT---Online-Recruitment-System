<?php
        include "dbConnection.php";
        session_start();
        if(isset($_SESSION['uname']))
{
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin-Candidate</title>
<link rel="stylesheet" type="text/css" href="CSS\Stylesheet.css">
<link rel="stylesheet" type="text/css" href="CSS\admin.css">
<link rel="stylesheet" type="text/css" href="CSS\modalforms.css">
</head>

<body>
<?php
        include "adminHeader.php";
    ?>
<div class="content">

<h2>Job Seekers List</h2>
<a href="adminMenu.php"><img id = "back" src = "src\back.png"></a>
<div class="search">
    <form class="search"  action="" method="post">
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
        <table class="adminCandidate" id="adminCandidate">
        <col width="5%">
        <col width="15%">
        <col width="20%">
        <col width="20%">
        <col width="20%">
        <col width="20%">
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
                  <td><?php echo "<input type='button' onclick='openModal()' value='Delete Job Seeker'  class='adminCompanyDel'>" ?></td>
                 
              </tr>
      <?php  
            }
         }
       ?> 
        <?php
                if(isset($_POST['search'])){
                
                    $nameText = $_POST['seekerName'];
                    $query = "SELECT * FROM jobseeker WHERE jobSeekerName LIKE '%" .$nameText. "%'";
                    $result = mysqli_query($con,$query);
                    if(mysqli_num_rows($result) == 0){
                        echo "<p class='noResult'>No Records Found!!!,Try Another Keyword.</p>";
                    }
              	    while($rows = mysqli_fetch_assoc($result)){
            ?>
              <tr>    
              <td><?php echo $rows['jobSeekerID'];?></td>
                  <td><?php echo"<img class = dec src = 'data:image/jpeg;base64,".base64_encode($rows['jobSeekerPic'])."'>"?></td>
                  <td><?php echo $rows['jobSeekerName'];?></td>
                  <td><?php echo $rows['jobSeekerMail'];?></td>
                  <td><?php echo $rows['jobSeekerTel'];?></td>
                  <td><?php echo "<input type='button' onclick='openModal()' value='Delete Job Seeker'  class='adminCompanyDel'>" ?></td>
              </tr>
      <?php  
       
            }
         }
       ?> 
               
            </table>
            <div id="simpleModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Do You Want To Delete This Job Seeker?</h3>
            </div>
        
        
            <div class="modal-body">
                
            <span>Job Seeker ID</span>
            <span>Name</span>
            <span>Email</span>
            <span>Telephone No</span><br>
        
                <form method="post">
                <input type="text" name="sId" id="sId2" hidden>
                <input type="text" id="sId" disabled>
                <input type="text"  id="sName" disabled>
                <input type="text"  id="sMail" disabled>
                <input type="text"  id="sTel" disabled>
       
            </div>    
         
                    <div class="modal-footer">
                    <button name="confirm" class="confirmBtn">Confirm</button>
                    <?php
                    if(isset($_POST['confirm'])){
                        $id = $_POST['sId'];    
                        
                        mysqli_query($con,"DELETE  FROM jobseeker WHERE jobSeekerID ='$id'");
                        echo"<script>alert(\"Successfully Deleted\"); location.href=\"viewJobSeekersList.php\";</script>";
                }    ?> 
                    </form>
                    <button class="closeBtn" onclick="closeModal()">Cancel</button>
                    
                    
                
            
                
                    </div>  
            </div>
           </div>
</div>    

<script type="text/javascript">

              
    function openModal(){
                      
        var modal = document.getElementById('simpleModal');
        var closeBtn = document.getElementsByClassName('closeBtn');
        modal.style.display = 'block';
        var table = document.getElementById('adminCandidate');
        var rowIndex;
        for (var i = 0; i < table.rows.length; i++) {
                table.rows[i].onclick = function () {
                    rowIndex = this.rowIndex;
                    document.getElementById("sId").value = this.cells[0].innerHTML;
                    document.getElementById("sId2").value = this.cells[0].innerHTML;
                    document.getElementById("sName").value = this.cells[2].innerHTML;
                    document.getElementById("sMail").value = this.cells[3].innerHTML;
                    document.getElementById("sTel").value = this.cells[4].innerHTML;
                }
            }
        }
                  
    
                  
                  
    function closeModal(){
        document.getElementById('simpleModal').style.display = 'none';
    }
    
        
</script>
   
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