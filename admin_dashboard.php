<?php
include './admin_php/config.php';
include './admin_php/functions.php';

session_start();
requireLogin();

// Upload Image
if (isset($_POST['upload'])) {
    $category = 'commercial';

    $project_name = mysqli_real_escape_string($conn, $_POST['project']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    // Define the upload directory
    $uploadDirectory = 'uploads/';

    // Loop through each uploaded image
    foreach ($_FILES['images']['tmp_name'] as $key => $image) {
        // Get details of the image
        $imageName = $_FILES['images']['name'][$key];
        $imageSize = $_FILES['images']['size'][$key];
        $imageType = $_FILES['images']['type'][$key];
        $targetFile = $uploadDirectory . uniqid() . '_' . basename($imageName);

        // Check file size
        if ($imageSize > 500000) { // 500KB in bytes
            $_SESSION['error'] = 'File size should not be greater than 500KB';
            header('Location: admin_dashboard.php');
            exit;
        }

        // Check file type
        $allowedTypes = array('image/jpeg', 'image/jpg', 'image/png');
        if (!in_array($imageType, $allowedTypes)) {
            $_SESSION['error'] = 'Only JPG, JPEG, and PNG files are allowed';
            header('Location: admin_dashboard.php');
            exit;
        }

        // Check if the file is an image
        $imageInfo = getimagesize($image);
        if ($imageInfo === false) {
            $_SESSION['error'] = 'Invalid file type';
            header('Location: admin_dashboard.php');
            exit;
        }

        // Move the uploaded file to the upload directory
        if (!move_uploaded_file($image, $targetFile)) {
            $_SESSION['error'] = 'Failed to upload image';
            header('Location: admin_dashboard.php');
            exit;
        }

        // Insert image details into the database
        $imageUrl = $targetFile;
        $insertQuery = "INSERT INTO images (category, url, project_name, address) VALUES ('$category', '$imageUrl', '$project_name', '$address' )";
        if (!mysqli_query($conn, $insertQuery)) {
            $_SESSION['error'] = 'Failed to save image to database';
            header('Location: admin_dashboard.php');
            exit;
        }
    }

    // Set success message and redirect
    $_SESSION['success'] = 'Images uploaded successfully';
    header('Location: admin_dashboard.php');
    exit;
}

// Delete Image
if (isset($_POST['delete'])) {
    $imageId = mysqli_real_escape_string($conn, $_POST['image_id']);
    $imageUrl = mysqli_real_escape_string($conn, $_POST['image_url']);

    // Attempt to delete the image file
    if (!unlink($imageUrl)) {
        $_SESSION['error'] = 'Failed to delete image file';
        header('Location: admin_dashboard.php');
        exit;
    }

    // Attempt to delete the image record from the database
    if (!mysqli_query($conn, "DELETE FROM images WHERE id = '$imageId'")) {
        $_SESSION['error'] = 'Failed to delete image record from database';
        header('Location: admin_dashboard.php');
        exit;
    }

    // If both deletion attempts were successful, redirect with success message
    $_SESSION['success'] = 'Image deleted successfully';
    header('Location: admin_dashboard.php');
    exit;
}

$projectQuery = mysqli_query($conn, "SELECT DISTINCT project_name FROM images");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Dashboard</title>
    <!-- Include Bootstrap CSS -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Welcome, Admin!</h2>
        <div id="message"></div>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['error'];
                unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['success'];
                unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <!-- Upload Image Form -->
        <form method="post" enctype="multipart/form-data" class="mt-4">

            <div class="form-group">
                <label for="project">Project Name</label>
                <input type="text" name="project" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="project">Address</label>
                <input type="text" name="address" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="images">Select Images:</label>
                <input type="file" name="images[]" multiple class="form-control-file" required>
            </div>

            <div id="preview"></div>

            <button type="submit" name="upload" class="btn btn-primary">Upload Images</button>
        </form>

        <!-- contact info -->

        <hr>

        <h2 class="my-4">Contact Form Submissions</h2>
        <div class="table-responsive" id="contact-table">
        </div>

        <hr>

        <?php
        while ($projectResult = mysqli_fetch_assoc($projectQuery)) {
            $projectName = $projectResult['project_name'];
            // Fetch images for the current project
            $imageQuery = mysqli_query($conn, "SELECT * FROM images WHERE project_name = '$projectName'");
            ?>

            <h4>Project Title: <?php echo $projectName; ?> </h4>
            <br>
            <div class='row'>
                <?php while ($image = mysqli_fetch_assoc($imageQuery)): ?>
                    <div class="col-md-2 col-6 mb-4">
                        <div class="card">
                            <img src="<?php echo $image['url']; ?>" alt="Image" class="card-img-top">
                            <div class="card-body p-2">
                                <form class="m-0" method="post" id="delete-form">
                                    <input type="hidden" name="image_id" value="<?php echo $image['id']; ?>">
                                    <input type="hidden" name="image_url" value="<?php echo $image['url']; ?>">
                                    <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <br>
        <?php } ?>

    </div>

    <!-- Reviews table -->

    <?php

    $result = mysqli_query($conn, "SELECT * FROM reviews");

    if (mysqli_num_rows($result) > 0) {
        // Fetch and display the reviews
    } else {
        echo "No reviews found.";
    }

    ?>

    <div class="container">
        <h2>Reviews</h2>
        <br>
        <div id="ReviewMessage"></div>
        <div id="reviewsTable" class="table-responsive">
            <!-- The reviews will be loaded here -->
        </div>
    </div>


    <!-- Include Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</body>

<script>

    $(document).ready(function () {
        $('#commercialProjectTabs a').on('click', function (e) {
            e.preventDefault()
            $(this).tab('show')
        })
    });

    document.getElementById('delete-form').onsubmit = function (event) {
        var confirmation = confirm("Are you sure you want to delete this image?");
        if (!confirmation) {
            event.preventDefault();
        }
    };

    $(document).ready(function () {
        $('input[type="file"]').on('change', function () {
            $('#preview').empty(); // To remove the previous selected image
            var files = this.files;
            if (files && files[0]) {
                for (var i = 0; i < files.length; i++) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#preview').append('<img src="' + e.target.result + '"class="m-3" height="100">');
                    }
                    reader.readAsDataURL(files[i]);
                }
            }
        });
    });

    function confirmAction(message, action) {
        $('#confirmationText').text(message);
        $('#confirmBtn').off('click').click(function () {
            action();
            $('#confirmationModal').modal('hide');
        });
        $('#confirmationModal').modal('show');
    }

    function deleteReview(id) {
        if (confirm('Are you sure you want to delete this review?')) {
            $.post('./admin_php/delete_review.php', { id: id }, function (data) {
                $("#message").html('<div class="alert alert-success">' + data + '</div>');
                loadReviews();
            }).fail(function () {
                $("#message").html('<div class="alert alert-danger">An error occurred.</div>');
            });
        }
    }

    function deleteContact(id) {
        if (confirm('Are you sure you want to delete this contact?')) {
            $.post('./admin_php/delete_contact.php', { id: id }, function (data) {
                $("#message").html('<div class="alert alert-success">' + data + '</div>');
                loadContact();
            }).fail(function () {
                $("#message").html('<div class="alert alert-danger">An error occurred.</div>');
            });
        }
    }

    function toggleVisibility(id) {
        if (confirm('Are you sure you want to toggle this review?')) {
            $.post('admin_php/toggle_visibility.php', { id: id }, function (data) {
                $("#message").html('<div class="alert alert-success">' + data + '</div>');
                loadReviews();
            }).fail(function () {
                $("#message").html('<div class="alert alert-danger">An error occurred.</div>');
            });
        }
    }

    function loadReviews() {
        $("#reviewsTable").load('./admin_php/fetch_reviews.php');
    }

    function loadContact() {
        $("#contact-table").load('./admin_php/fetch_contact.php');
    }

    // Load the reviews when the page loads
    $(document).ready(function () {
        loadReviews();
        loadContact();
    });

</script>


</html>