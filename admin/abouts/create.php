<?php
require('../includes/header.php');
require('../includes/navbar.php');
require('../includes/sidebar.php');
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Create Abouts</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Abouts</li>
        <li class="breadcrumb-item active">Create Abouts</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Multi Columns Form</h5>

            <?php
            if (isset($_POST['submit'])) {
              $top_title = $_POST['top_title'];
              $title = $_POST['title'];
              $filename = $_FILES['dataFile']['name'];
              $filesize = $_FILES['dataFile']['size'];
              $description = $_POST['description'];

              if (!empty($top_title) && !empty($title) && !empty($description) && !empty($filename)) {
                if ($filesize < 20480) { // Check if file size is less than 20KB
                  $explode = explode('.', $filename);
                  if (count($explode) > 1) {
                    $file = strtolower($explode[0]);
                    $ext = strtolower(end($explode)); // Get the extension
                    $finalname = $file . time() . '.' . $ext;
                    
                    if (in_array($ext, ["png", "jpg", "jpeg"])) {
                      if (move_uploaded_file($_FILES['dataFile']['tmp_name'], '../uploads/' . $finalname)) {
                        $insert = "INSERT INTO abouts (top_title, title, img, description)  
                                   VALUES ('$top_title', '$title', '$finalname', '$description')";
                        $result = mysqli_query($con, $insert);

                        if ($result) {
                          echo "File is submitted";
                          echo "<meta http-equiv=\"refresh\" content=\"2;URL=index.php\">";
                        } else {
                          echo "File is not submitted";
                        }
                      } else {
                        echo "File is not uploaded";
                      }
                    } else {
                      echo "File extension must be PNG, JPG, or JPEG";
                    }
                  } else {
                    echo "Invalid file format";
                  }
                } else {
                  echo "File size must be less than 20KB";
                }
              } else {
                echo "All fields are required";
              }
            }
            ?>

            <form action="" method="POST" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="inputTopTitle" class="form-label">Top Title</label>
                <input type="text" class="form-control" name="top_title" id="inputTopTitle" aria-describedby="topTitleHelp">
              </div>
              <div class="mb-3">
                <label for="input1" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" id="input1" aria-describedby="titleHelp">
              </div>
              <div class="mb-3">
                <label for="inputFile" class="form-label">Image</label>
                <input type="file" class="form-control" name="dataFile" id="inputFile" aria-describedby="fileHelp">
              </div>
              <div class="mb-3">
                <label for="inputDescription" class="form-label">Description</label>
                <textarea class="form-control" id="inputDescription" name="description" rows="3"></textarea>
              </div>
              <button type="submit" class="btn btn-danger btn-sm" name="submit">Submit</button>
              <span>Have an account? <a href="index.php">Login</a></span>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

</main><!-- End #main -->

<?php require('../includes/footer.php'); ?>
