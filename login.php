<main class="main">
  <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17">
    <div class="container">
      <div class="form-box">
        <div class="form-tab">
          <ul class="nav nav-pills nav-fill" role="tablist">
            <li class="nav-item">
              <a class="nav-link" id="signin-tab-2" data-toggle="tab" href="#signin-2" role="tab" aria-controls="signin-2" aria-selected="false">Sign In</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" id="register-tab-2" data-toggle="tab" href="#register-2" role="tab" aria-controls="register-2" aria-selected="true">Register</a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane fade" id="signin-2" role="tabpanel" aria-labelledby="signin-tab-2">
              <form action="#">
                <div class="form-group">
                  <label for="username">Username *</label>
                  <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
                </div><!-- End .form-group -->

                <div class="form-group">
                  <label for="singin-password-2">Password *</label>
                  <input type="password" class="form-control" id="singin-password-2" name="singin-password" placeholder="Enter your password" required>
                </div><!-- End .form-group -->

                <div class="form-footer">
                  <button type="submit" class="btn btn-outline-primary-2">
                    <span>LOG IN</span>
                    <i class="icon-long-arrow-right"></i>
                  </button>

                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="signin-remember-2">
                    <label class="custom-control-label" for="signin-remember-2">Remember Me</label>
                  </div><!-- End .custom-checkbox -->
                </div><!-- End .form-footer -->
              </form>
            </div><!-- .End .tab-pane -->
            <div class="tab-pane fade show active" id="register-2" role="tabpanel" aria-labelledby="register-tab-2">
              <form action="#">
                <div class="form-group">
                  <label for="register-username">Username *</label>
                  <input type="text" class="form-control" id="register-username" name="register-username" placeholder="Enter your username" required>
                </div><!-- End .form-group -->

                <div class="form-group">
                  <label for="full_name">Full Name</label>
                  <input id="full_name" type="text" class="form-control" name="full_name" placeholder="Enter your fullname">
                </div>

                <div class="form-group">
                  <label for="register-password">Password *</label>
                  <input type="password" class="form-control" id="register-password" name="register-password" placeholder="Enter your password" required>
                </div><!-- End .form-group -->

                <div class="form-group">
                  <label for="register-password-2" class="d-block">Password Confirmation *</label>
                  <input type="password" class="form-control" name="password_confirm" placeholder="Enter password confirmation" required>
                </div>

                <div class="form-footer">
                  <button type="submit" class="btn btn-outline-primary-2">
                    <span>SIGN UP</span>
                    <i class="icon-long-arrow-right"></i>
                  </button>

                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="register-policy-2" required>
                    <label class="custom-control-label" for="register-policy-2">I agree to the <a href="index.php?p=policy" target="_blank">privacy policy</a> *</label>
                  </div><!-- End .custom-checkbox -->
                </div><!-- End .form-footer -->
              </form>
            </div><!-- .End .tab-pane -->
          </div><!-- End .tab-content -->
        </div><!-- End .form-tab -->
      </div><!-- End .form-box -->
    </div><!-- End .container -->
  </div><!-- End .login-page section-bg -->
</main><!-- End .main -->