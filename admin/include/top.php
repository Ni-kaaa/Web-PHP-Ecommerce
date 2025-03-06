<?php
require_once "../auth/auth.php";


if (isset($_POST['logout'])) {
  $auth->logout();

  header("Location: login.php");
  exit();
}

?>

<nav class="navbar navbar-expand-lg main-navbar sticky">
  <div class="form-inline mr-auto">
    <ul class="navbar-nav mr-3">
      <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a></li>
      <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
          <i data-feather="maximize"></i>
        </a></li>
      <li>
        <form class="form-inline mr-auto">
          <div class="search-element">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="200">
            <button class="btn" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </form>
      </li>
    </ul>
  </div>
  <ul class="navbar-nav navbar-right">
    <li class="dropdown">
      <a href="#" data-toggle="dropdown"
        class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="assets/img/user.jpg"
          class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
      <div class="dropdown-menu dropdown-menu-right pullDown">
        <div class="dropdown-title">Greetings, </div>
        <a href="index.php?p=profile" class="dropdown-item has-icon"> <i class="far
										fa-user"></i> Profile
        </a>
        <a href="index.php?p=setting" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
          Settings
        </a>

        <form action="" method="POST">
          <div class="dropdown-divider"></div>
          <button type="submit" name="logout" class="dropdown-item has-icon text-danger">
            <i class="fas fa-sign-out-alt"></i>Log out
          </button>
        </form>
      </div>
    </li>
  </ul>
</nav>