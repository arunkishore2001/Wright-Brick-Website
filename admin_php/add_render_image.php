<?php

include 'config.php';
include 'functions.php';

session_start();
requireLogin();

// Handle landing image upload
if (isset($_POST['add_render'])) {
    $title = $_POST['title'];
    // $description = $_POST['description'];
    $image = $_FILES['image'];

    if ($image['size'] <= 500 * 1024) {  // 500 KB limit
        $image_name = time() . '_' . $image['name'];  // Corrected this line
        $target_file = "../uploads/" . basename($image_name);
        

        if (move_uploaded_file($image["tmp_name"], $target_file)) {
            $imageUrl = $target_file;
            $storeTarget = "uploads/" . basename($image_name);

            // Insert image details into the database
            $query = "INSERT INTO render_images (imageUrl, title, description) VALUES ('$storeTarget', '$title', '')";
            if (mysqli_query($conn, $query)) {
                echo "New Landing Image added successfully!";
            } else {
                echo "<p class='alert alert-danger'>Database error: " . mysqli_error($conn) . "</p>";
            }
        } else {
            echo "<p class='alert alert-danger'>File upload error.</p>";
        }
    } else {
        echo "<p class='alert alert-danger'>Image size must be less than 500 KB.</p>";
    }
    exit;
}

// Handle image deletion via AJAX
if (isset($_POST['delete_render_image']) && isset($_POST['image_id'])) {
    $image_id = $_POST['image_id'];

    // Get image URL to delete from filesystem
    $result = mysqli_query($conn, "SELECT imageUrl FROM render_images WHERE id = $image_id");
    $image = mysqli_fetch_assoc($result);
    $imageUrl = '../' . $image['imageUrl'];

    if ($image) {
        // Delete the file from the filesystem
        if (unlink($imageUrl)) {
            // Remove the image record from the database
            $deleteQuery = "DELETE FROM render_images WHERE id = $image_id";
            if (mysqli_query($conn, $deleteQuery)) {
                // Send success response in JSON format
                echo "Render Image deleted successfully.";
            } else {
                // Send failure response in JSON format
                echo "Database error: " . mysqli_error($conn);
            }
        } else {
            // Send failure response in JSON format if file deletion fails
            echo "Failed to delete image file.";
        }
    } else {
        // Send failure response in JSON format if image not found
        echo "Image not found.";
    }
}
?>