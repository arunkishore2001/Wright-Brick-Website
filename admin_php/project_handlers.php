<?php
include 'config.php';
include 'functions.php';

session_start();
requireLogin();

// Check which action is requested
if (isset($_POST['action'])) {
    $action = $_POST['action'];

    // Fetch Project Data
    if ($action == 'fetch') {
        $project_id = $_POST['project_id'];
        $sql = "SELECT * FROM projects WHERE project_id = $project_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $project = $result->fetch_assoc();
            echo json_encode(['status' => 'success', 'data' => $project]);
        } else {
            echo json_encode(['status' => 'error']);
        }
        exit;
    }

    // Update Project Data
    if ($action == 'update') {
        $project_id = $_POST['project_id'];
        $project_name = $_POST['project_name'];
        $description = $_POST['description'];
        $date = $_POST['date'];
        $status = $_POST['status'];
        $category = $_POST['category'];

        // Update the project details
        $sql = "UPDATE projects SET 
                    project_name = '$project_name', 
                    description = '$description', 
                    date = '$date', 
                    status = '$status', 
                    category = '$category' 
                WHERE project_id = $project_id";

        if ($conn->query($sql) === TRUE) {
            // Handle removed images
            if ($_POST['removed_images']) {
                $removedImages = json_decode($_POST['removed_images']);

                foreach ($removedImages as $image_id) {
                    // Check if the image exists before attempting to delete
                    $check_sql = "SELECT image_url FROM images WHERE image_id = $image_id";
                    $check_result = $conn->query($check_sql);

                    if ($check_result->num_rows > 0) {
                        $image_row = $check_result->fetch_assoc();
                        $image_path = $image_row['image_url'];

                        // Delete image file from server
                        if (file_exists($image_path)) {
                            unlink($image_path);
                        }

                        // Delete image from the database
                        $del_sql = "DELETE FROM images WHERE image_id = $image_id";
                        if (!$conn->query($del_sql)) {
                            error_log(" Error deleting image: " . $conn->error);
                        }
                    }
                }
            }

            // Handle new image uploads
            if (!empty($_FILES['images']['name'][0])) {
                foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                    $image_name = time() . '_' . $_FILES['images']['name'][$key];
                    $target_file = "../uploads/" . basename($image_name);

                    if (move_uploaded_file($tmp_name, $target_file)) {
                        $img_sql = "INSERT INTO images (project_id, image_url) VALUES ('$project_id', '$target_file')";
                        $conn->query($img_sql);
                    }
                }
            }

            echo "Project updated successfully!";
        } else {
            echo "Error updating project: " . $conn->error;
        }
        exit;
    }


    // Delete Project
    if ($action == 'delete') {
        $project_id = $_POST['project_id'];

        // Delete images from server
        $img_sql = "SELECT image_url FROM images WHERE project_id = $project_id";
        $img_result = $conn->query($img_sql);
        if ($img_result->num_rows > 0) {
            while ($img_row = $img_result->fetch_assoc()) {
                if (file_exists($img_row['image_url'])) {
                    unlink($img_row['image_url']);
                }
            }
        }

        // Delete project and images from database
        $del_project_sql = "DELETE FROM projects WHERE project_id = $project_id";

        if ($conn->query($del_project_sql) === TRUE) {
            echo "Project deleted successfully!";
        } else {
            echo "Error deleting project: " . $conn->error;
        }
        exit;
    }

    // Add New Project
    if ($action == 'add') {
        $project_name = $_POST['project_name'];
        $description = $_POST['description'];
        $date = $_POST['date'];
        $status = $_POST['status'];
        $category = $_POST['category'];

        $sql = "INSERT INTO projects (project_name, description, date, status, category) 
                VALUES ('$project_name', '$description', '$date', '$status', '$category')";

        if ($conn->query($sql) === TRUE) {
            $project_id = $conn->insert_id;

            // Handle image uploads
            if (!empty($_FILES['images']['name'][0])) {
                foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                    $image_name = time() . '_' . $_FILES['images']['name'][$key];
                    $target_file = "../uploads/" . basename($image_name);

                    if (move_uploaded_file($tmp_name, $target_file)) {
                        $img_sql = "INSERT INTO images (project_id, image_url) VALUES ('$project_id', '$target_file')";
                        $conn->query($img_sql);
                    }
                }
            }
            echo "New project added successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        exit;
    }
}

// If there's no action, or the action is invalid, return an error
echo "Invalid action!";
