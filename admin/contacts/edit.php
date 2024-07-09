<?php require('../includes/header.php'); ?>
<?php require('../includes/navbar.php'); ?>
<?php require('../includes/sidebar.php'); ?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Update Contacts</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item">Contacts</li>
        <li class="breadcrumb-item active">Update Contacts</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Update Contacts</h5>

            <?php
            if (isset($_GET['id'])) {
              $id = $_GET['id'];
              $show_query = "SELECT * FROM contacts WHERE id='$id'";
              $show_result = mysqli_query($con, $show_query);
              // To get only one row data
              $data = mysqli_fetch_assoc($show_result);
            }

            if (isset($_POST['submit'])) {
              $name = $_POST['name'];
              $email = $_POST['email'];
              $message = $_POST['message'];

              // validation to input field
              if ($name != "" && $email != "" && $message != "") {
                $query = "UPDATE contacts SET name='$name', email='$email', message='$message' WHERE id='$id'"; // Corrected query
                $result = mysqli_query($con, $query); 

                if ($result) {
            ?>
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Contact is updated</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                <?php
                  echo "<meta http-equiv=\"refresh\" content=\"2;URL=index.php?success\">";
                } else {
                ?>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Contact is not updated</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
            <?php
                  echo "<meta http-equiv=\"refresh\" content=\"2;URL=edit.php?id=$id&error\">";
                }
              } else {
                echo "<meta http-equiv=\"refresh\" content=\"2;URL=edit.php?id=$id&empty\">";
              }
            }

            ?>

            <!-- Multi Columns Form -->
            <a class="btn btn-success btn-sm " href="index.php" role="button">Manage Contacts</a>

            <form class="row g-3" action="" method="POST" enctype="multipart/form-data">

              <div class="col-md-6">
                <label for="inputName5" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="inputName5" value="<?php echo $data['name']; ?>" required>
              </div>

              <div class="col-md-6">
                <label for="inputEmail5" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="inputEmail5" value="<?php echo $data['email']; ?>" required>
              </div>

              <div class="col-md-12">
                <label for="inputMessage5" class="form-label">Message</label>
                <textarea id="inputMessage5" name="message" class="form-control" cols="30" rows="3" required><?php echo $data['message']; ?></textarea>
              </div>
              <div class="col-md-12">
                <button type="submit" class="btn btn-danger" name="submit">Update</button>
              </div>
            </form><!-- End Multi Columns Form -->

          </div>
        </div>
      </div>
    </div>
  </section>

</main><!-- End #main -->

<?php require('../includes/footer.php'); ?>
