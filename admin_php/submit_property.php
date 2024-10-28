<?php
// Include your database configuration file here
include 'config.php';
include 'functions.php';

session_start();
requireLogin();

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $propertyType = $_POST['property_type'];
    $propertyName = $_POST['property_name'];
    $floorplanType = $_POST['floorplan_type'];

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO properties (property_type, property_name, floorplan_type) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $propertyType, $propertyName, $floorplanType);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        // If successful, redirect to a thank you page or return a success response
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => $stmt->error]);
    }

    // Close the statement and connection
    $stmt->close();
}

$conn->close();
?>