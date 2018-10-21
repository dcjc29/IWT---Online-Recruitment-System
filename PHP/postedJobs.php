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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script>
    function myfunc(){
        window.location.href = "appliedCandidates.php";
    }
</script>
</head>

<body>
<?php 
    include "header.php";
?>
<div>
<table class="adminCompany" id="adminCompany">
        <col width="25%">
        <col width="25%">
        <col width="25%">
        <col width="25%">
                <tr>
                    <th>Job ID</th>
                    <th>Job Title</th>
                    <th>Job Description</th>
                    <th>Options</th>
                </tr>
            <?php
            $uname=$_SESSION['unameC'];
                            $query = "SELECT j.jobID,j.jobTitle,j.jobDes FROM jobs j WHERE  j.comID = (SELECT comID FROM company WHERE uName = '$uname') ";
                            $results = mysqli_query($con,$query);
                            while($rows = mysqli_fetch_assoc($results)){
            ?>
              <tr>
                  <td><?php echo $rows['jobID'];?></td>
                  <td><?php echo $rows['jobTitle'];?></td>
                  <td><?php echo $rows['jobDes'];?></td>
                  <td><?php echo "<input id= 'view' value='View Candidates' type='submit' class='adminCompanyDel' onclick='myfunc()'>"?></td>
                 
              </tr>
    <?php }?>
             </table>  
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