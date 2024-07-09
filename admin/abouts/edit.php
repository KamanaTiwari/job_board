<?php
require('../includes/header.php');
require('../includes/navbar.php');
require('../includes/sidebar.php');
require('../config/config.php');
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Update Abouts</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Abouts</li>
        <li class="breadcrumb-item active">Update Abouts</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Update Abouts</h5>

            <?php
            if (isset($_GET['id'])) {
              $id = $_GET['id'];
              $query = "SELECT * FROM abouts WHERE id=$id";
              $result = mysqli_query($con, $query);
              if (!$result) {
                die("Query Failed: " . mysqli_error($con));
              }
              $data = mysqli_fetch_assoc($result);
            }
            ?>

            <?php
            if (isset($_POST['submit'])) {
              $top_title = $_POST['top_title'];
              $title = $_POST['title'];
              $file_name = $_FILES['dataFile']['name'];
              $file_size = $_FILES['dataFile']['size'];
              $description = $_POST['description'];

              // Updating without new image
              if ($top_title != "" && $title != "" && $file_name == "" && $description != "") {
                $querry = "UPDATE abouts SET top_title='$top_title', title='$title', description='$description' WHERE id='$id'";
                $result = mysqli_query($con, $querry);
                if ($result) {
                  echo "<div class='alert alert-success'>Updated title and description</div>";
                } else {
                  echo "<div class='alert alert-danger'>Not updated</div>";
                }
              }

              // Updating with new image
              if ($top_title != "" && $title != "" && $file_name != "" && $description != "") {
                if ($file_size < 2000000) {
                  $explode = explode('.', $file_name);
                  $file = strtolower($explode[0]);
                  $ext = strtolower($explode[1]);
                  $replace = str_replace(' ', '', $file);
                  $finalname = $replace . time() . '.' . $ext;
                  $target_file = '../uploads/' . $finalname;

                  if ($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg') {
                    if (!empty($data['img'])) {
                      $oldfilelink = $data['img'];
                      $finallink = '../uploads/' . $oldfilelink;
                      if (file_exists($finallink)) {
                        unlink($finallink);
                      }
                    }

                    if (move_uploaded_file($_FILES['dataFile']['tmp_name'], $target_file)) {
                      $querry = "UPDATE abouts SET top_title='$top_title', title='$title', img='$finalname',  description='$description' WHERE id='$id'";
                      $result = mysqli_query($con, $querry);
                      if ($result) {
                        echo "<div class='alert alert-success'>About is updated</div>";
                        echo "<meta http-equiv='refresh' content='2;URL=index.php'>";
                      } else {
                        echo "<div class='alert alert-danger'>File is not uploaded</div>";
                      }
                    } else {
                      echo "<div class='alert alert-danger'>File upload failed</div>";
                    }
                  } else {
                    echo "<div class='alert alert-danger'>Extension doesn't match</div>";
                  }
                } else {
                  echo "<div class='alert alert-primary'>File size must be less than 2MB</div>";
                }
              }
            }
            ?>

            <a class="btn btn-success btn-sm" href="index.php" role="button">Manage Abouts</a>
            <form action="" method="POST" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="input1" class="form-label">Top Title</label>
                <input type="text" class="form-control" name="top_title" value="<?php echo htmlspecialchars($data['top_title']); ?>" id="input1">
              </div>
              <div class="mb-3">
                <label for="input2" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" value="<?php echo htmlspecialchars($data['title']); ?>" id="input2">
              </div>
              <div class="mb-3">
                <label for="input3" class="form-label">Description</label>
                <textarea class="form-control" id="input3" name="description" rows="3"><?php echo htmlspecialchars($data['description']); ?></textarea>
              </div>
              <div class="mb-3">
                <?php if (!empty($data['img_link'])): ?>
                  <img src="../uploads/<?php echo htmlspecialchars($data['img_link']); ?>" alt="Image" width="100" height="100">
                <?php else: ?>
                  <p>No image available</p>
                <?php endif; ?>
              </div>
              <div class="mb-3">
                <label for="input4" class="form-label">Image</label>
                <input type="file" class="form-control" name="dataFile" id="input4">
              </div>
              <button type="submit" class="btn btn-danger btn-sm" name="submit">Update</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</main><!-- End #main -->

<?php require('../includes/footer.php'); ?>
