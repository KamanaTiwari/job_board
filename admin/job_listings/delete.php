<?php
include("../config/config.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM job_listings WHERE id = ?";
    if ($stmt = $con->prepare($query)) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            header('Location: index.php');
            exit();
        } else {
            echo "Error deleting record: " . $con->error;
        }
    } else {
        echo "Error preparing statement: " . $con->error;
    }
} else {
    echo "No ID provided.";
}
?>

