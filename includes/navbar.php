<header>
  <div class="header-area header-transparrent">
    <div class="headder-top header-sticky">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-3 col-md-2">
            <div class="logo">
              <a href="index.php"><img src="assets/img/logo/intern.logo.png" alt=""></a>
            </div>
          </div>
          <div class="col-lg-9 col-md-9">
            <div class="menu-wrapper">
              <div class="main-menu">
                <nav class="d-none d-lg-block">
                  <ul id="navigation">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="job_listing.php">Job_Listing</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="#">Page</a>
                      <ul class="submenu">
                        <li><a href="job_details.php">Job Details</a></li>
                      </ul>
                    </li>
                    <li><a href="contact.php">Contact</a></li>
                  </ul>
                </nav>
              </div>
              

              <?php
              if (isset($_SESSION['id'])) {
                $id = $_SESSION['id'];
                $select = "SELECT * from users where id='$id'";
                $result = mysqli_query($con, $select);
                if (mysqli_num_rows($result) > 0) {
                  $data = mysqli_fetch_assoc($result);
                  $username = $data['username'];
              ?>
                  <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                      <?php echo $username; ?>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <li><a class="dropdown-item" href="#">Logout</a></li>

                    </ul>
                  </div>
              <?php
                }
              }else{
                ?>
                <div class="header-btn d-none f-right d-lg-block">
                <a href="register.php" class="btn head-btn1">Register</a>
                <a href="login.php" class="btn head-btn2">Login</a>
              </div>
            </div>
            <?php
              }
              ?>
          </div>
        </div>
        <div class="col-12">
          <div class="mobile_menu d-block d-lg-none"></div>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
</header>
