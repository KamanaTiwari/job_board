<?php require('../includes/header.php'); ?>
<?php require('../includes/navbar.php'); ?>
<?php require('../includes/sidebar.php'); ?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Job Seeker Profile</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item">Job Seekers</li>
        <li class="breadcrumb-item active">Create Profile</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-primary">Create New Profile</h5>

            <?php
            if (isset($_POST['submit'])) {
              $name = $_POST['name'];
              $email = $_POST['email'];
              $password = $_POST['password'];
              $resume = $_FILES['resume']['name'];
              $resume_size = $_FILES['resume']['size'];
              $resume_tmp = $_FILES['resume']['tmp_name'];
              $resume_ext = strtolower(pathinfo($resume, PATHINFO_EXTENSION));
              $resume_new_name = time() . '_' . $resume;

              if ($name != "" && $email != "" && $password != "" && $resume != "") {
                if ($resume_size < 2000000) {
                  if ($resume_ext == "pdf" || $resume_ext == "doc" || $resume_ext == "docx") {
                    if (move_uploaded_file($resume_tmp, '../uploads/' . $resume_new_name)) {
                      $insert = "INSERT INTO job_seekers (name, email, password, resume) VALUES ('$name', '$email', '$password', '$resume_new_name')";
                      $result = mysqli_query($con, $insert);
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
            <form action="" method="POST" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
              </div>
              <div class="mb-3">
                <label for="resume" class="form-label">Resume</label>
                <input type="file" class="form-control" name="resume" id="resume" required>
              </div>
              <button type="submit" class="btn btn-primary" name="submit">Create</button>
              <span> Already have an account? <a href="login.php">Login</a></span>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</main><!-- End #main -->

<?php require('../includes/footer.php'); ?>
