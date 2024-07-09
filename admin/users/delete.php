
<?php

require('../config/config.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $data = "DELETE FROM users where id='$id'";
    $data_result = mysqli_query($con, $data);

    echo "<meta http-equiv=\"refresh\" content=\"2;URL=index.php?delete\">";
}

?>