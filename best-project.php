<?php
include './admin_php/config.php';
session_start();

// Assuming you pass the project_id via GET request
$projectId = isset($_GET['project_id']) ? intval($_GET['project_id']) : 0;

// Fetch project details
$sql = "SELECT * FROM projects WHERE project_id = $projectId";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $project = $result->fetch_assoc();

    // Fetch the first image
    $imgSql = "SELECT image_url FROM images WHERE project_id = $projectId LIMIT 1";
    $imgResult = $conn->query($imgSql);
    if ($imgResult && $imgResult->num_rows > 0) {
        $firstImage = $imgResult->fetch_assoc()['image_url'];
        $firstImage = strpos($firstImage, '../') === 0 ? substr($firstImage, 3) : $firstImage;
    } else {
        $firstImage = 'default-image.jpg'; // Fallback image
    }

    // Fetch additional images
    $imagesSql = "SELECT image_url FROM images WHERE project_id = $projectId";
    $imagesResult = $conn->query($imagesSql);
    $images = [];
    while ($row = $imagesResult->fetch_assoc()) {
        $imageUrl = $row['image_url'];
        $images[] = strpos($imageUrl, '../') === 0 ? substr($imageUrl, 3) : $imageUrl;
    }

    // Format the date
    $timestamp = strtotime($project['date']);
    $day = date('j', $timestamp);
    $suffix = 'th';
    if ($day == 1 || $day == 21 || $day == 31)
        $suffix = 'st';
    elseif ($day == 2 || $day == 22)
        $suffix = 'nd';
    elseif ($day == 3 || $day == 23)
        $suffix = 'rd';

    $formattedDate = date('j', $timestamp) . $suffix . ' ' . date('F Y', $timestamp);
} else {
    // Handle case where project ID is invalid or not found
    $project = ['project_name' => 'Not Found', 'description' => 'No description available.', 'date' => ''];
    $firstImage = 'default-image.jpg';
    $images = [];
    $formattedDate = '';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Project</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
        </script>


    <link rel="stylesheet" href="./css/styles.css" />
    <link rel="stylesheet" href="./css/index.css" />
    <link rel="stylesheet" href="./css/about.css" />
    <link rel="stylesheet" href="./css/gallery.css" />
    <link rel="stylesheet" href="./css/contact.css" />
    <link rel="stylesheet" href="./css/preloader.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./css/aos.css" />
</head>

<body>

    <?php include 'subheader.php'; ?>
    <div class="container-fluid-max">
        <div class="landing-image-container">
            <div style="background-image: url('<?php echo htmlspecialchars($firstImage); ?>');" alt="Wright Brick"
                class="landing-image-container-img">
                <div class="landing-text-wrapper">
                    <h1><?php echo htmlspecialchars($project['project_name']); ?></h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container text-entity pt-5">
        <h5 class="text-center"><?php echo htmlspecialchars($project['description']); ?></h5>
    </div>


    <div class="container-fluid mt-5">
        <section class="main-gallery">
            <div id="gallery" class="container-lg">
                <?php foreach ($images as $image): ?>
                    <img loading="lazy" class="rounded" src="<?php echo htmlspecialchars($image); ?>" data-bs-toggle="modal"
                        data-bs-target="#myModal" onclick="showImage('<?php echo htmlspecialchars($image); ?>')"
                        alt="Wright Brick" class="img-fluid" />
                <?php endforeach; ?>
            </div>
        </section>
    </div>

    <div class="modal p-3" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div type="button" class="close" data-bs-dismiss="modal">X</div>
                </div>

                <div class="modal-body position-relative">
                    <img id="modalImage" class="img-fluid image-project" />
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script src="js/aos.js"></script>

    <script>
        function showImage(imageUrl) {
            document.getElementById('modalImage').src = imageUrl;
        }
    </script>

    <script>
        function toggleMenu() {
            const mobileNav = document.querySelector(".mobile-nav-wrapper");
            const burgerMenu = document.querySelector(".burger-menu");
            mobileNav.classList.toggle("active");
            burgerMenu.classList.toggle("active");
        }
    </script>
</body>

</html>