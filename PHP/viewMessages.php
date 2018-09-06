<?php  require "dbCOnnection.php";
    session_start();
    if(isset($_SESSION['uname']))
{
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin-Company</title>
    <link rel="stylesheet" type="text/css" href="CSS\Stylesheet.css">
    <link rel="stylesheet" type="text/css" href="CSS\admin.css">
    <link rel="stylesheet" type="text/css" href="CSS\modalforms.css">
    <script type="text/javascript">
        function replyMsg() {
            var table = document.getElementById('message');
            var rowIndex;
            for (var i = 0; i < table.rows.length; i++) {
                table.rows[i].onclick = function () {
                    rowIndex = this.rowIndex;
                    document.getElementById("toField").value = this.cells[0].innerHTML;
                    document.getElementById("replyId").value = this.cells[3].innerHTML;
                }
            }
        }
    </script>
</head>

<body>
<?php
        include "adminHeader.php";
    ?>
<div class="contentMsg">
    <h2>Admin Messages</h2>
    <div class="message">
        <a href="adminMenu.php"><img id="back" src="src\back.png"></a>
        <form class="message">
            <h3 class="message">Messages</h3><br>
            <table id="message">
                <col width="20%">
                <col width="60%">
                <col width="20%">
                <tr>

                    <th styles="width:20%;">From</th>
                    <th styles="width:20%;">Message</th>
                    <th styles="width:20%;">Options</th>
                    <th hidden>ID</th>
                </tr>
                <?php

                $query = "SELECT * FROM messages WHERE toPerson = 'admin' AND replied = 0 ";
                $result = mysqli_query($con, $query);
                while ($rows = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>

                        <td styles="width:20%;"><?php echo $rows['fromPerson']; ?></td>
                        <td styles="width:60%;"><?php echo $rows['msg']; ?></td>
                        <td styles="width:20%;"><?php echo "<input type='button'  onclick=\"replyMsg()\"  type='button' class='message' value='Reply' id='reply'>";
                            echo "<br><input type='button' onclick='openModal()' value='Delete' class='messageDel'>"; ?></td>
                        <td hidden><?php echo $rows['msgID']; ?></td>
                    </tr>

                    <?php
                }
                ?>
            </table>
        </form>
        <div id="simpleModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Do You Want To Delete This Message?</h3>
            </div>
        
        
            <div class="modal-body">
                
            <span>Message ID</span>
            <span>From</span>
            <span>Message</span><br>
        
                <form method="post">
                <input type="text" name="mId" id="mId2" hidden>
                <input type="text" id="mId" disabled>
                <input type="text"  id="mFrom" disabled>
                <input type="text"  id="msgC" disabled>
       
            </div>    
         
                    <div class="modal-footer">
                    <button name="confirm" class="confirmBtn">Confirm</button>
                    <?php
                    if(isset($_POST['confirm'])){
                        $id = $_POST['mId'];    
                        
                    
                        mysqli_query($con,"DELETE  FROM messages WHERE msgID ='$id'");
                        echo"<script>alert(\"Successfully Deleted\"); location.href=\"viewMessages.php\";</script>";
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
        var table = document.getElementById('message');
        var rowIndex;
        for (var i = 0; i < table.rows.length; i++) {
                table.rows[i].onclick = function () {
                    rowIndex = this.rowIndex;
                    document.getElementById("mId").value = this.cells[3].innerHTML;
                    document.getElementById("mId2").value = this.cells[3].innerHTML;
                    document.getElementById("mFrom").value = this.cells[0].innerHTML;
                    document.getElementById("msgC").value = this.cells[1].innerHTML;
                }
            }
        }
                  
    
                  
                  
    function closeModal(){
        document.getElementById('simpleModal').style.display = 'none';
    }
    
        
</script>

    <div class="message2">
    
        <form class="message2" method="post">
            <h3 class="message2">Send A Message</h3><br>
            <?php
            if (isset($_POST['sendMsg'])) {
                $toPerson = $_POST['toPerson'];
                $replied = $_POST['msgId'];
                $name = $_SESSION['uname'];
                $query = "SELECT * FROM administrator WHERE uname = '$name'";
                $result = mysqli_query($con, $query);
                if (mysqli_num_rows($result) == 1) {
                    $fromPerson = 'admin';
                } else {
                    $fromPerson = $name;
                }
                $msg = $_POST['msg'];
                $query = "INSERT INTO messages(toPerson,fromPerson,msg) VALUES('$toPerson','$fromPerson','$msg')";
                $result = mysqli_query($con, $query);
                if ($result) {

                    $query = "UPDATE messages SET replied = '1' WHERE msgID='$replied'";
                    mysqli_query($con, $query);
                    echo "<p class='Result'>Message Succesfully Sent.</p>";

                } else {

                    echo "<p class='noResult'>Message Sending Failed.</p>";

                }

            

            }
            ?>
            <input id="replyId" type="text" name="msgId" hidden>
            <input id="toField" type="text" class="message2" placeholder="Enter Username" name="toPerson" required>
            <textarea placeholder="Input Your Message" name="msg" required></textarea><br>
            <input type="submit" class="message2" value="Send" name="sendMsg">
            <input type="reset" class="message2" value="Reset">
           
        </form>
        
    </div>

<?php
    include "adminFooter.php";
?>         
</div>
        

</body>
</html>
<?php
    }
    else
        header("location:login_Admin.php");

?>