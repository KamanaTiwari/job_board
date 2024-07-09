<?php
require('../includes/header.php');
require('../includes/navbar.php');
require('../includes/sidebar.php');

// Initialize variables to hold job seeker data
$id = null;
$name = '';
$email = '';
$password = '';
$resume = '';

// Fetch job seeker data based on ID from GET parameter
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM job_seekers WHERE id=?";
    if ($stmt = $con->prepare($query)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        // Assign fetched data to variables
        if ($data) {
            $name = $data['name'];
            $email = $data['email'];
            // Assuming password and resume are not retrieved for security reasons
        } else {
            echo "<div class='alert alert-danger'>Job seeker not found</div>";
            exit; // Stop further execution if job seeker is not found
        }
    }
}

// Handle form submission for updating job seeker profile
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $resume = $_FILES['resume']['name'];
    $resume_size = $_FILES['resume']['size'];
    $resume_tmp = $_FILES['resume']['tmp_name'];
    $resume_ext = strtolower(pathinfo($resume, PATHINFO_EXTENSION));
    $resume_new_name = time() . '_' . $resume;

    // Validate and process the form inputs
    if ($name != "" && $email != "" && $password != "") {
        $update_fields = array();

        // Handle resume file upload if provided
        if ($resume != "") {
            if ($resume_size < 2000000) {
                if ($resume_ext == "pdf" || $resume_ext == "doc" || $resume_ext == "docx") {
                    if (move_uploaded_file($resume_tmp, '../uploads/' . $resume_new_name)) {
                        $update_fields[] = "resume='$resume_new_name'";
                    } else {
                        echo "<div class='alert alert-danger'>File upload failed</div>";
                    }
                } else {
                    echo "<div class='alert alert-warning'>Invalid file type. Only PDF, DOC, and DOCX are allowed</div>";
                }
            } else {
                echo "<div class='alert alert-warning'>File size must be less than 2MB</div>";
            }
        }

        // Prepare SQL query for updating job seeker data
        if (!empty($update_fields)) {
            $update_query = "UPDATE job_seekers SET ";
            $update_query .= implode(", ", $update_fields);
            $update_query .= " WHERE id=$id";
            
            $result = mysqli_query($con, $update_query);
            if ($result) {
                echo "<div class='alert alert-success'>Profile updated successfully</div>";
                echo "<meta http-equiv='refresh' content='2;URL=index.php'>";
            } else {
                echo "<div class='alert alert-danger'>Profile update failed</div>";
            }
        } else {
            echo "<div class='alert alert-info'>No updates were made</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>All fields are required</div>";
    }
}
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Edit Job Seeker Profile</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item">Job Seekers</li>
        <li class="breadcrumb-item active">Edit Profile</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-primary">Edit Profile</h5>

            <form action="" method="POST" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="<?php echo htmlspecialchars($name); ?>" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>" required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" value="<?php echo htmlspecialchars($password); ?>" required>
              </div>
              <div class="mb-3">
                <label for="resume" class="form-label">Resume</label>
                <input type="file" class="form-control" name="resume" id="resume">
              </div>
              <button type="submit" class="btn btn-primary" name="submit">Update Profile</button>
              <a href="index.php" class="btn btn-secondary">Cancel</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</main><!-- End #main -->

<?php require('../includes/footer.php'); ?>
