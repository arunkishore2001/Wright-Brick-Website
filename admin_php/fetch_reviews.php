<?php
// Include your database configuration file here
include 'config.php';
include 'functions.php';

session_start();
requireLogin();

// Select all reviews from the database
$sql = "SELECT * FROM reviews";
$result = $conn->query($sql);

// Check if there are any reviews
if ($result->num_rows > 0) {
  // Output the table headers
  echo "<table class='table table-hover'><tr class='thead-dark'><th>Name</th><th>Designation</th><th>Profile</th><th>Review</th><th>Actions</th></tr>";

  // Output each review as a table row
  while ($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["name"] . "</td><td>" . $row["designation"] . "</td><td><img src='" . $row["photo"] . "' alt='Profile Photo' width='50' height='50'></td><td>" . $row["review"] . "</td><td><button class='btn btn-danger mr-2' onclick='deleteReview(" . $row["id"] . ")'>Delete</button><button class='btn btn-primary' onclick='toggleVisibility(" . $row["id"] . ")'>" . ($row['visible'] ? 'Hide' : 'Show') . "</button></td></tr>";
  }

  // Close the table
  echo "</table>";
} else {
  echo "No reviews found.";
}

$conn->close();
?>