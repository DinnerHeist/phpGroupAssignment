<?php
   session_start();
   header("Location: registration.php");
   session_unset();
   session_destroy();
?>
