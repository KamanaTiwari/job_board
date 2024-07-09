<?php
require('../includes/header.php');
require('../includes/navbar.php');
require('../includes/sidebar.php');

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Fetch data for the specified ID
  $query = "SELECT * FROM `job_categories` WHERE id='$id'";
  $data_result = mysqli_query($con, $query);

  // Check if data is fetched successfully
  if ($data_result) {
    $fetch_data = mysqli_fetch_assoc($data_result);
  } else {
    die("Error retrieving data: " . mysqli_error($con));
  }
}

if (isset($_POST['register'])) {
  $title = $_POST['title'];
  $description = $_POST['description'];
  $status = $_POST['status'];

  // Validate input fields (you can add more validation if needed)
  if (!empty($title) && !empty($description) && !empty($status)) {
    // Update query
    $update_query = "UPDATE `job_categories` SET title='$title', description='$description', status='$status' WHERE id='$id'";

    // Execute update query
    $result = mysqli_query($con, $update_query);

    // Check if update was successful
    if ($result) {
?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Job Category Updated Successfully</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php
      // Redirect after success
      echo "<meta http-equiv=\"refresh\" content=\"2;URL=index.php?success\">";
    } else {
    ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error Updating Job Category</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
<?php
      // Redirect after failure
      echo "<meta http-equiv=\"refresh\" content=\"2;URL=edit.php?id=$id&error\">";
    }
  } else {
    // Redirect if any fields are empty
    echo "<meta http-equiv=\"refresh\" content=\"2;URL=edit.php?id=$id&empty\">";
  }
}
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Manage Job Categories</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Job Categories</li>
        <li class="breadcrumb-item active">Manage Job Categories > Edit</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <h5 class="card-title">Manage Job Categories</h5>
              <a class="fs-3" href="index.php" role="button"><i class="fa-solid fa-circle-chevron-left"></i></a>
            </div>

            <form action="" method="POST" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="input1" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" value="<?php echo htmlspecialchars($fetch_data['title']); ?>" id="input1" aria-describedby="emailHelp">
              </div>
              <div class="mb-3">
                <label for="input2" class="form-label">Description</label>
                <textarea class="form-control" id="input2" name="description" rows="3"><?php echo htmlspecialchars($fetch_data['description']); ?></textarea>
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

              <button type="submit" class="btn btn-danger btn-sm" name="register">Update</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</main><!-- End #main -->

<?php require('../includes/footer.php'); ?>