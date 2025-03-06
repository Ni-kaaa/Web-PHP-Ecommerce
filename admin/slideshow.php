<?php
require_once "../auth/auth.php";
require_once "../lib/db.php";

$db = new Database();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $data = [
    "title" => $_POST['title'],
    "subtitle" => $_POST['subtitle'],
    "text" => $_POST['text'],
    "ssorder" => $_POST['ssorder'],
    "enable" => isset($_POST['enable']) ? 1 : 0,
    "link" => $_POST['link'],
  ];

  if (!empty($_FILES['img']['name']) && $_FILES['img']['error'] == 0) {
    $uploadDir = "../assets/images/template/slider/";

    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0777, true);
    }

    $imgPath = $uploadDir . basename($_FILES['img']['name']);
    $imgName = basename($_FILES['img']['name']);
    if (move_uploaded_file($_FILES['img']['tmp_name'], $imgPath)) {
      $data["img"] = str_replace("../", "", $imgName);
    } else {
      error_log("File upload failed: " . $_FILES['img']['name']);
    }
  }

  if (isset($_POST['update_slide'])) {
    $db->update("tb_slideshow", $data, "ssid=" . $_POST['slide_id']);
  } elseif (isset($_POST['delete_slide'])) {
    $db->delete("tb_slideshow", "ssid", $_POST['slide_id']);
  } else {
    $db->insert("tb_slideshow", $data);
  }
}

$slides = $db->select("tb_slideshow", "*", "enable='1' || enable='0'", "ORDER BY ssorder ASC");
?>

<div class="main-content">
  <section class="section">
    <h1>Slideshow Management</h1>

    <form action="" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="slide_id" id="slide_id">

      <div class="form-group">
        <label>Title</label>
        <input type="text" name="title" id="title" class="form-control" placeholder="Enter title for your slide" required autofocus>
      </div>

      <div class="form-group">
        <label>Subtitle</label>
        <input type="text" name="subtitle" id="subtitle" class="form-control" placeholder="Enter subtitle for your slide">
      </div>

      <div class="form-group">
        <label>Description</label>
        <textarea name="text" id="text" class="form-control" placeholder="Enter description for your slide"></textarea>
      </div>

      <div class="form-group">
        <label>Slide Order</label>
        <input type="number" name="ssorder" id="ssorder" class="form-control" placeholder="Enter number for your slide order" required>
      </div>

      <div class="form-group">
        <label>Enable Slide</label>
        <input type="checkbox" name="enable" id="enable" value="1">
        <label>(Choose enable: show your slide)</label>
      </div>

      <div class="form-group">
        <label>Link (Optional)</label>
        <input type="text" name="link" id="link" class="form-control" placeholder="Enter link for your slide">
      </div>

      <div class="form-group">
        <label>Upload Image</label>
        <input type="file" name="img" id="img" class="form-control">
        <label>Recommend size: 1920 x 400 (pixel)</label>
      </div>

      <button type="submit" name="add_slide" id="add_slide" class="btn btn-primary">Add Slide</button>
      <button type="submit" name="update_slide" id="update_slide" class="btn btn-success" style="display:none;">Update Slide</button>
      <button type="submit" name="delete_slide" id="delete_slide" class="btn btn-danger" style="display:none;" onclick="return confirm('Are you sure you want to delete this slide?');">Delete Slide</button>
    </form>


    <hr>

    <h2>Existing Slides</h2>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Title</th>
          <th>Subtitle</th>
          <th>Description</th>
          <th>Image</th>
          <th>Order</th>
          <th>Enabled</th>
          <th>Link</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($slides as $slide): ?>
          <tr>
            <td><?php echo $slide['ssid']; ?></td>
            <td><?php echo $slide['title']; ?></td>
            <td><?php echo $slide['subtitle']; ?></td>
            <td><?php echo $slide['text']; ?></td>
            <td><img src="<?php echo $slide['img']; ?>" width="100"></td>
            <td><?php echo $slide['ssorder']; ?></td>
            <td><?php echo $slide['enable'] ? "Yes" : "No"; ?></td>
            <td><a href="<?php echo $slide['link']; ?>" target="_blank">Visit</a></td>
            <td>
              <button class="btn btn-warning btn-sm edit-slide" data-slide='<?php echo json_encode($slide); ?>'>Edit</button>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </section>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".edit-slide").forEach(button => {
      button.addEventListener("click", function() {
        let slide = JSON.parse(this.getAttribute("data-slide"));

        document.getElementById("slide_id").value = slide.ssid;
        document.getElementById("title").value = slide.title;
        document.getElementById("subtitle").value = slide.subtitle;
        document.getElementById("text").value = slide.text;
        document.getElementById("ssorder").value = slide.ssorder;
        document.getElementById("enable").checked = slide.enable == 1;
        document.getElementById("link").value = slide.link;

        document.getElementById("add_slide").style.display = "none";
        document.getElementById("update_slide").style.display = "inline-block";
        document.getElementById("delete_slide").style.display = "inline-block";
      });
    });
  });
</script>