<?php

include 'config.php';

// Get the ID from the query string
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM properties WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: property_view.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

// Close connection
$conn->close();
?>
