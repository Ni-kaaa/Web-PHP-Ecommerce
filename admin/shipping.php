<?php
require_once "../lib/db.php";
$db = new Database();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $tracking_number = generateTrackingNumber();
  $data = [
    "order_id" => $_POST['order_id'],
    "shipping_method" => $_POST['shipping_method'],
    "tracking_number" => $tracking_number,
    "shipping_status" => $_POST['shipping_status'],
    "shipped_date" => $_POST['shipped_date'],
    "delivered_date" => $_POST['delivered_date'],
  ];

  if (isset($_POST['update_shipping'])) {
    $db->update("tb_shipping", $data, "id=" . $_POST['shipping_id']);
  } elseif (isset($_POST['delete_shipping'])) {
    $db->delete("tb_shipping", "id", $_POST['shipping_id']);
  } else {
    $db->insert("tb_shipping", $data);
  }
}
$orders = $db->select("tb_order", "id");
$shippings = $db->select("tb_shipping s JOIN tb_order o ON s.order_id = o.id", "s.*, o.total_amount");

function generateTrackingNumber()
{
  $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
  $trackingNumber = '';
  for ($i = 0; $i < 10; $i++) {
    $trackingNumber .= $characters[rand(0, strlen($characters) - 1)];
  }
  return $trackingNumber;
}
?>

<div class="main-content">
  <section class="section">
    <h1>Shipping Management</h1>

    <form action="" method="POST">
      <input type="hidden" name="shipping_id" id="shipping_id">

      <div class="form-group">
        <label>Order ID</label>
        <select name="order_id" id="order_id" class="form-control" required>
          <option value="" disabled selected>Select an Order</option>
          <?php foreach ($orders as $order): ?>
            <option value="<?= $order['id']; ?>">Order #<?= $order['id']; ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group">
        <label>Shipping Method</label>
        <select name="shipping_method" id="shipping_method" class="form-control" required>
          <option value="" disabled selected>Select shipping method</option>
          <option value="standard">Standard</option>
          <option value="express">Express</option>
          <option value="overnight">Overnight</option>
        </select>
      </div>

      <div class="form-group">
        <label>Shipping Status</label>
        <select name="shipping_status" id="shipping_status" class="form-control" required>
          <option value="" disabled selected>Select shipping status</option>
          <option value="pending">Pending</option>
          <option value="shipped">Shipped</option>
          <option value="delivered">Delivered</option>
        </select>
      </div>

      <div class="form-group">
        <label>Shipped Date</label>
        <input type="date" name="shipped_date" id="shipped_date" class="form-control">
      </div>

      <div class="form-group">
        <label>Delivered Date</label>
        <input type="date" name="delivered_date" id="delivered_date" class="form-control">
      </div>

      <button type="submit" name="add_shipping" class="btn btn-primary">Add Shipping</button>
      <button type="submit" name="update_shipping" id="update_shipping" class="btn btn-success" style="display:none;">Update Shipping</button>
      <button type="submit" name="delete_shipping" id="delete_shipping" class="btn btn-danger" style="display:none;" onclick="return confirm('Are you sure?');">Delete Shipping</button>
    </form>

    <hr>

    <h2>Existing Shipments</h2>
    <table class="table">
      <thead>
        <tr>
          <th>Shipping ID</th>
          <th>Order ID</th>
          <th>Shipping Method</th>
          <th>Tracking Number</th>
          <th>Shipping Status</th>
          <th>Shipped Date</th>
          <th>Delivered Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($shippings as $shipping): ?>
          <tr>
            <td><?= $shipping['id']; ?></td>
            <td><?= $shipping['order_id']; ?></td>
            <td><?= ucfirst($shipping['shipping_method']); ?></td>
            <td><?= $shipping['tracking_number']; ?></td>
            <td><?= ucfirst($shipping['shipping_status']); ?></td>
            <td><?= date('Y-m-d', strtotime($shipping['shipped_date'])); ?></td>
            <td><?= date('Y-m-d', strtotime($shipping['delivered_date'])); ?></td>
            <td>
              <button class="btn btn-warning btn-sm edit-shipping" data-shipping='<?= json_encode($shipping); ?>'>Edit</button>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </section>
</div>

<script>
  document.querySelectorAll('.edit-shipping').forEach(button => {
    button.addEventListener('click', function() {
      let shipping = JSON.parse(this.getAttribute('data-shipping'));
      document.getElementById('shipping_id').value = shipping.id;
      document.getElementById('order_id').value = shipping.order_id;
      document.getElementById('shipping_method').value = shipping.shipping_method;
      document.getElementById('shipping_status').value = shipping.shipping_status;
      document.getElementById('shipped_date').value = shipping.shipped_date;
      document.getElementById('delivered_date').value = shipping.delivered_date;

      document.querySelector('button[name="add_shipping"]').style.display = 'none';
      document.querySelector('button[name="update_shipping"]').style.display = 'inline-block';
      document.querySelector('button[name="delete_shipping"]').style.display = 'inline-block';
    });
  });
</script>