<?php
  session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();
  if (isset($_POST['updatetask']))
  {
    require_once 'connect.inc.php';
    $stm = $pdo->prepare("UPDATE tasks SET title = :title, description = :description WHERE idTask = :idTask");
    $stm->bindValue(":title"      , $_POST['title']       , PDO::PARAM_STR);
    $stm->bindValue(":description", $_POST['description'] , PDO::PARAM_STR);
    $stm->bindValue(":idTask"     , $_POST['idTask']      , PDO::PARAM_INT);
    $stm->execute();
    $stm ? $_SESSION['success'] = "Your task has been updated successfully" : $_SESSION['error'] = "Something is wrong!!";
  }
  header("location: ../index.php");