<?php
require_once "../auth/auth.php";

$auth = new Auth();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = isset($_POST["username"]) ? $_POST["username"] : '';
  $password = isset($_POST["password"]) ? $_POST["password"] : '';

  if ($username && $password) {
    $result = $auth->login($username, $password);

    if ($result === "Login successful!") {
      header("Location: index.php");
      exit();
    } else {
      echo $result;
    }
  } else {
    echo "Please fill in both username and password.";
  }
}
?>




<!DOCTYPE html>
<html lang="en">

<?php include "include/head.php" ?>

<body>
  <div class="loader"></div>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Login</h4>
              </div>
              <div class="card-body">
                <form method="POST" action="login.php" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="username">Username *</label>
                    <input id="username" type="text" class="form-control" name="username" tabindex="1" placeholder="Enter your username" required autofocus>
                    <div class="invalid-feedback">
                      Please fill in your username
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Password *</label>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" placeholder="Enter your password" required>
                    <div class="invalid-feedback">
                      Please fill in your password
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Remember Me</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>

              </div>
            </div>
            <div class="mt-5 text-muted text-center">
              Don't have an account? <a href="register.php">Create One</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- General JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>
</body>


</html>