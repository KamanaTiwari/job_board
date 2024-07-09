<?php require('../includes/header.php'); ?>

<?php require('../includes/navbar.php'); ?>

<?php require('../includes/sidebar.php'); ?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>New Jobs</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item">New Jobs</li>
        <li class="breadcrumb-item active">Index</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">New Jobs</h5>
            <a href="create.php" class="btn btn-primary mb-3">Create New Job</a>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Job Type</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $query = "SELECT * FROM new_job";
                $result = mysqli_query($con, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                  echo "<tr>";
                  echo "<td>{$row['id']}</td>";
                  echo "<td>{$row['title']}</td>";
                  echo "<td>{$row['description']}</td>";
                  echo "<td>{$row['job_type']}</td>";
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
          </div>
        </div>
      </div>
    </div>
  </section>
</main><!-- End #main -->

<?php require('../includes/footer.php'); ?>