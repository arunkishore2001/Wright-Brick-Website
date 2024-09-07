<?php

include 'config.php';
include 'functions.php';

session_start();
requireLogin();

$id = $_POST['id'];

$sql = "UPDATE reviews SET visible = NOT visible WHERE id = $id";

if ($conn->query($sql) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
