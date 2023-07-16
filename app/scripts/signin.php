<?php
  session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();
  if (isset($_POST['signin']))
  {
    require_once 'connect.inc.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $remember = $_POST['remember'];

    $stm = $pdo->prepare("SELECT * FROM users WHERE username = :username OR email = :email");
    $stm->bindValue(":username", $username, PDO::PARAM_STR);
    $stm->bindValue(":email", $username, PDO::PARAM_STR);
    $stm->execute();
    if (!$stm->rowCount()) 
    {
      $_SESSION['error'] = "Username or email is wrong!";
      header("location: ../signin.php");
    }
    else
    {
      $user = $stm->fetch(PDO::FETCH_ASSOC);
      if (password_verify($password, $user['password']))
      {
        $_SESSION['auth'] = $user;
        if (!empty($remember))
        {
          $expired = time()+3600*24*60;
          setcookie('login', $login, $expired);
          setcookie('password', password_hash($password, PASSWORD_DEFAULT), $expired);
        }
        if (isset($_SESSION['url']))
        {
          header("location: ".$_SESSION['url']);
          unset($_SESSION['url']);
        }
        else header("location: ../index.php");
      }
      else
      {
        $_SESSION['error'] = "Password is wrong!";
        header("location: ../signin.php");
      }
    }
  }
  else header("location: ../signin.php");