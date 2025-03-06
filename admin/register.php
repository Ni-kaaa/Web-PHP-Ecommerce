<?php
require_once "../auth/auth.php";

$auth = new Auth();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  $username = isset($_POST["username"]) ? trim($_POST["username"]) : '';
  $full_name = isset($_POST["full_name"]) ? trim($_POST["full_name"]) : '';
  $password = isset($_POST["password"]) ? $_POST["password"] : '';
  $password_confirm = isset($_POST["password_confirm"]) ? $_POST["password_confirm"] : '';
  $agree = isset($_POST["agree"]) ? $_POST["agree"] : false;
  $enable = 1;
  $contact = isset($_POST["contact"]) ? $_POST["contact"] : '';


  if (!$username || !$password || !$password_confirm || !$agree) {
    echo "All fields are required, and you must agree to the terms.";
    exit();
  }


  if ($password !== $password_confirm) {
    echo "Passwords do not match.";
    exit();
  }


  $hashed_password = password_hash($password, PASSWORD_DEFAULT);


  $result = $auth->register($username, $hashed_password, $full_name, $contact);

  if ($result === "Registration successful!") {
    header("Location: login.php");
    exit();
  } else {
    echo $result;
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
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Register</h4>
              </div>
              <div class="card-body">
                <form method="POST" action="register.php">
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="username">Username *</label>
                      <input id="username" type="text" class="form-control" name="username" placeholder="Enter your username" required autofocus>
                    </div>
                    <div class="form-group col-6">
                      <label for="full_name">Full Name</label>
                      <input id="full_name" type="text" class="form-control" name="full_name" placeholder="Enter your fullname">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="password" class="d-block">Password *</label>
                      <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password" placeholder="Enter your password" required>
                      <div id="pwindicator" class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                      </div>
                    </div>
                    <div class="form-group col-6">
                      <label for="password2" class="d-block">Password Confirmation *</label>
                      <input id="password2" type="password" class="form-control" name="password_confirm" placeholder="Enter password confirmation" required>
                    </div>
                    <div class="form-group col">
                      <label for="contact">Email or Phone Number</label>
                      <input id="contact" type="text" class="form-control" name="contact" placeholder="Enter your email or phone number">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="agree" class="custom-control-input" id="agree">
                      <label class="custom-control-label" for="agree">I agree with the <a href="../index.php?p=term" target="_blank">terms and conditions</a></label>
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      Register
                    </button>
                  </div>
                </form>
              </div>
              <div class="mb-4 text-muted text-center">
                Already Registered? <a href="login.php">Login</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- General JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <!-- JS Libraries -->
  <script src="assets/bundles/jquery-pwstrength/jquery.pwstrength.min.js"></script>
  <script src="assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="assets/js/page/auth-register.js"></script>
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>
</body>

</html>