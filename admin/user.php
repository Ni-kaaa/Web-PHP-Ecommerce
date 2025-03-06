<?php
require_once "../lib/db.php";
$db = new Database();

if (isset($_POST['add_user'])) {
  $name = $_POST['name'];
  $fullname = $_POST['fullname'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $role = $_POST['role'];
  $enable = isset($_POST['enable']) ? 1 : 0;
  $contact = $_POST['contact'];

  $db->insert("tb_user", [
    "name" => $name,
    "fullname" => $fullname,
    "password" => $password,
    "role" => $role,
    "enable" => $enable,
    "contact" => $contact
  ]);
}

if (isset($_POST['update_user'])) {
  $id = $_POST['user_id'];
  $name = $_POST['name'];
  $fullname = $_POST['fullname'];
  $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;
  $role = $_POST['role'];
  $enable = isset($_POST['enable']) ? 1 : 0;
  $contact = $_POST['contact'];

  $updateData = [
    "name" => $name,
    "fullname" => $fullname,
    "role" => $role,
    "enable" => $enable,
    "contact" => $contact
  ];

  if ($password) {
    $updateData['password'] = $password;
  }

  $db->update("tb_user", $updateData, "id=" . $id);
}

if (isset($_POST['delete_user'])) {
  $id = $_POST['user_id'];
  $db->delete_User("tb_user", "id", $id);
}

$users = $db->select("tb_user", "*", "", "ORDER BY id ASC");
?>

<div class="main-content">
  <section class="section">
    <h1>User Management</h1>

    <form action="" method="POST">
      <input type="hidden" name="user_id" id="user_id">

      <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Enter user name" required autofocus>
      </div>

      <div class="form-group">
        <label>Full Name</label>
        <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Enter full name">
      </div>

      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Enter password">
      </div>

      <div class="form-group">
        <label>Role</label>
        <select name="role" id="role" class="form-control" required>
          <option value="" disabled selected>Select user role</option>
          <option value="admin">Admin</option>
          <option value="customer">Customer</option>
        </select>
      </div>

      <div class="form-group">
        <label>Enable</label>
        <input type="checkbox" name="enable" id="enable" value="1">
        <label>(Choose enable: activate user)</label>
      </div>

      <div class="form-group">
        <label>Contact (Optional)</label>
        <input type="text" name="contact" id="contact" class="form-control" placeholder="Enter contact information">
      </div>

      <button type="submit" name="add_user" id="add_user" class="btn btn-primary">Add User</button>
      <button type="submit" name="update_user" id="update_user" class="btn btn-success" style="display:none;">Update User</button>
      <button type="submit" name="delete_user" id="delete_user" class="btn btn-danger" style="display:none;" onclick="return confirm('Are you sure you want to delete this user?');">Delete User</button>
    </form>

    <hr>

    <h2>Existing Users</h2>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Full Name</th>
          <th>Role</th>
          <th>Enabled</th>
          <th>Contact</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $user): ?>
          <tr>
            <td><?php echo $user['id']; ?></td>
            <td><?php echo $user['name']; ?></td>
            <td><?php echo $user['fullname']; ?></td>
            <td><?php echo ucfirst($user['role']); ?></td>
            <td><?php echo $user['enable'] ? "Yes" : "No"; ?></td>
            <td><?php echo $user['contact']; ?></td>
            <td>
              <button class="btn btn-warning btn-sm edit-user" data-user='<?php echo json_encode($user); ?>'>Edit</button>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </section>
</div>

<script>
  document.querySelectorAll('.edit-user').forEach(button => {
    button.addEventListener('click', function() {
      let user = JSON.parse(this.getAttribute('data-user'));

      document.getElementById('user_id').value = user.id;
      document.getElementById('name').value = user.name;
      document.getElementById('fullname').value = user.fullname;
      document.getElementById('password').value = '';
      document.getElementById('role').value = user.role;
      document.getElementById('enable').checked = user.enable == 1;
      document.getElementById('contact').value = user.contact;

      document.getElementById('add_user').style.display = 'none';
      document.getElementById('update_user').style.display = 'inline-block';
      document.getElementById('delete_user').style.display = 'inline-block';
    });
  });
</script>