<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <img alt="image" src="../assets/images/icons/favicon.png" class="header-logo" width="32" height="32" />
      <a href="../index.php" target="_blank">
        <span class="logo-name">VK Store</span>
      </a>
    </div>
    <ul class="sidebar-menu">
      <li class="dropdown <?= ($p == 'dashboard' ? "active" : "") ?>">
        <a href="index.php" class="nav-link"><i data-feather="clipboard"></i><span>Dashboard</span></a>
      </li>
      <li class="dropdown <?= ($p == 'user' ? "active" : "") ?>">
        <a href="index.php?p=user" class="nav-link"><i data-feather="users"></i><span>User</span></a>
      </li>
      <li class="dropdown <?= ($p == 'product' ? "active" : "") ?>">
        <a href="index.php?p=product" class="nav-link"><i data-feather="monitor"></i><span>Product</span></a>
      </li>
      <li class="dropdown <?= ($p == 'category' ? "active" : "") ?>">
        <a href="index.php?p=category" class="nav-link"><i data-feather="shopping-bag"></i><span>Category</span></a>
      </li>
      <li class="dropdown <?= ($p == 'slideshow' ? "active" : "") ?>">
        <a href="index.php?p=slideshow" class="nav-link"><i data-feather="archive"></i><span>Slideshow</span></a>
      </li>
      <li class="dropdown <?= ($p == 'order' ? "active" : "") ?>">
        <a href="index.php?p=order" class="nav-link"><i data-feather="shopping-cart"></i><span>Order</span></a>
      </li>
      <li class="dropdown <?= ($p == 'payment' ? "active" : "") ?>">
        <a href="index.php?p=payment" class="nav-link"><i data-feather="dollar-sign"></i><span>Payment</span></a>
      </li>
      <li class="dropdown <?= ($p == 'shipping' ? "active" : "") ?>">
        <a href="index.php?p=shipping" class="nav-link"><i data-feather="truck"></i><span>Shipping</span></a>
      </li>
      <li class="dropdown <?= ($p == 'page' ? "active" : "") ?>">
        <a href="index.php?p=page" class="nav-link"><i data-feather="layout"></i><span>Page</span></a>
      </li>
      <li class="dropdown <?= ($p == 'profile' ? "active" : "") ?>">
        <a href="index.php?p=profile" class="nav-link"><i data-feather="user"></i><span>Profile</span></a>
      </li>
      <li class="dropdown <?= ($p == 'setting' ? "active" : "") ?>">
        <a href="index.php?p=setting" class="nav-link"><i data-feather="settings"></i><span>Setting</span></a>
      </li>
    </ul>
  </aside>
</div>