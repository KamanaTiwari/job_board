<?php
require('../includes/header.php');
require('../includes/navbar.php');
require('../includes/sidebar.php');

// Handle success message after update
if (isset($_GET['success'])) {
?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Data updated successfully!</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
    echo "<meta http-equiv=\"refresh\" content=\"2;URL=index.php\">";
}

// Handle delete operation
if (isset($_GET['delete']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $delete_query = "DELETE FROM job_categories WHERE id='$id'";
    $delete_result = mysqli_query($con, $delete_query);

    if ($delete_result) {
    ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Job category removed successfully!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
        echo "<meta http-equiv=\"refresh\" content=\"2;URL=index.php\">";
    } else {
        echo "Error deleting category: " . mysqli_error($con);
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
                <li class="breadcrumb-item active">Manage Job Categories</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Manage Job Categories</h5>

                        <!-- Table with job categories -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Fetch all job categories from the database
                                $select_query = "SELECT * FROM job_categories";
                                $result = mysqli_query($con, $select_query);
                                $i = 0;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>{$row['id']}</td>";
                                    echo "<td>{$row['title']}</td>";
                                    echo "<td>{$row['description']}</td>";
                                    echo "<td>{$row['status']}</td>";
                                    echo "<td>
                                                              <a href='edit.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                                              <a href='delete.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this job?\")'>Delete</a>
                                                            </td>";
                                    echo "</tr>";
                                  }
                                ?>
                            </tbody>
                        </table>
                        <!-- End Table -->

                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

<?php require('../includes/footer.php'); ?>
