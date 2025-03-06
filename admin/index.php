<?php
require_once("../lib/db.php");
require_once("../auth/auth.php");

$auth = new Auth();

if (!$auth->is_logged_in()) {
  header("Location: login.php");
  exit();
}

$page = "dashboard.php";
$p = "dashboard";

if (isset($_GET['p'])) {
  $p = $_GET['p'];
  switch ($p) {
    case "dashboard":
      $page = "dashboard.php";
      break;
    case "product":
      $page = "product.php";
      break;
    case "user":
      $page = "user.php";
      break;
    case "slideshow":
      $page = "slideshow.php";
      break;
    case "category":
      $page = "category.php";
      break;
    case "profile":
      $page = "profile.php";
      break;
    case "setting":
      $page = "setting.php";
      break;
    case "order":
      $page = "order.php";
      break;
    case "payment":
      $page = "payment.php";
      break;
    case "shipping":
      $page = "shipping.php";
      break;
    case "page":
      $page = "page.php";
      break;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include "include/head.php" ?>

<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <?php include "include/top.php" ?>
      <?php include "include/sidebar.php" ?>
      <!-- Main Content -->
      <?php include "$page" ?>
      <!-- End Main Content -->
      <?php include "include/footer.php" ?>
    </div>
  </div>
  <?php include "include/foot.php" ?>
</body>

</html>