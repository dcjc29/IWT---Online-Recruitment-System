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
<div style="position: fixed; width: 100%;">
    <header>
        <h1>HIRED.COM</h1>
    </header>
    <hr>
    <hr>
</div>
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
                            echo "<br><input type='button' value='Delete' class='messageDel'>"; ?></td>
                        <td hidden><?php echo $rows['msgID']; ?></td>
                    </tr>

                    <?php
                }
                ?>
            </table>
        </form>
    </div>

    <div class="message2">
    
        <form class="message2" method="post">
            <h3 class="message2">Send A Message</h3><br>
            <input id="replyId" type="text" name="msgId" hidden>
            <input id="toField" type="text" class="message2" placeholder="Enter Username" name="toPerson">
            <textarea placeholder="Input Your Message" name="msg"></textarea><br>
            <input type="submit" class="message2" value="Send" name="sendMsg">
            <input type="reset" class="message2" value="Reset">
        </form>
        <?php
        if (isset($_POST['sendMsg'])){
        $toPerson = $_POST['toPerson'];
        $replied = $_POST['msgId'];
        $name = $_SESSION['uname'];
        $query = "SELECT * FROM administrator WHERE uname = '$name'";
        $result = mysqli_query($con,$query);    
        if (mysqli_num_rows($result) == 1) {
            $fromPerson = 'admin';
        } else {
            $fromPerson = $name;
        }
        $msg = $_POST['msg'];
        $query = "INSERT INTO messages(toPerson,fromPerson,msg) VALUES('$toPerson','$fromPerson','$msg')";
        $result= mysqli_query($con, $query);
        if($result){
           
            $query="UPDATE messages SET replied = '1' WHERE msgID='$replied'";
            mysqli_query($con,$query);
            echo "<p class='Result'>Message Succesfully Sent.</p>";
           
        }
        else{
        
        echo"<p class='noResult'>Message Sending Failed.</p>";
     
        }
        ?>
    </div>

<div id="footerAdmin">


</div>

</div>
</body>
<?php
}
}
    else
        header("location:login_Admin.php");
   
?>
</html>