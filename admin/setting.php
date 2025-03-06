<?php
require_once "../lib/db.php";
$db = new Database();
?>

<div class="main-content">
  <section class="section">
    <h1>Website Settings</h1>

    <form action="settings.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="setting_id" value="1">

      <div class="form-group">
        <label>Website Name</label>
        <input type="text" name="website_name" class="form-control" placeholder="Enter website name" value="" required autofocus>
      </div>

      <div class="form-group">
        <label>Website Logo</label>
        <input type="file" name="website_logo" class="form-control">
        <label>Current Logo: <img src="" width="100"></label>
      </div>

      <div class="form-group">
        <label>Footer Text</label>
        <textarea name="footer_text" class="form-control" placeholder="Enter footer text"></textarea>
      </div>

      <div class="form-group">
        <label>Contact Email</label>
        <input type="email" name="email" class="form-control" placeholder="Enter contact email" value="">
      </div>

      <div class="form-group">
        <label>Contact Phone</label>
        <input type="text" name="phone" class="form-control" placeholder="Enter contact phone" value="">
      </div>

      <button type="submit" class="btn btn-success">Update Settings</button>
    </form>
  </section>
</div>