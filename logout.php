<?php
  session_start();
  unset($_SESSION["userid"]);
  unset($_SESSION["username"]);
  unset($_SESSION["userlevel"]);
  unset($_SESSION["usermusician"]);
  unset($_SESSION["userpoint"]);

//session_destroy();

  echo("
       <script>
          location.href = 'index.php';
         </script>
       ");
?>
