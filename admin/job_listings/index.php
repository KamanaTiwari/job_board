<?php
require('../includes/header.php');
require('../includes/navbar.php');
require('../includes/sidebar.php');
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Job Listings</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item">Job Listings</li>
                <li class="breadcrumb-item active">Index</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Job Listings</h5>
                        <a href="create.php" class="btn btn-primary mb-3">Create New Listing</a>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Requirements</th>
                                    <th>Location</th>
                                    <th>Salary Range</th>
                                    <th>Benefits</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM job_listings";
                                $result = mysqli_query($con, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>{$row['id']}</td>";
                                    echo "<td>{$row['title']}</td>";
                                    echo "<td>{$row['description']}</td>";
                                    echo "<td><a href='../uploads/{$row['requirements']}' target='_blank'>View Requirements</a></td>";
                                    echo "<td>{$row['location']}</td>";
                                    echo "<td>{$row['salary_range']}</td>";
                                    echo "<td>{$row['benefits']}</td>";
                                    echo "<td>
                                            <a href='edit.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                            <a href='delete.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this listing?\")'>Delete</a>
                                          </td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

<?php require('../includes/footer.php'); ?>
