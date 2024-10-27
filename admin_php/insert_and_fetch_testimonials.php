<?php
include 'config.php'; // Include your database connection settings

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handling the form submission
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $designation = mysqli_real_escape_string($conn, $_POST['designation']);
    $review = mysqli_real_escape_string($conn, $_POST['review']);
    $visible = 0; // Set to 0 if you want the review to be visible after admin approval

    // Default picture if photo is not selected
    $defaultPicture = "uploads/default-profile.png";

    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == UPLOAD_ERR_OK) {
        $target_dir = "../uploads/";
        $original_path = "uploads/";
        $target_file_name = basename($_FILES["photo"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file_name, PATHINFO_EXTENSION));

        // Debugging information
        error_log("File name: $target_file_name");
        error_log("File type: $imageFileType");

        if ($_FILES["photo"]["size"] > 200000) {
            echo json_encode(['status' => 'error', 'message' => 'Sorry, your file is too large.']);
            exit;
        }

        $allowed_types = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType, $allowed_types)) {
            echo json_encode(['status' => 'error', 'message' => 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.']);
            exit;
        }

        $unique_name = pathinfo($target_file_name, PATHINFO_FILENAME) . "_" . time() . "." . $imageFileType;
        $target_file = $target_dir . $unique_name;
        $photoPath = $original_path . $unique_name;

        if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            echo json_encode(['status' => 'error', 'message' => 'Sorry, there was an error uploading your file.']);
            exit;
        }
    } else {
        // Use default picture if photo is not selected
        $photoPath = $defaultPicture;
    }

    $sql = "INSERT INTO reviews (name, designation, photo, review, visible)
    VALUES ('$name', '$designation', '$photoPath', '$review', '$visible')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['status' => 'success', 'message' => 'Thanks for your valuable review!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . $sql . "<br>" . $conn->error]);
    }

    $conn->close();
    exit; // End the script here if it's a POST request
}

// Fetching the reviews for GET requests
$result = $conn->query("SELECT name, designation, photo, review FROM reviews WHERE visible = 1");
$testimonials = [];

while ($row = $result->fetch_assoc()) {
    $testimonials[] = [
        'text' => $row['review'],
        'author' => $row['name'],
        'handle' => $row['designation'],
        'avatar' => $row['photo'] // Use the uploaded photo or default
    ];
}

header('Content-Type: application/json');
echo json_encode($testimonials);

$conn->close();
?>
