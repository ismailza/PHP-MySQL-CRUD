<?php
  session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();
  if (isset($_SESSION['auth'])) header("location:index.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign in</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>  
  <div class="container">
    <div class="m-auto" style="width: 320px;">
      <?php if (isset($_SESSION['error'])): ?>
      <div class="alert alert-danger">
        <?php 
          echo $_SESSION['error'];
          unset($_SESSION['error']);
        ?>
      </div>
      <?php endif; ?>
      <?php if (isset($_SESSION['warning'])): ?>
      <div class="alert alert-warning">
        <?php 
          echo $_SESSION['warning'];
          unset($_SESSION['warning']);
        ?>
      </div>
      <?php endif; ?>
      <?php if (isset($_SESSION['success'])): ?>
      <div class="alert alert-success">
        <?php 
          echo $_SESSION['success'];
          unset($_SESSION['success']);
        ?>
      </div>
      <?php endif; ?>
      <form action="scripts/signin.php" method="post" class="g-3 needs-validation" novalidate>
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
        <div class="md-4">
          <label for="validationCustom01" class="form-label">Username</label>
          <input type="text" class="form-control" name="username" id="validationCustom01" placeholder="Your username or email" required>
          <div class="invalid-feedback">
            Please provide a valid username or email.
          </div>
        </div>
        <div class="md-4">
          <label for="validationCustom02" class="form-label">Password</label>
          <input type="password" class="form-control" name="password" id="validationCustom02" placeholder="Your password" required>
          <div class="invalid-feedback">
            Please provide a valid password.
          </div>
        </div>
        <div class="form-check text-start my-3">
          <input class="form-check-input" type="checkbox" name="remember" value="remember-me" id="flexCheckDefault">
          <label class="form-check-label" for="flexCheckDefault">
            Remember me
          </label>
        </div>
        <div class="mt-4">
          <button class="btn btn-primary w-100" type="submit" name="signin">Sign in</button>
        </div>
        <p class="mt-2" align="right">You don't have an account yet ? <a href="signup.php">Sign up</a></p>
      </form>
    </div>
  </div>
  
  <script src="js/bootstrap.min.js"></script>
  <script src="js/validate-form.js"></script>
</body>
</html>