<?php
$targetDir = "img/"; // Directory where images will be stored
$targetFile = $targetDir . basename($_FILES["image"]["name"]);
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        exit;
    }
}

// Check if file already exists
if (file_exists($targetFile)) {
    echo "Sorry, file already exists.";
    exit;
}

// Check file size (limit to 5MB)
if ($_FILES["image"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    exit;
}

// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    exit;
}

// Try to upload file
if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
    echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
    // Here you can also save the file information to your MySQL database if needed
} else {
    echo "Sorry, there was an error uploading your file.";
}
?>
