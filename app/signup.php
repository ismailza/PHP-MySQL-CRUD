<?php
  session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();
  if (isset($_SESSION['auth'])) header("location:index.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign up</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>  
  <div class="container">
    <div class="m-auto" style="width: 320px;">
      <?php if (isset($_SESSION['warning'])): ?>
      <div class="alert alert-warning">
        <?php 
          echo $_SESSION['warning'];
          unset($_SESSION['warning']);
        ?>
      </div>
      <?php endif; ?>
      <div class="alert alert-danger">
      </div>
      <form action="scripts/signup.php" method="post" class="g-3 needs-validation" novalidate onsubmit="return confirm_password()">
        <h1 class="h3 mb-3 fw-normal">Please sign up</h1>
        <div class="md-4">
          <label for="validationCustom01" class="form-label">First name</label>
          <input type="text" class="form-control" name="firstname" id="validationCustom01" placeholder="Your first name" required>
          <div class="invalid-feedback">
            Please provide a valid first name.
          </div>
        </div>
        <div class="md-4">
          <label for="validationCustom02" class="form-label">Last name</label>
          <input type="text" class="form-control" name="lastname" id="validationCustom02" placeholder="Your last name" required>
          <div class="invalid-feedback">
            Please provide a valid last name.
          </div>
        </div>
        <div class="md-4">
          <label for="validationCustom03" class="form-label">Email adress</label>
          <input type="email" class="form-control" name="email" id="validationCustom03" placeholder="Your email adress" required>
          <div class="invalid-feedback">
            Please provide a valid email.
          </div>
        </div>
        <div class="md-4">
          <label for="validationCustom04" class="form-label">Username</label>
          <input type="text" class="form-control" name="username" id="validationCustom04" placeholder="Your username" required>
          <div class="invalid-feedback">
            Please provide a valid username.
          </div>
        </div>
        <div class="md-4">
          <label for="validationCustom05" class="form-label">Password</label>
          <input type="password" class="form-control" name="password" id="validationCustom05" placeholder="Your password" required>
          <div class="invalid-feedback">
            Please provide a valid password.
          </div>
        </div>
        <div class="md-4">
          <label for="validationCustom06" class="form-label">Password</label>
          <input type="password" class="form-control" name="repassword" id="validationCustom06" placeholder="Confirm your password" required>
          <div class="invalid-feedback">
            Please provide a valid password.
          </div>
        </div>
        <div class="mt-4">
          <button class="btn btn-primary w-100" type="submit" name="signup">Sign up</button>
        </div>
        <p class="mt-2" align="right">Already have an account ? ? <a href="signin.php">Sign in</a></p>
      </form>
    </div>
  </div>
  
  <script src="js/bootstrap.min.js"></script>
  <script src="js/validate-form.js"></script>
  <script>
    document.querySelector('.alert-danger').style.display = "none";
    function confirm_password ()
    {
      let pass = document.querySelector('#validationCustom05').value;
      let repass = document.querySelector('#validationCustom06').value;
      if (pass == repass) return true;
      document.querySelector('.alert-danger').innerHTML = "Confirmation password is incorrect!";
      document.querySelector('.alert-danger').style.display = "block";
      return false;
    }
  </script>
</body>
</html>