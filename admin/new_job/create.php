<?php require('../includes/header.php'); ?>

<?php require('../includes/navbar.php'); ?>

<?php require('../includes/sidebar.php'); ?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Create New Job</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="index.php">New Jobs</a></li>
        <li class="breadcrumb-item active">Create</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Create New Job</h5>
            <?php

            if (isset($_POST['submit'])) {
              $title = $_POST['title'];
              $description = $_POST['description'];
              $job_type = $_POST['job_type'];
              $status = $_POST['status'];

              if ($title != "" && $description != "" && $job_type != ""  && $status != "") {
                
              $query = "INSERT INTO new_job (title, description, job_type, status)
            VALUES ('$title', '$description', '$job_type', '$status')";

              $result = mysqli_query($con, $query);

              if ($result) {
            ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>New-Job Added</strong>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php
                echo "<meta http-equiv=\"refresh\" content=\"2;URL=index.php?success\">";
              } else {
              ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>Job not added</strong>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              <?php
                echo "<meta http-equiv=\"refresh\" content=\"2;URL=index.php?error\">";
              }
            } else {
              ?>
              <div class=" container alert alert-danger alert-dismissible fade show" role="alert">
                <strong>All Field must be Filled!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php
              echo "<meta http-equiv=\"refresh\" content=\"2;URL=create.php\">";
            }
          }
            ?>
            <form action="create.php" method="post">
              <div class="mb-3">
                <label for="title" class="form-label">Job Title</label>
                <select class="form-control" id="title" name="title" required>
                  <option value="" disabled selected>Select job title</option>
                  <option value="software_engineer">Software Engineer</option>
                  <option value="product_manager">Product Manager</option>
                  <option value="data_scientist">Data Scientist</option>
                  <option value="marketing_specialist">Marketing Specialist</option>
                  <option value="sales_representative">Sales Representative</option>
                  <option value="graphic_designer">Graphic Designer</option>
                  <option value="customer_support">Customer Support</option>
                  <option value="human_resources">Human Resources</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
              </div>
              <div class="mb-3">
                <label for="job_type" class="form-label">Job Type</label>
                <select class="form-control" id="job_type" name="job_type" required>
                  <option value="" disabled selected>Select job type</option>
                  <option value="full_time">Full-time</option>
                  <option value="part_time">Part-time</option>
                  <option value="contract">Contract</option>
                  <option value="temporary">Temporary</option>
                  <option value="internship">Internship</option>
                  <option value="freelance">Freelance</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" id="status" name="status" required>
                  <option value="" disabled selected>Select status</option>
                  <option value="open">Open</option>
                  <option value="in_progress">In Progress</option>
                  <option value="closed">Closed</option>
                  <option value="on_hold">On Hold</option>
                  <option value="cancelled">Cancelled</option>
                </select>
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