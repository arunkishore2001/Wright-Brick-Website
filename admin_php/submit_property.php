<?php
include 'config.php';
session_start();

// Set response header as JSON
header('Content-Type: application/json');

// Check if the form has been submitted from this session
if (isset($_SESSION['form_submitted']) && $_SESSION['form_submitted'] === true) {
    echo json_encode(["status" => "error", "message" => "You've already submitted the form."]);
    exit();
}

// Check if the session variable for contact form ID exists
if (!isset($_SESSION['contact_form_id'])) {
    echo json_encode(["status" => "error", "message" => "No contact form ID found in session."]);
    exit();
}

// Get form data
$property_type = $_POST['property_type'];
$property_name = $_POST['property_name'];
$floorplan_type = $_POST['floorplan_type'];
$contact_form_id = $_SESSION['contact_form_id']; // Get the contact form ID from session

// Prepare an SQL statement for updating the existing entry
$updateQuery = $conn->prepare("UPDATE contact_form SET property_type = ?, property_name = ?, floorplan_type = ? WHERE id = ?");
$updateQuery->bind_param("sssi", $property_type, $property_name, $floorplan_type, $contact_form_id);

// Execute the prepared statement and return JSON response
if ($updateQuery->execute()) {
    echo json_encode(["status" => "success", "message" => "Property details updated successfully."]);
} else {
    echo json_encode(["status" => "error", "message" => "Error: " . $updateQuery->error]);
}

// Close the statement and connection
$updateQuery->close();
$conn->close();
?>
