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
<link rel="stylesheet" type="text/css" href="CSS\modalforms.css">

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
        <table class="adminCompany" id="adminCompany">
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
                  <td><?php echo "<input  onclick='openModal()'  id= 'delete' value='Delete Company' type='button' class='adminCompanyDel'>" ?></td>
                 
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
                  <td><?php echo "<input  onclick='openModal()'  id= 'delete' value='Delete Company' type='button' class='adminCompanyDel'>" ?></td>   
              </tr>
      <?php  
            }
            
         }
       ?> 
               
            </table>
            
        <div id="simpleModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Do You Want To Delete This Company?</h3>
            </div>
        
        
            <div class="modal-body">
                
            <span>Company ID</span>
            <span>Name</span>
            <span>Email</span>
            <span>Telephone No</span><br>
        
                <form method="post">
                <input type="text" name="cId" id="cId2" hidden>
                <input type="text" id="cId" disabled>
                <input type="text"  id="cName" disabled>
                <input type="text"  id="cMail" disabled>
                <input type="text"  id="cTel" disabled>
       
            </div>    
         
                    <div class="modal-footer">
                    <button name="confirm" class="confirmBtn">Confirm</button>
                    <?php
                    if(isset($_POST['confirm'])){
                        $id = $_POST['cId'];    
                        
                    
                        mysqli_query($con,"DELETE  FROM company WHERE comID ='$id'");
                        echo"<script>alert(\"Successfully Deleted\"); location.href=\"viewCompanyList.php\";</script>";
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
        var table = document.getElementById('adminCompany');
        var rowIndex;
        for (var i = 0; i < table.rows.length; i++) {
                table.rows[i].onclick = function () {
                    rowIndex = this.rowIndex;
                    document.getElementById("cId").value = this.cells[0].innerHTML;
                    document.getElementById("cId2").value = this.cells[0].innerHTML;
                    document.getElementById("cName").value = this.cells[2].innerHTML;
                    document.getElementById("cMail").value = this.cells[3].innerHTML;
                    document.getElementById("cTel").value = this.cells[4].innerHTML;
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