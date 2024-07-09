<?php require('../includes/header.php'); ?>
<?php require('../includes/navbar.php'); ?>
<?php require('../includes/sidebar.php'); ?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Create Job Listing</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="index.php">Job Listings</a></li>
        <li class="breadcrumb-item active">Create</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-title">Create New Listing</h5>
              <a class="fs-3" href="index.php" role="button"><i class="fa-solid fa-circle-chevron-left"></i></a>
            </div>

            <?php
            if (isset($_POST['submit'])) {
              $title = mysqli_real_escape_string($con, trim($_POST['title']));
              $description = mysqli_real_escape_string($con, trim($_POST['description']));
              $requirements = $_FILES['requirements']['name'];
              $requirements_tmp = $_FILES['requirements']['tmp_name'];
              $requirements_size = $_FILES['requirements']['size'];
              $requirements_ext = strtolower(pathinfo($requirements, PATHINFO_EXTENSION));
              $requirements_new_name = time() . '_' . $requirements;
              $location = mysqli_real_escape_string($con, trim($_POST['location']));
              $salary_range = mysqli_real_escape_string($con, trim($_POST['salary_range']));
              $benefits = mysqli_real_escape_string($con, trim($_POST['benefits']));

              if ($title != "" && $description != "" && $requirements != "" && $location != "" && $salary_range != "" && $benefits != "") {
                if ($requirements_size < 2000000) {
                  if ($requirements_ext == "pdf" || $requirements_ext == "doc" || $requirements_ext == "docx") {
                    if (move_uploaded_file($requirements_tmp, '../uploads/' . $requirements_new_name)) {
                      $query = "INSERT INTO job_listings (title, description, requirements, location, salary_range, benefits) 
                                VALUES ('$title', '$description', '$requirements_new_name', '$location', '$salary_range', '$benefits')";
                      $result = mysqli_query($con, $query);
                      if ($result) {
                        echo "<div class='alert alert-success'>Profile created successfully</div>";
                        echo "<meta http-equiv='refresh' content='2;URL=index.php'>";
                      } else {
                        echo "<div class='alert alert-danger'>Profile creation failed</div>";
                      }
                    } else {
                      echo "<div class='alert alert-danger'>File upload failed</div>";
                    }
                  } else {
                    echo "<div class='alert alert-warning'>Invalid file type. Only PDF, DOC, and DOCX are allowed</div>";
                  }
                } else {
                  echo "<div class='alert alert-warning'>File size must be less than 2MB</div>";
                }
              } else {
                echo "<div class='alert alert-warning'>All fields are required</div>";
              }
            }
            ?>

            <form action="create.php" method="post" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
              </div>
              <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
              </div>
              <div class="mb-3">
                <label for="requirements" class="form-label">Requirements</label>
                <input type="file" class="form-control" name="requirements" id="requirements" required>
              </div>
              <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" name="location" required>
              </div>
              <div class="mb-3">
                <label for="salary_range" class="form-label">Salary Range</label>
                <input type="text" class="form-control" id="salary_range" name="salary_range" required>
              </div>
              <div class="mb-3">
                <label for="benefits" class="form-label">Benefits</label>
                <textarea class="form-control" id="benefits" name="benefits" required></textarea>
              </div>
              <button type="submit" name="submit" class="btn btn-primary">Create</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</main><!-- End #main -->

<?php require('../includes/footer.php'); ?>
