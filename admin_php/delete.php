<?php
// Include database connection
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the image path to delete the file from the server
    $sql = "SELECT image_path FROM landing_images WHERE id=$id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $imagePath = $row['image_path'];
        
        // Delete the file from the server
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        // Now delete the record from the database
        $sql = "DELETE FROM landing_images WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully.";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    } else {
        echo "No image found.";
    }
}

// Redirect back to admin dashboard
header("Location: ../admin_dashboard.php");
exit();
?>
