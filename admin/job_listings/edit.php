<?php require('../includes/header.php'); ?>
<?php require('../includes/navbar.php'); ?>
<?php require('../includes/sidebar.php'); ?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Manage Job Listing</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Job Listing</li>
        <li class="breadcrumb-item active">Manage Job Listing > Edit</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-title">Manage Job Listing</h5>
              <a class="fs-3" href="index.php" role="button"><i class="fa-solid fa-circle-chevron-left"></i></a>
            </div>

            <?php
            if (isset($_GET['id'])) {
              $id = $_GET['id'];

              $query = "SELECT * FROM job_listings WHERE id = ?";
              if ($stmt = $con->prepare($query)) {
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_assoc();
              }
            }

            if (isset($_POST['submit'])) {
              $title = $_POST['title'];
              $description = $_POST['description'];
              $location = $_POST['location'];
              $salary_range = $_POST['salary_range'];
              $benefits = $_POST['benefits'];
              
              // Handle file upload for requirements
              if (isset($_FILES['requirements']) && $_FILES['requirements']['error'] == UPLOAD_ERR_OK) {
                $file_name = $_FILES['requirements']['name'];
                $file_tmp_name = $_FILES['requirements']['tmp_name'];
                $file_size = $_FILES['requirements']['size'];
                $file_type = $_FILES['requirements']['type'];
                $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                
                // Define the allowed file extensions
                $allowed_ext = array("pdf", "doc", "docx");
                if (in_array($file_ext, $allowed_ext) && $file_size <= 2000000) {
                  $new_file_name = uniqid() . '.' . $file_ext;
                  $target_file = '../uploads/' . $new_file_name;
                  if (move_uploaded_file($file_tmp_name, $target_file)) {
                    $requirements = $new_file_name;
                  } else {
                    echo "<div class='alert alert-danger' role='alert'>Error uploading file</div>";
                    exit();
                  }
                } else {
                  echo "<div class='alert alert-danger' role='alert'>Invalid file type or size</div>";
                  exit();
                }
              } else {
                $requirements = $data['requirements']; // Keep the existing file if no new file is uploaded
              }

              if ($title != "" && $description != "" && $requirements != "" && $location != "" && $salary_range != "" && $benefits != "") {
                $insert = "UPDATE job_listings SET  title='$title', description='$description',requirements='$requirements',location='$location',salary_range='$salary_range',benefits= '$benefits'where id='$id'";
                $result = mysqli_query($con, $insert);

                if ($result) {
            ?>location
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Job  Listings Updated</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                <?php
                  echo "<meta http-equiv=\"refresh\" content=\"2;URL=index.php?success\">";
                } else {
                ?>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Job  Listings was not Updated</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
            <?php
                  echo "<meta http-equiv=\"refresh\" content=\"2;URL=create.php?error\">";
                }
              } else {
                echo "<meta http-equiv=\"refresh\" content=\"2;URL=create.php?empty\">";
              }
            }

            ?>
            <form action="edit.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $data['title']; ?>" required>
              </div>
              <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required><?php echo $data['description']; ?></textarea>
              </div>
              <div class="mb-3">
                <label for="requirements" class="form-label">Requirements</label>
                <input type="file" class="form-control" name="requirements" id="requirements">
              </div>
              <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" name="location" value="<?php echo $data['location']; ?>" required>
              </div>
              <div class="mb-3">
                <label for="salary_range" class="form-label">Salary Range</label>
                <input type="text" class="form-control" id="salary_range" name="salary_range" value="<?php echo $data['salary_range']; ?>" required>
              </div>
              <div class="mb-3">
                <label for="benefits" class="form-label">Benefits</label>
                <textarea class="form-control" id="benefits" name="benefits" rows="3" required><?php echo $data['benefits']; ?></textarea>
              </div>
              <button type="submit" name="submit" class="btn btn-danger btn-sm">Update</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</main><!-- End #main -->

<?php require('../includes/footer.php'); ?>
