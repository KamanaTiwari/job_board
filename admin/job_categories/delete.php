
<?php

require('../config/config.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM job_categories WHERE id = ?";
    if ($stmt = $con->prepare($query)) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
        }
    }
}

?>