<?php
require_once('../lib/db.php');

$db = new Database();

if (isset($_POST['add_category'])) {
  $name = $_POST['name'];
  $description = $_POST['description'];

  $db->insert("tb_category", [
    "name" => $name,
    "description" => $description
  ]);
}

if (isset($_POST['update_category'])) {
  $id = $_POST['category_id'];
  $name = $_POST['name'];
  $description = $_POST['description'];

  $db->update("tb_category", [
    "name" => $name,
    "description" => $description
  ], "id=" . $id);
}

if (isset($_POST['delete_category'])) {
  $id = $_POST['category_id'];
  $db->delete_User("tb_category", "id", $id);
}

$categories = $db->select("tb_category");
?>

<div class="main-content">
  <section class="section">
    <h1>Category Management</h1>

    <form action="" method="POST">
      <input type="hidden" name="category_id" id="category_id">

      <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Enter category name" required autofocus>
      </div>

      <div class="form-group">
        <label>Description</label>
        <textarea name="description" id="description" class="form-control" placeholder="Enter category description"></textarea>
      </div>

      <button type="submit" name="add_category" id="add_category" class="btn btn-primary">Add Category</button>
      <button type="submit" name="update_category" id="update_category" class="btn btn-success" style="display:none;">Update Category</button>
      <button type="submit" name="delete_category" id="delete_category" class="btn btn-danger" style="display:none;" onclick="return confirm('Are you sure you want to delete this category?');">Delete Category</button>
    </form>

    <hr>

    <h2>Existing Categories</h2>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Description</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($categories as $category): ?>
          <tr>
            <td><?php echo $category['id']; ?></td>
            <td><?php echo $category['name']; ?></td>
            <td><?php echo $category['description']; ?></td>
            <td>
              <button class="btn btn-warning btn-sm edit-category" data-category='<?php echo json_encode($category); ?>'>Edit</button>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </section>
</div>

<script>
  document.querySelectorAll('.edit-category').forEach(button => {
    button.addEventListener('click', function() {
      let category = JSON.parse(this.getAttribute('data-category'));

      document.getElementById('category_id').value = category.id;
      document.getElementById('name').value = category.name;
      document.getElementById('description').value = category.description;

      document.getElementById('add_category').style.display = 'none';
      document.getElementById('update_category').style.display = 'inline-block';
      document.getElementById('delete_category').style.display = 'inline-block';
    });
  });
</script>