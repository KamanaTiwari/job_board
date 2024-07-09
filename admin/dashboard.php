<?php require('config/config.php'); ?>
<?php require('auth/secure.php'); ?>

<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = isset($_POST['role']) ? $_POST['role'] : '';

    // Mock authentication for demonstration purposes
    // Replace with actual authentication logic, such as checking a database
    $validCredentials = [
        'admin' => ['username' => 'admin', 'password' => 'adminpass'],
        'user' => ['username' => 'user', 'password' => 'userpass']
    ];

    if (isset($validCredentials[$role]) && 
        $validCredentials[$role]['username'] == $username && 
        $validCredentials[$role]['password'] == $password) {
        
        // Store the role in session for future use
        $_SESSION['role'] = $role;

        // Redirect to the appropriate dashboard
        header("Location: {$role}_dashboard.php");
        exit;
    } else {
        echo "Invalid credentials for $role.";
    }
} else {
    echo "HTTP ERROR 405: Method Not Allowed";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<style>
      .job-card {
        margin-bottom: 20px;
      }
    </style>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Job Board</title>
  <meta content="" name="description">
  <meta content="" name="keywords">


  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/intern.logo.png" alt="">
        <span class="d-none d-lg-block">Job Board</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->



        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/kamana.png.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">Admin</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>Admin</h6>
              <span>Web Designer</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="auth/logout-process.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="dashboard.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->


      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#abouts" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Abouts</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="abouts" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="abouts/create.php">
              <i class="bi bi-circle"></i><span>Add Abouts</span>
            </a>
          </li>
          <li>
            <a href="abouts/index.php">
              <i class="bi bi-circle"></i><span>Manage Abouts</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#users" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="users" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="users/create.php">
              <i class="bi bi-circle"></i><span>Add User</span>
            </a>
          </li>
          <li>
            <a href="users/index.php">
              <i class="bi bi-circle"></i><span>Manage Users</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#new_job" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>New_Job</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="new_job" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="new_job/create.php">
              <i class="bi bi-circle"></i><span>Add New_Job</span>
            </a>
          </li>
          <li>
            <a href="new_job/index.php">
              <i class="bi bi-circle"></i><span>Manage New_Job</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#applications" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Applications</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="applications" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="applications/create.php">
              <i class="bi bi-circle"></i><span>Add Applications</span>
            </a>
          </li>
          <li>
            <a href="applications/index.php">
              <i class="bi bi-circle"></i><span>Manage Applications</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#job_seekers" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Job_Seekers</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="job_seekers" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="job_seekers/create.php">
              <i class="bi bi-circle"></i><span>Add Job_Seekers</span>
            </a>
          </li>
          <li>
            <a href="job_seekers/index.php">
              <i class="bi bi-circle"></i><span>Manage Job_Seekers</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#applied_jobs" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Applied_Jobs</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="applied_jobs" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="applied_jobs/create.php">
              <i class="bi bi-circle"></i><span>Add Applied_Jobs</span>
            </a>
          </li>
          <li>
            <a href="applied_jobs/index.php">
              <i class="bi bi-circle"></i><span>Manage Applied_Jobs</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#communications" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Communications</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="communications" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="communications/create.php">
              <i class="bi bi-circle"></i><span>Add Communications</span>
            </a>
          </li>
          <li>
            <a href="communications/index.php">
              <i class="bi bi-circle"></i><span>Manage Communications</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#job_listing" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Job_Listing</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="job_listing" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="job_listing/create.php">
              <i class="bi bi-circle"></i><span>Add Job_Listing</span>
            </a>
          </li>
          <li>
            <a href="job_listing/index.php">
              <i class="bi bi-circle"></i><span>Manage Job_Listing</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#files" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Files</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="files" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="files/create.php">
              <i class="bi bi-circle"></i><span>Add File</span>
            </a>
          </li>
          <li>
            <a href="files/index.php">
              <i class="bi bi-circle"></i><span>Manage Files</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#contacts" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Contacts</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="contacts" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="contacts/create.php">
              <i class="bi bi-circle"></i><span>Add Contact</span>
            </a>
          </li>
          <li>
            <a href="contacts/index.php">
              <i class="bi bi-circle"></i><span>Manage Contacts</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#settings" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Settings</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="settings" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="settings/create.php">
              <i class="bi bi-circle"></i><span>Add Setting</span>
            </a>
          </li>
          <li>
            <a href="settings/index.php">
              <i class="bi bi-circle"></i><span>Manage Settings</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->


      <li class="nav-heading">Pages</li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#job_categories" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Job_Categories</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="job_categories" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="job_categories/create.php">
              <i class="bi bi-circle"></i><span>Add Job_Categories</span>
            </a>
          </li>
          <li>
            <a href="job_categories/index.php">
              <i class="bi bi-circle"></i><span>Manage Job_Categories</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->


      <li class="nav-heading">Pages</li>





      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-contact.html">
          <i class="bi bi-envelope"></i>
          <span>Contact</span>
        </a>
      </li><!-- End Contact Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-register.html">
          <i class="bi bi-card-list"></i>
          <span>Register</span>
        </a>
      </li><!-- End Register Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-login.html">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Login</span>
        </a>
      </li><!-- End Login Page Nav -->


      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-error-404.html">
          <i class="bi bi-dash-circle"></i>
          <span>Error 404</span>
        </a>
      </li><!-- End Error 404 Page Nav -->
    </ul>

  </aside><!-- End Sidebar-->

 
    
  </head>

  <body>
    <main class="container mt-5">
      <h1 class="text-center">Welcome to Job Board</h1>
      <p class="text-center">Find your next career opportunity</p>

      <!-- Job Search Form -->
      <div class="row mb-4">
        <div class="col-md-8 offset-md-2">
          <form class="form-inline">
            <input class="form-control mr-sm-2 w-50" type="search" placeholder="Search for jobs" aria-label="Search">
            <input class="form-control mr-sm-2" type="search" placeholder="Location" aria-label="Location">
            <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </div>

      <!-- Job Listings -->
      <div class="row">
        <!-- Job Card 1 -->
        <div class="col-md-4 job-card">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Software Engineer</h5>
              <h6 class="card-subtitle mb-2 text-muted">Google</h6>
              <p class="card-text">Location: Mountain View, CA</p>
              <p class="card-text">Experience: 3+ years</p>
              <a href="#" class="btn btn-primary">Apply Now</a>
            </div>
          </div>
        </div>

        <!-- Job Card 2 -->
        <div class="col-md-4 job-card">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Scientist</h5>
              <h6 class="card-subtitle mb-2 text-muted">Facebook</h6>
              <p class="card-text">Location: Menlo Park, CA</p>
              <p class="card-text">Experience: 2+ years</p>
              <a href="#" class="btn btn-primary">Apply Now</a>
            </div>
          </div>
        </div>

        <!-- Job Card 3 -->
        <div class="col-md-4 job-card">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Product Manager</h5>
              <h6 class="card-subtitle mb-2 text-muted">Amazon</h6>
              <p class="card-text">Location: Seattle, WA</p>
              <p class="card-text">Experience: 5+ years</p>
              <a href="#" class="btn btn-primary">Apply Now</a>
            </div>
          </div>
        </div>
      </div>

      <!-- More job cards can be added here in a similar fashion -->
    </main>
    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
      <div class="copyright">
        &copy; Copyright <strong><span>Kamana</span></strong>. All Rights Reserved
      </div>
      <div class="credits">

        Designed by <a href="#">Kamana</a>
      </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

  </body>

  </html>