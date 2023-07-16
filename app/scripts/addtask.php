<?php
  session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();
  if (isset($_POST['addtask']))
  {
    require_once 'connect.inc.php';
    $title        = $_POST['title'];
    $description  = $_POST['description'];
    $stm = $pdo->prepare("INSERT INTO tasks VALUES ('', :title, :description, :idUser, CURRENT_TIMESTAMP)");
    $stm->bindValue(":title"      , $_POST['title']             , PDO::PARAM_STR);
    $stm->bindValue(":description", $_POST['description']       , PDO::PARAM_STR);
    $stm->bindValue(":idUser"     , $_SESSION['auth']['idUser'] , PDO::PARAM_INT);
    $stm->execute();
    $stm ? $_SESSION['success'] = "Your new task has been added successfully" : $_SESSION['error'] = "Something is wrong!!";
  }
  header("location: ../index.php");