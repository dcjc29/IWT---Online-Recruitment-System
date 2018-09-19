<?php
        include "dbConnection.php";
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
                            $query = "SELECT * FROM jobs";
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