<?php
    
    include "dbConnection.php";
    session_start();
    if(isset($_SESSION['unameC']))
    { 
        $GLOBALS['intDate']="0000-00-00";
      
?>         
<!DOCTYPE html>
<html>
<head>
<title>Company Menu</title>
<link rel="stylesheet" type="text/css" href="CSS\Stylesheet.css">
<link rel="stylesheet" type="text/css" href="CSS\Company.css">
<link rel="stylesheet" type="text/css" href="CSS\modalforms.css">
<script type="text/javascript">
        function goLastMonth(month,year){
            if(month == 1){
                --year;
                month = 12;
            }
            document.location.href = "<?php $_SERVER['PHP_SELF'];?>?month="+(month-1)+"&year="+year;

        }
        function goNextMonth(month,year){
            if(month == 12){
                ++year;
                month = 0;
            }
            document.location.href = "<?php $_SERVER['PHP_SELF'];?>?month="+(month+1)+"&year="+year;
        }
    </script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<?php 
    include "header.php";
?>
<div class="content">
<h2>Company Menu</h2>
<div class="details">
    <h3>Company Name</h3><br>
    <img src="src\img_457957.png" class="details">
    <p>Other Details</p>
    <input type="button" value="Log Out" class="details" onClick="location.href='logout.php'">
</div>    
<div class="menu">
<ul class="menu">
        <a href="postJob.html" class="menu"><li class="menu">Post A Job</li></a>
        <a href="postedJobs.php" class="menu"><li class="menu">View Posted Jobs</li></a>
        <a href="companyUpdateInfo.html" class="menu"><li class="menu">Update Information</li></a>
        <a href="companyContactAdmin.html" class="menu"><li class="menu">Contact Administrator</li></a>
        <a href="https:\\www.gmail.com" target="#" class="menu"><li class="menu">E-mails</li></a>
        <a href="companyMessages.html" class="menu"><li class="menu">Messages</li></a>
  
</ul>
</div>
<div >
    <h3>Interview Schedule</h3><br>
    <?php
    
        $day = date("d");
    
    if(isset($_GET['month'])){
        $month = $_GET['month'];
    }
    else{
        $month = date("m");
    }
    if(isset($_GET['year'])){
        $year = $_GET['year'];
    }
    else{
        $year = date("Y");
    }

    $currentTimeStamp = strtotime("$year-$month-$day");
    $monthName = date("F", $currentTimeStamp);
    $numDays = date("t", $currentTimeStamp);
    $counter = 0;

?>

<table border = '1px' id='calendar'>
    <tr>
        <td><input onclick = 'goLastMonth(<?php echo $month.",".$year ?>)' style='width:50px' type = 'button' value='<' name='previousbutton'></td>
        <td colspan='5'><?php echo $monthName."/".$year; ?></td>
        <td><input onclick = 'goNextMonth(<?php echo $month.",".$year ?>)' style='width:50px'  type = 'button' value='>' name='nextbutton'></td>
        
    </tr>

    <tr>
        <td width='50px'>Sun</td>
        <td width='50px'>Mon</td>
        <td width='50px'>Tue</td>
        <td width='50px'>Wed</td>
        <td width='50px'>Thu</td>
        <td width='50px'>Fri</td>
        <td width='50px'>Sat</td>
    
    </tr>
    <?php 
        echo "<tr>";
            for($i = 1 ; $i < $numDays + 1 ; $i++,$counter++)
            
            {
                
                $timeStamp = strtotime("$year-$month-$i");

                if($i == 1){
                    $firstDay = date("w", $timeStamp);
                    for($j = 0 ; $j < $firstDay ; $j++,$counter++){
                        echo"<td style='width:50px'></td>";
                    }
                }
                if($counter % 7 == 0){
                    echo "</tr><tr>";
                }
                echo "<td align = 'center'><a href = interview.php?date=$i&month=$month&year=$year>$i</a></td>";
               
                
            }
        echo "</tr>";
    ?>

</table> 

          
</div>    
</div>
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