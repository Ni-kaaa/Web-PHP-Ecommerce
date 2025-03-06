<?php
require_once "../lib/db.php";
$db = new Database();
?>
<div class="main-content">
  <section class="section">
    <h1>User Profile</h1>

    <form action="" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="user_id" id="user_id">

      <div class="form-group">
        <label>Full Name</label>
        <input type="text" name="full_name" id="full_name" class="form-control" placeholder="Enter your full name" required autofocus>
      </div>

      <div class="form-group">
        <label>Email Address</label>
        <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email address" required>
      </div>

      <div class="form-group">
        <label>Phone Number</label>
        <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter your phone number">
      </div>

      <div class="form-group">
        <label>Profile Picture</label>
        <input type="file" name="profile_pic" id="profile_pic" class="form-control">
        <label>Recommended size: 150 x 150 (pixel)</label>
      </div>

      <div class="form-group">
        <label>About Me</label>
        <textarea name="about_me" id="about_me" class="form-control" placeholder="Tell us about yourself"></textarea>
      </div>

      <div class="form-group">
        <label>Change Password (Optional)</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Enter new password">
      </div>

      <button type="submit" name="update_profile" id="update_profile" class="btn btn-success">Update Profile</button>
      <button type="submit" name="delete_profile" id="delete_profile" class="btn btn-danger" style="display:none;" onclick="return confirm('Are you sure you want to delete your profile?');">Delete Profile</button>
    </form>
  </section>
</div>