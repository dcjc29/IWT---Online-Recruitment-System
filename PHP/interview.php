<?php
    
    include "dbConnection.php";
    session_start();
    if(isset($_SESSION['unameC']))
    { 
        
      
?>  
<?php
    include "header.php";
?>
<table>
                <col width="100px">
                <col width="300px">
                <col width="300px">
                <col width="300px">
                <col width="300px">
                <tr style="border:solid black 1px">
                    <th style="border:solid black 1px">Candidate ID</th>
                    <th style="border:solid black 1px">Job ID</th>
                    <th style="border:solid black 1px">Candidate Name</th>
                    <th style="border:solid black 1px">Date</th>
                    <th style="border:solid black 1px">Time</th>
                </tr>
                <?php

$date = $_GET['date'];
$month = $_GET['month'];
$year = $_GET['year'];
if($month < 10){
    $month="0$month";
}
if($date < 10){
    $date="0$date";
}
$intDate = "$year-$month-$date";
$uname=$_SESSION['unameC'];
echo"<br><br><b>INTERVIEW DATE  : $intDate</b><br><br>";

                            $query = "SELECT i.canID,i.jobID,j.jobSeekerName,i.iDate,i.iTime  FROM interviews i,jobseeker j,company c WHERE j.jobSeekerID = i.canID AND c.uName = '$uname'  AND i.idate = '$intDate'";
                            $result = mysqli_query($con,$query);
                            while($rows = mysqli_fetch_assoc($result)){
            ?>
              <tr style="border:solid black 1px">
                  <td style="border:solid black 1px"><?php echo $rows['canID'];?></td>
                  <td style="border:solid black 1px"><?php echo $rows['jobID'];?></td>
                  <td style="border:solid black 1px"><?php echo $rows['jobSeekerName'];?></td>
                  <td style="border:solid black 1px"><?php echo $rows['iDate'];?></td>
                  <td style="border:solid black 1px"><?php echo $rows['iTime'];?></td>
              </tr>
      <?php  
            

         }       
       ?> 
         </table>
<?php
include "footer.php";
    }
?>
       
   
        
                 