<?php
require_once("lib/db.php");
$db = new Database();
$categories = $db->select("tb_category", "*");
$products = $db->select(
  "tb_product p JOIN tb_category c ON p.category_id = c.id",
  "p.*, c.name as category_name"
);
$num = $db->count("tb_product");
?>
<main class="main">
  <div class="page-content">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-xl-4-5col">
          <div class="toolbox">
            <div class="toolbox-left">
              <div class="toolbox-info">
                <?= $num ?> Products found
              </div><!-- End .toolbox-info -->
            </div><!-- End .toolbox-left -->

            <div class="toolbox-right">
              <div class="toolbox-sort">
                <label for="sortby">Sort by:</label>
                <div class="select-custom">
                  <select name="sortby" id="sortby" class="form-control">
                    <option value="product_name">Name(A-Z)</option>
                    <option value="product_price">Price</option>
                  </select>
                </div>
              </div><!-- End .toolbox-sort -->
            </div><!-- End .toolbox-right -->
          </div><!-- End .toolbox -->

          <div class="products mb-3">
            <div class="row">
              <?php foreach ($products as $product) { ?>
                <div class="col-6 col-md-4 col-xl-3">
                  <div class="product">
                    <figure class="product-media">
                      <span class="product-label label-<?= $product['event'] ?>"><?= strtoupper($product['event']) ?></span>
                      <a href="product.html">
                        <img src="assets/images/products/<?= $product['image'] ?>" alt="Product image" class="product-image">
                      </a>

                      <div class="product-action-vertical">
                        <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                        <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                        <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                      </div><!-- End .product-action-vertical -->

                      <div class="product-action">
                        <a href="#" class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
                      </div><!-- End .product-action -->
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                      <div class="product-cat">
                        <a href="#"><?= $product['category_name'] ?></a>
                      </div><!-- End .product-cat -->
                      <h3 class="product-title"><a href="product.html"><?= $product['name'] ?></a></h3><!-- End .product-title -->
                      <div class="product-price">
                        $<?= $product['price'] ?>
                      </div><!-- End .product-price -->
                    </div><!-- End .product-body -->
                  </div><!-- End .product -->
                </div><!-- End .col-sm-6 col-md-4 col-xl-3 -->
              <?php } ?>

            </div><!-- End .row -->
          </div><!-- End .products -->
        </div><!-- End .col-lg-9 -->

        <aside class="col-lg-3 col-xl-5col order-lg-first">
          <div class="sidebar sidebar-shop">
            <div class="widget widget-categories">
              <h3 class="widget-title">Product Categories</h3><!-- End .widget-title -->

              <div class="widget-body">
                <div class="accordion" id="widget-cat-acc">
                  <?php foreach ($categories as $category) { ?>
                    <div class="acc-item">
                      <a role="button" data-toggle="collapse" href="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
                        <?= strtoupper($category['name']) ?>
                      </a>
                    </div><!-- End .acc-item -->
                  <?php } ?>
                </div><!-- End .accordion -->
              </div><!-- End .widget-body -->
            </div><!-- End .widget -->

            <div class="widget widget-banner-sidebar">
              <div class="banner-sidebar-title">ad banner 218 x 430px</div><!-- End .ad-title -->

              <div class="banner-sidebar banner-overlay">
                <a href="#">
                  <img src="assets/images/demos/demo-13/banners/banner-6.jpg" alt="banner">
                </a>
              </div><!-- End .banner-ad -->
            </div><!-- End .widget -->
          </div><!-- End .sidebar sidebar-shop -->
        </aside><!-- End .col-lg-3 -->
      </div><!-- End .row -->
    </div><!-- End .container -->
  </div><!-- End .page-content -->
</main><!-- End .main -->