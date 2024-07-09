<?php
// Start output buffering
ob_start();

// Include necessary files
require('../includes/header.php');
require('../includes/navbar.php');
require('../includes/sidebar.php');

// Check form submission
if (isset($_POST['submit'])) {
    // Capture form inputs
    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    // Prepare SQL query with embedded variables
    $query = "INSERT INTO job_categories (title, description, status) VALUES ('$title', '$description', '$status')";

    // Execute query
    $result = mysqli_query($con, $query);

    // Check if query executed successfully
    if ($result) {
        header('Location: index.php'); // Redirect on success
        exit();
    } else {
        echo "Error: " . mysqli_error($con); // Display error if query fails
    }
}

// End output buffering and flush output
ob_end_flush();
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Add Job Categories</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Job Categories</li>
                <li class="breadcrumb-item active">Add Job Categories</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add Job Categories</h5>

                        <!-- Form for adding job categories -->
                        <form class="row g-3" method="POST" enctype="multipart/form-data">
                            <div class="col-md-12">
                                <label for="inputName5" class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" id="inputName5" required>
                            </div>
                            <div class="col-md-12">
                                <label for="inputName5" class="form-label">Description</label>
                                <textarea class="form-control" id="inputName5" name="description" rows="3"></textarea>
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
                            <div class="col-md-12">
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form><!-- End Form for adding job categories -->

                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

<?php require('../includes/footer.php'); ?>
