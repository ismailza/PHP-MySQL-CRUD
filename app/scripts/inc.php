<?php
  session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();
  if (!isset($_SESSION['auth']))
  {
    $_SESSION['url'] = $_SERVER['REQUEST_URI'];
    $_SESSION['warning'] = "You must be logged in to access this page";
    header("location: signin.php");
    exit();
  }