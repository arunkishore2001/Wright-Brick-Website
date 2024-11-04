<?php
include 'config.php';
session_start();

// Set response header as JSON
header('Content-Type: application/json');

// Error handling for session variable
if (!isset($_SESSION['contact_form_id'])) {
    echo json_encode(["status" => "error", "message" => "No contact form ID found in session."]);
    exit();
}




// Get form data
$input = json_decode(file_get_contents('php://input'), true);
$property_type = $input['property_type'] ?? null; // Optional field
$property_name = $input['property_name'] ?? null; // Optional field
$floorplan_type = $input['floorplan_type'] ?? null; // Optional field
$contact_form_id = $_SESSION['contact_form_id'];

// Validate input data
if (!$property_type && !$property_name && !$floorplan_type) {
    echo json_encode(["status" => "error", "message" => "Required fields are missing."]);
    exit();
}

// Prepare SQL statement
$updateQuery = $conn->prepare("UPDATE contact_form SET property_type = ?, property_name = ?, floorplan_type = ? WHERE id = ?");
$updateQuery->bind_param("sssi", $property_type, $property_name, $floorplan_type, $contact_form_id);

// Execute the statement
if ($updateQuery->execute()) {
    echo json_encode(["status" => "success", "message" => "Property details updated successfully."]);
} else {
    echo json_encode(["status" => "error", "message" => "Database error: " . $updateQuery->error]);
}

// Close the statement and connection
$updateQuery->close();
$conn->close();
?>
