<?php
require_once "../lib/db.php";
$db = new Database();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $data = [
    "user_id" => $_POST['user_id'],
    "order_status" => $_POST['order_status'],
    "total_amount" => $_POST['total_amount'],
    "shipping_address" => $_POST['shipping_address'],
    "order_date" => $_POST['order_date'],
  ];

  if (isset($_POST['update_order'])) {
    $db->update("tb_order", $data, "id=" . $_POST['order_id']);
  } elseif (isset($_POST['delete_order'])) {
    $db->delete("tb_order", "id", $_POST['order_id']);
  } else {
    $db->insert("tb_order", $data);
  }
}
$customers = $db->select("tb_user", "*", "role='customer'");
$orders = $db->select("tb_order");
?>

<div class="main-content">
  <section class="section">
    <h1>Order Management</h1>

    <form action="" method="POST">
      <input type="hidden" name="order_id" id="order_id">

      <div class="form-group">
        <label>Customer</label>
        <select name="user_id" id="user_id" class="form-control" required>
          <option value="" disabled selected>Select a Customer</option>
          <?php foreach ($customers as $customer): ?>
            <option value="<?= $customer['id']; ?>">
              <?= htmlspecialchars($customer['id'] . " - " . $customer['name']); ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group">
        <label>Order Status</label>
        <select name="order_status" id="order_status" class="form-control" required>
          <option value="" disabled selected>Select Order Status</option>
          <option value="pending">Pending</option>
          <option value="processing">Processing</option>
          <option value="shipped">Shipped</option>
          <option value="completed">Completed</option>
          <option value="cancelled">Cancelled</option>
        </select>
      </div>

      <div class="form-group">
        <label>Total Amount ($)</label>
        <input type="number" step="0.01" name="total_amount" id="total_amount" class="form-control" required>
      </div>

      <div class="form-group">
        <label>Shipping Address</label>
        <textarea name="shipping_address" id="shipping_address" class="form-control" required></textarea>
      </div>

      <div class="form-group">
        <label>Order Date</label>
        <input type="date" name="order_date" id="order_date" class="form-control" required>
      </div>

      <button type="submit" name="add_order" class="btn btn-primary">Add Order</button>
      <button type="submit" name="update_order" id="update_order" class="btn btn-success" style="display:none;">Update Order</button>
      <button type="submit" name="delete_order" id="delete_order" class="btn btn-danger" style="display:none;" onclick="return confirm('Are you sure?');">Delete Order</button>
    </form>

    <hr>

    <h2>Existing Orders</h2>
    <table class="table">
      <thead>
        <tr>
          <th>Order ID</th>
          <th>Customer ID</th>
          <th>Order Status</th>
          <th>Total Amount</th>
          <th>Shipping Address</th>
          <th>Order Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($orders as $order): ?>
          <tr>
            <td><?= $order['id']; ?></td>
            <td><?= $order['user_id']; ?></td>
            <td><?= ucfirst($order['order_status']); ?></td>
            <td>$<?= number_format($order['total_amount'], 2); ?></td>
            <td><?= htmlspecialchars($order['shipping_address']); ?></td>
            <td><?= date('Y-m-d', strtotime($order['order_date'])); ?></td>
            <td>
              <button class="btn btn-warning btn-sm edit-order" data-order='<?= json_encode($order); ?>'>Edit</button>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </section>
</div>

<script>
  document.querySelectorAll('.edit-order').forEach(button => {
    button.addEventListener('click', function() {
      let order = JSON.parse(this.getAttribute('data-order'));
      document.getElementById('order_id').value = order.id;
      document.getElementById('user_id').value = order.user_id;
      document.getElementById('order_status').value = order.order_status;
      document.getElementById('total_amount').value = order.total_amount;
      document.getElementById('shipping_address').value = order.shipping_address;
      document.getElementById('order_date').value = order.order_date;

      document.querySelector('button[name="add_order"]').style.display = 'none';
      document.querySelector('button[name="update_order"]').style.display = 'inline-block';
      document.querySelector('button[name="delete_order"]').style.display = 'inline-block';
    });
  });
</script>