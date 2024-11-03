<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'config.php';
include 'functions.php';

session_start();

// Check if the form has been submitted from this session
if (isset($_SESSION['form_submitted']) && $_SESSION['form_submitted'] === true) {
    echo "You've already submitted the form.";
    exit();
}

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$country = $_POST['country'];
$phone = $_POST['phone'];
$message = $_POST['message'];
$fullPhone = "{$country} {$phone}";  // Adds a space
$whatsapp = isset($_POST['whatsapp']) ? 1 : 0;

// Prepare an SQL statement for safe insertion
$insertQuery = $conn->prepare("INSERT INTO contact_form (name, email, phone, message, whatsapp) VALUES (?, ?, ?, ?, ?)");
$insertQuery->bind_param("ssssi", $name, $email, $fullPhone, $message, $whatsapp);

// Execute the prepared statement
if ($insertQuery->execute()) {
    $_SESSION['form_submitted'] = true;
    $_SESSION['contact_form_id'] = $conn->insert_id;  // Save the inserted ID in the session
    echo "Form submitted successfully.";
} else {
    echo "Error: " . $insertQuery->error;
}

// Close the statement and connection
$insertQuery->close();
$conn->close();
?>
