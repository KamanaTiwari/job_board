<?php
include("../config/config.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM new_job WHERE id = ?";
    if ($stmt = $con->prepare($query)) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            header('Location: index.php');
            exit();
        } else {
            echo "Error: " . $con->error;
        }
    } else {
        echo "Error preparing statement: " . $con->error;
    }
}
