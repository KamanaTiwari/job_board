<?php require('../includes/header.php'); ?>

<?php require('../includes/navbar.php'); ?>

<?php require('../includes/sidebar.php'); ?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Manage New Jobs</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">New Jobs</li>
        <li class="breadcrumb-item active">Manage New Jobs > Edit</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-title">Manage New Jobs</h5>
              <a class="fs-3" href="index.php" role="button"><i class="fa-solid fa-circle-chevron-left"></i></a>
            </div>

            <?php

            if (isset($_GET['id'])) {
              $id = $_GET['id'];

              $data = "SELECT * FROM new_job where id='$id'";
              $data_result = mysqli_query($con, $data);
              $fetch_data = mysqli_fetch_assoc($data_result);
            }

            if (isset($_POST['register'])) {
              $title = $_POST['title'];
              $description = $_POST['description'];
              $job_type = $_POST['job_type'];
              $status = $_POST['status'];

              if ($title != "" && $description != "" && $job_type != "" && $status != "") {
                $insert = "UPDATE new_job SET title='$title',description='$description',job_type='$job_type',status='$status' where id='$id'";
                $result = mysqli_query($con, $insert);

                if ($result) {
            ?>
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Job Updated</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                <?php
                  echo "<meta http-equiv=\"refresh\" content=\"2;URL=index.php?success\">";
                } else {
                ?>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Job was not Updated</strong>
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
            <form action="create.php" method="post">
              <div class="mb-3">
                <label for="title" class="form-label">Job Title</label>
                <select class="form-control" id="title" name="title" required>
                  <option value="" disabled selected><?php echo $fetch_data['title']; ?></option>
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
                <textarea class="form-control" id="description" name="description" required><?php echo $fetch_data['description'] ?></textarea>
              </div>
              <div class="mb-3">
                <label for="job_type" class="form-label">Job Type</label>
                <select class="form-control" id="job_type" name="job_type" required>
                  <option value="" disabled selected><?php echo $fetch_data['job_type']; ?></option>
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
                  <option value="" disabled selected><?php echo $fetch_data['status']; ?></option>
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

  <?php require('../includes/footer.php') ?>