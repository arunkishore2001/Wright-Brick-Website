<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    // Prepare delete statement
    $deleteQuery = $conn->prepare("DELETE FROM contact_form WHERE id = ?");
    $deleteQuery->bind_param("i", $id);

    if ($deleteQuery->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $deleteQuery->close();
} else {
    echo "error";
}

$conn->close();
?>
