<?php
require_once "../lib/db.php";
$db = new Database();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $data = [
    "name" => $_POST['name'],
    "description" => $_POST['description'],
    "title" => $_POST['title'],
    "price" => $_POST['price'],
    "stock" => $_POST['stock'],
    "category_id" => $_POST['category_id'],
    "event" => $_POST['event'],
  ];

  if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] == 0) {
    $uploadDir = "../assets/images/products/";

    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0777, true);
    }

    $imagePath = $uploadDir . basename($_FILES['image']['name']);
    $imageName = basename($_FILES['image']['name']);
    if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
      $data["image"] = str_replace("../", "", $imageName);
    } else {
      error_log("File upload failed: " . $_FILES['image']['name']);
    }
  }

  if (isset($_POST['update_product'])) {
    $db->update("tb_product", $data, "id=" . $_POST['product_id']);
  } elseif (isset($_POST['delete_product'])) {
    $db->delete("tb_product", "id", $_POST['product_id']);
  } else {
    $db->insert("tb_product", $data);
  }
}
$categories = $db->select("tb_category");
$products = $db->select(
  "tb_product p JOIN tb_category c ON p.category_id = c.id",
  "p.*, c.name as category_name"
);
?>

<div class="main-content">
  <section class="section">
    <h1>Product Management</h1>

    <form action="" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="product_id" id="product_id">

      <div class="form-group">
        <label>Product Name</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Enter your product name" required>
      </div>

      <div class="form-group">
        <label>Title</label>
        <input type="text" name="title" id="title" class="form-control" placeholder="Enter your product title">
        <label>Short Description that will show in product detail</label>
      </div>

      <div class="form-group">
        <label>Description</label>
        <textarea name="description" id="description" class="form-control" placeholder="Enter your product description"></textarea>
      </div>

      <div class="form-group">
        <label>Price ($)</label>
        <input type="number" step="0.01" name="price" id="price" class="form-control" placeholder="Enter your product price" required>
      </div>

      <div class="form-group">
        <label>Stock</label>
        <input type="number" name="stock" id="stock" class="form-control" placeholder="Enter your product stock" required>
        <label>Ex: 1000 products</label>
      </div>

      <div class="form-group">
        <label>Category</label>
        <select name="category_id" id="category_id" class="form-control" required>
          <option value="">Select Category</option>
          <?php foreach ($categories as $category): ?>
            <option value="<?= $category['id']; ?>"><?= $category['name']; ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group">
        <label>Event</label>
        <select name="event" id="event" class="form-control">
          <option value="" disabled selected>Select your product event</option>
          <option value="new">New</option>
          <option value="top">Top</option>
        </select>
        <label>New: New Arrivals <br> Top: Best Sellings</label>
      </div>

      <div class="form-group">
        <label>Upload Image</label>
        <input type="file" name="image" id="image" class="form-control">
        <label>Recommended size: 250 x 250 (pixels)</label>
      </div>

      <button type="submit" name="add_product" class="btn btn-primary">Add Product</button>
      <button type="submit" name="update_product" id="update_product" class="btn btn-success" style="display:none;">Update Product</button>
      <button type="submit" name="delete_product" id="delete_product" class="btn btn-danger" style="display:none;" onclick="return confirm('Are you sure?');">Delete Product</button>
    </form>

    <hr>

    <h2>Existing Products</h2>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Title</th>
          <th>Description</th>
          <th>Price</th>
          <th>Stock</th>
          <th>Category</th>
          <th>Image</th>
          <th>Event</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($products as $product): ?>
          <tr>
            <td><?= $product['id']; ?></td>
            <td><?= $product['name']; ?></td>
            <td><?= $product['title']; ?></td>
            <td><?= $product['description']; ?></td>
            <td><?= $product['price']; ?></td>
            <td><?= $product['stock']; ?></td>
            <td><?= $product['category_name']; ?></td>
            <td><img src="<?= $product['image']; ?>" width="100"></td>
            <td><?= $product['event']; ?></td>
            <td>
              <button class="btn btn-warning btn-sm edit-product"
                data-product='<?= json_encode($product); ?>'>Edit</button>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </section>
</div>

<script>
  document.querySelectorAll('.edit-product').forEach(button => {
    button.addEventListener('click', function() {
      let product = JSON.parse(this.getAttribute('data-product'));
      document.getElementById('product_id').value = product.id;
      document.getElementById('name').value = product.name;
      document.getElementById('title').value = product.title;
      document.getElementById('description').value = product.description;
      document.getElementById('price').value = product.price;
      document.getElementById('stock').value = product.stock;
      document.getElementById('category_id').value = product.category_id;
      document.getElementById('event').value = product.event;

      document.querySelector('button[name="add_product"]').style.display = 'none';
      document.querySelector('button[name="update_product"]').style.display = 'inline-block';
      document.querySelector('button[name="delete_product"]').style.display = 'inline-block';
    });
  });
</script>