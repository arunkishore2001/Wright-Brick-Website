<?php
include 'config.php';
include 'functions.php';

session_start();

// Fetch reviews from the database
$result = mysqli_query($conn, "SELECT * FROM reviews WHERE visible = 1 ORDER BY id DESC LIMIT 5;"); // Adjust the query as needed

$reviews = array();

while ($row = mysqli_fetch_assoc($result)) {
    $reviews[] = array(
        'name' => $row['name'],
        'photo' => $row['photo'],
        'review' => $row['review'],
        'title' => $row['title'],
        'designation' => $row['designation']
        // Add more fields if needed
    );
}

// Convert the reviews array to JSON format
echo json_encode($reviews);

mysqli_close($conn);
?>