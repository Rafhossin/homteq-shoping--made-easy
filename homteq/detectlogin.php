<?php

if(isset($_SESSION['userid'])) {
          // User is logged in, display welcome message
          echo "<p class='updateInfo1'>Welcome, ".$_SESSION['fname']." ".$_SESSION['sname'].". You are currently logged in. <a href='logout.php'>Logout</a></p>";
         
        }

?>



