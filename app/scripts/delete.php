<?php
  session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();
  if (isset($_POST['deletetask']))
  {
    require_once 'connect.inc.php';
    $stm = $pdo->prepare("DELETE FROM tasks WHERE idTask = :idTask");
    $stm->bindValue(":idTask", $_POST['idTask'], PDO::PARAM_INT);
    $stm->execute();
    $stm ? $_SESSION['success'] = "Your task has been deleted successfully" : $_SESSION['error'] = "Something is wrong!!";
  }
  header("location: ../index.php");