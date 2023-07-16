<?php
  session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();
  if (isset($_POST['signup']))
  {
    require_once 'connect.inc.php';
    $firstname  = $_POST['firstname'];
    $lastname   = $_POST['lastname'];
    $email      = $_POST['email'];
    $username   = $_POST['username'];
    $password   = $_POST['password'];
    
    $stm = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stm->bindValue(":email", $email, PDO::PARAM_STR);
    $stm->execute();
    if ($stm->rowCount())
    {
      $_SESSION['warning'] = "The email is already exist!";
      header("location: ../signup.php");
      exit;
    }
    $stm = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stm->bindValue(":username", $username, PDO::PARAM_STR);
    $stm->execute();
    if ($stm->rowCount())
    {
      $_SESSION['warning'] = "The username is already exist!";
      header("location: ../signup.php");
      exit;
    }
    $stm = $pdo->prepare("INSERT INTO users VALUES ('', :firstname, :lastname, :email, :username, :password)");
    $stm->bindValue(":firstname", $firstname, PDO::PARAM_STR);
    $stm->bindValue(":lastname", $lastname, PDO::PARAM_STR);
    $stm->bindValue(":email", $email, PDO::PARAM_STR);
    $stm->bindValue(":username", $username, PDO::PARAM_STR);
    $stm->bindValue(":password", password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);
    $stm->execute();
    
    $_SESSION['success'] = "You are successfully registered";
    header("location: ../signin.php");
  }
  else header("location: ../signup.php");