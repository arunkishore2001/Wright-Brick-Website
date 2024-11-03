<?php
// Include your database connection settings
include 'config.php'; // This should have your connection details

// Capture form data and handle potential undefined keys
$name = $_POST['name'] ?? null;
$email = $_POST['email'] ?? null;
$country = $_POST['country'] ?? null;
$phone = $_POST['phone'] ?? null;
$message = $_POST['message'] ?? null;
$whatsapp = $_POST['whatsapp'] ?? null;
$property_type = $_POST['property_type'] ?? null;
$property_name = $_POST['property_name'] ?? null;
$floorplan_type = $_POST['floorplan_type'] ?? null;

// Check for required fields before inserting into the database
if ($name && $email && $country && $phone && $message && $whatsapp !== null && $property_type && $property_name && $floorplan_type) {
    // Prepare and execute your SQL INSERT statement
    $stmt = $conn->prepare("INSERT INTO user_data (name, email, country, phone, message, whatsapp, property_type, property_name, floorplan_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisssssss", $name, $email, $country, $phone, $message, $whatsapp, $property_type, $property_name, $floorplan_type);

    if ($stmt->execute()) {
        echo "Data submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close(); // Close the database connection
} else {
    echo "Required fields are missing.";
}
?>
