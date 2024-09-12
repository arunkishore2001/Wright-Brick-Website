<?php
include 'config.php';

session_start();

$name = mysqli_real_escape_string($conn, $_POST['name']);
$designation = mysqli_real_escape_string($conn, $_POST['designation']);
$review = mysqli_real_escape_string($conn, $_POST['review']);
$visible = 0;

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
        echo "Sorry, your file is too large.";
        exit;
    }

    $allowed_types = array("jpg", "jpeg", "png", "gif");
    if (!in_array($imageFileType, $allowed_types)) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        exit;
    }

    $unique_name = pathinfo($target_file_name, PATHINFO_FILENAME) . "_" . time() . "." . $imageFileType;
    $target_file = $target_dir . $unique_name;
    $photoPath = $original_path . $unique_name;

    if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        echo "Sorry, there was an error uploading your file.";
        exit;
    }
} else {
    // Use default picture if photo is not selected
    $photoPath = $defaultPicture;
}

$sql = "INSERT INTO reviews (name, designation, photo, review, visible)
VALUES ('$name', '$designation', '$photoPath', '$review', '$visible')";

if ($conn->query($sql) === TRUE) {
    echo "Thanks For Your Valuable Review !";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
