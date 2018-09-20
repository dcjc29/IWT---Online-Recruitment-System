<?php
    
    include "dbConnection.php";
    session_start();
    if(isset($_SESSION['unameC']))
    { 
      
    
?>      
<html>
<head>
<title>Home Page</title>
<link rel="stylesheet" type="text/css" href="CSS\Stylesheet.css">
<link rel="stylesheet" type="text/css" href="CSS\modalforms.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<?php 
    include "header.php";
?>
<div>
<table class="adminCompany" id="adminCompany">
        <col width="30%">
        <col width="30%">
        <col width="30%">
                <tr>
                    <th>Job ID</th>
                    <th>Candidate ID</th>
                    <th>Candidate Name</th>
                    <th>Options</th>
                </tr>
            <?php
                            $query = "SELECT a.jobID,a.CanID,j.jobSeekerName FROM appliedcandidates  a,jobseeker j WHERE a.CanID = j.jobSeekerID";
                            $results = mysqli_query($con,$query);
                            while($rows = mysqli_fetch_assoc($results)){
            ?>
              <tr>
                  <td><?php echo $rows['jobID'];?></td>
                  <td><?php echo $rows['CanID'];?></td>
                  <td><?php echo $rows['jobSeekerName'];?></td>
                  <td><?php echo "<input  onclick='openModal()'  id= 'view' value='Schedule Interview' type='button' class='adminCompanyDel'>
                  <input  onclick=''  id= 'delete' value='View CV' type='button' class='adminCompanyDel'>";?></td>
                 
              </tr>
    <?php }?>
             </table>  
             <div id="simpleModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Do You Want To Schedule Interview For This Candidate?</h3>
            </div>
        
        
            <div class="modal-body">
                <span>Job ID</span>  
                <span>Candidate ID</span>
                <span>Name</span>         
                <span>Date</span>
                <span>Time</span><br>
            
                    <form method="post">
                    <input type="text" name="canId" id="canId2" hidden>
                    <input type="text" name="comId" id="comId" hidden>
                    <input type="text" name="jobId" id="jId" hidden>
                    <input type="text" id="jId2" disabled>
                    <input type="text" id="canId" disabled>
                    <input type="text" id="canName" disabled>
                    <input type="date" name="iDate" id="iDate">
                    <input type="time" name="iTime" id="iTime">
       
            </div>    
         
                    <div class="modal-footer">
                    <button name="confirm" class="confirmBtn">Confirm</button>
                    <?php
                    if(isset($_POST['confirm'])){
                        $jID = $_POST['jobId'];    
                        $cID = $_POST['canId'];
                        $iDay = $_POST['iDate'];
                        $iTime = $_POST['iTime'];
                        $query = mysqli_query($con,"SELECT * FROM interviews WHERE jobID = '$jID' AND canID = '$cID'");
        
        
                        if(mysqli_num_rows($query) == 1){
                            mysqli_query($con,"UPDATE interviews SET iDate='$iDay',iTime='$iTime' WHERE jobID = '$jID' AND canID = '$cID'");
                            echo"<script>alert(\"Successfully Updated\");</script>";
                            
                        }
                        else{
                            mysqli_query($con,"INSERT INTO interviews(jobID,canID,iDate,iTime) VALUES('$jID','$cID','$iDay','$iTime')");
                            echo"<script>alert(\"Successfully Scheduled\");</script>";
                        }    
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
                    document.getElementById("jId2").value = this.cells[0].innerHTML;
                    document.getElementById("jId").value = this.cells[0].innerHTML;
                    document.getElementById("canId").value = this.cells[1].innerHTML;
                    document.getElementById("canId2").value = this.cells[1].innerHTML;
                    document.getElementById("canName").value = this.cells[2].innerHTML;
        
                }
            }
        }
                  
    
                  
                  
    function closeModal(){
        document.getElementById('simpleModal').style.display = 'none';
    }
    
        
</script>
</div>
<?php 
    include "footer.php";
?>
</body>

</html>
<?php
       
    }
    else
        {
            header("location:login_Employer.php");
        }
?>