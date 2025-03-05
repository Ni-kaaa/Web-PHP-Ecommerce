<?php
$page = "home.php";
$p = "home";
if (isset($_GET['p'])) {
  $p = $_GET['p'];
  switch ($p) {
    case "home":
      $page = "home.php";
      break;
    case "shop":
      $page = "shop.php";
      break;
    case "about":
      $page = "about.php";
      break;
    case "contact":
      $page = "contact.php";
      break;
    case "term":
      $page = "term.php";
      break;
    case "policy":
      $page = "policy.php";
      break;
    case "paymentMethod":
      $page = "paymentMethod.php";
      break;
    case "wishlist":
      $page = "wishlist.php";
      break;
    case "cart":
      $page = "cart.php";
      break;
    case "checkout":
      $page = "checkout.php";
      break;
    case "dashboard":
      $page = "dashboard.php";
      break;
    case "login":
      $page = "login.php";
      break;
    case "product":
      $page = "product.php";
      break;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include "include/head.php" ?>

<body>
  <div class="page-wrapper">
    <?php include "include/header.php" ?>
    <br>
    <?php include "$page" ?>
    <?php include "include/footer.php" ?>
  </div><!-- End .page-wrapper -->
  <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>
  <?php include "include/mobile-menu.php" ?>
  <?php include "include/foot.php" ?>
</body>

</html>