<?php
  session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();
  unset($_SESSION['auth']);
  session_destroy();
  header("location: ../signin.php");