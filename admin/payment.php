<?php
require_once "../lib/db.php";
$db = new Database();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $data = [
    "order_id" => $_POST['order_id'],
    "payment_method" => $_POST['payment_method'],
    "payment_status" => $_POST['payment_status'],
    "payment_date" => $_POST['payment_date'],
  ];

  if (isset($_POST['update_payment'])) {
    $db->update("tb_payment", $data, "id=" . $_POST['payment_id']);
  } elseif (isset($_POST['delete_payment'])) {
    $db->delete("tb_payment", "id", $_POST['payment_id']);
  } else {
    $db->insert("tb_payment", $data);
  }
}
$orders = $db->select("tb_order", "id");
$payments = $db->select("tb_payment p JOIN tb_order o ON p.order_id = o.id", "p.*, o.total_amount");
?>

<div class="main-content">
  <section class="section">
    <h1>Payment Management</h1>

    <form action="" method="POST">
      <input type="hidden" name="payment_id" id="payment_id">

      <div class="form-group">
        <label>Order ID</label>
        <select name="order_id" id="order_id" class="form-control" required>
          <option value="" disabled selected>Select an Order</option>
          <?php foreach ($orders as $order): ?>
            <option value="<?= $order['id']; ?>">
              Order #<?= $order['id']; ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group">
        <label>Payment Method</label>
        <select name="payment_method" id="payment_method" class="form-control" required>
          <option value="" disabled selected>Select payment method</option>
          <option value="aba_payway">ABA PayWay</option>
          <option value="cash_on_delivery">Cash on Delivery</option>
        </select>
      </div>

      <div class="form-group">
        <label>Payment Status</label>
        <select name="payment_status" id="payment_status" class="form-control" required>
          <option value="" disabled selected>Select payment status</option>
          <option value="pending">Pending</option>
          <option value="completed">Completed</option>
          <option value="failed">Failed</option>
          <option value="cancelled">Cancelled</option>
        </select>
      </div>

      <div class="form-group">
        <label>Payment Date</label>
        <input type="date" name="payment_date" id="payment_date" class="form-control" required>
      </div>

      <button type="submit" name="add_payment" class="btn btn-primary">Add Payment</button>
      <button type="submit" name="update_payment" id="update_payment" class="btn btn-success" style="display:none;">Update Payment</button>
      <button type="submit" name="delete_payment" id="delete_payment" class="btn btn-danger" style="display:none;" onclick="return confirm('Are you sure?');">Delete Payment</button>
    </form>

    <hr>

    <h2>Existing Payments</h2>
    <table class="table">
      <thead>
        <tr>
          <th>Payment ID</th>
          <th>Order ID</th>
          <th>Payment Method</th>
          <th>Payment Status</th>
          <th>Total Amount</th>
          <th>Payment Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($payments as $payment): ?>
          <tr>
            <td><?= $payment['id']; ?></td>
            <td><?= $payment['order_id']; ?></td>
            <td><?= ucfirst(str_replace('_', ' ', $payment['payment_method'])); ?></td>
            <td><?= ucfirst($payment['payment_status']); ?></td>
            <td>$<?= number_format($payment['total_amount'], 2); ?></td>
            <td><?= date('Y-m-d', strtotime($payment['payment_date'])); ?></td>
            <td>
              <button class="btn btn-warning btn-sm edit-payment" data-payment='<?= json_encode($payment); ?>'>Edit</button>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </section>
</div>

<script>
  document.querySelectorAll('.edit-payment').forEach(button => {
    button.addEventListener('click', function() {
      let payment = JSON.parse(this.getAttribute('data-payment'));
      document.getElementById('payment_id').value = payment.id;
      document.getElementById('order_id').value = payment.order_id;
      document.getElementById('payment_method').value = payment.payment_method;
      document.getElementById('payment_status').value = payment.payment_status;
      document.getElementById('payment_date').value = payment.payment_date;

      document.querySelector('button[name="add_payment"]').style.display = 'none';
      document.querySelector('button[name="update_payment"]').style.display = 'inline-block';
      document.querySelector('button[name="delete_payment"]').style.display = 'inline-block';
    });
  });
</script>