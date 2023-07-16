<?php
  require_once 'connect.inc.php';
  $post_data = json_decode(file_get_contents('php://input'), true);
  $stm = $pdo->prepare("SELECT * FROM tasks WHERE idTask = :idTask");
  $stm->bindValue(":idTask", $post_data['idTask'], PDO::PARAM_INT);
  $stm->execute();
  $task = $stm->fetch(PDO::FETCH_ASSOC);
  echo json_encode($task);
 
