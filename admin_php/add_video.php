<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $video_link = $_POST['video_link'];
    $video_id = '';

    // Extract video ID from either regular or shortened YouTube URL
    if (strpos($video_link, 'youtu.be') !== false) {
        $video_id = substr(parse_url($video_link, PHP_URL_PATH), 1);
    } else {
        parse_str(parse_url($video_link, PHP_URL_QUERY), $url_params);
        $video_id = isset($url_params['v']) ? $url_params['v'] : '';
    }

    if (!empty($video_id)) {
        // Insert the video ID into the database
        $stmt = $conn->prepare("INSERT INTO videos (video_id) VALUES (?)");
        $stmt->bind_param("s", $video_id);

        // Execute the query and check if it was successful
        if ($stmt->execute()) {
            // Alert for successful video addition
            echo "<script>alert('Video added successfully!'); window.history.back();</script>";
        } else {
            // Alert if there's an error during the insertion
            echo "<script>alert('Error adding video: " . $stmt->error . "'); window.history.back();</script>";
        }

        $stmt->close();
    } else {
        // Alert if the YouTube URL is invalid
        echo "<script>alert('Invalid YouTube URL'); window.history.back();</script>";
    }

    // Close connection
    $conn->close();
}
