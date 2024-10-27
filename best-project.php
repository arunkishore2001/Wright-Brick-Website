<?php
include 'subheader.php';
include './admin_php/config.php';
session_start();

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
    <link rel="stylesheet" href="./css/aos.css" />
    <link rel="stylesheet" href="./css/preloader.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <?php
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

<div class="float">
    <a href="./contact.php">
        <div class="trigger">
<svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" width="96px" height="96px" fill-rule="evenodd" clip-rule="evenodd"><path fill="#fff" d="M4.868,43.303l2.694-9.835C5.9,30.59,5.026,27.324,5.027,23.979C5.032,13.514,13.548,5,24.014,5c5.079,0.002,9.845,1.979,13.43,5.566c3.584,3.588,5.558,8.356,5.556,13.428c-0.004,10.465-8.522,18.98-18.986,18.98c-0.001,0,0,0,0,0h-0.008c-3.177-0.001-6.3-0.798-9.073-2.311L4.868,43.303z"/><path fill="#fff" d="M4.868,43.803c-0.132,0-0.26-0.052-0.355-0.148c-0.125-0.127-0.174-0.312-0.127-0.483l2.639-9.636c-1.636-2.906-2.499-6.206-2.497-9.556C4.532,13.238,13.273,4.5,24.014,4.5c5.21,0.002,10.105,2.031,13.784,5.713c3.679,3.683,5.704,8.577,5.702,13.781c-0.004,10.741-8.746,19.48-19.486,19.48c-3.189-0.001-6.344-0.788-9.144-2.277l-9.875,2.589C4.953,43.798,4.911,43.803,4.868,43.803z"/><path fill="#cfd8dc" d="M24.014,5c5.079,0.002,9.845,1.979,13.43,5.566c3.584,3.588,5.558,8.356,5.556,13.428c-0.004,10.465-8.522,18.98-18.986,18.98h-0.008c-3.177-0.001-6.3-0.798-9.073-2.311L4.868,43.303l2.694-9.835C5.9,30.59,5.026,27.324,5.027,23.979C5.032,13.514,13.548,5,24.014,5 M24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974 M24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974C24.014,42.974,24.014,42.974,24.014,42.974 M24.014,4C24.014,4,24.014,4,24.014,4C12.998,4,4.032,12.962,4.027,23.979c-0.001,3.367,0.849,6.685,2.461,9.622l-2.585,9.439c-0.094,0.345,0.002,0.713,0.254,0.967c0.19,0.192,0.447,0.297,0.711,0.297c0.085,0,0.17-0.011,0.254-0.033l9.687-2.54c2.828,1.468,5.998,2.243,9.197,2.244c11.024,0,19.99-8.963,19.995-19.98c0.002-5.339-2.075-10.359-5.848-14.135C34.378,6.083,29.357,4.002,24.014,4L24.014,4z"/><path fill="#40c351" d="M35.176,12.832c-2.98-2.982-6.941-4.625-11.157-4.626c-8.704,0-15.783,7.076-15.787,15.774c-0.001,2.981,0.833,5.883,2.413,8.396l0.376,0.597l-1.595,5.821l5.973-1.566l0.577,0.342c2.422,1.438,5.2,2.198,8.032,2.199h0.006c8.698,0,15.777-7.077,15.78-15.776C39.795,19.778,38.156,15.814,35.176,12.832z"/><path fill="#fff" fill-rule="evenodd" d="M19.268,16.045c-0.355-0.79-0.729-0.806-1.068-0.82c-0.277-0.012-0.593-0.011-0.909-0.011c-0.316,0-0.83,0.119-1.265,0.594c-0.435,0.475-1.661,1.622-1.661,3.956c0,2.334,1.7,4.59,1.937,4.906c0.237,0.316,3.282,5.259,8.104,7.161c4.007,1.58,4.823,1.266,5.693,1.187c0.87-0.079,2.807-1.147,3.202-2.255c0.395-1.108,0.395-2.057,0.277-2.255c-0.119-0.198-0.435-0.316-0.909-0.554s-2.807-1.385-3.242-1.543c-0.435-0.158-0.751-0.237-1.068,0.238c-0.316,0.474-1.225,1.543-1.502,1.859c-0.277,0.317-0.554,0.357-1.028,0.119c-0.474-0.238-2.002-0.738-3.815-2.354c-1.41-1.257-2.362-2.81-2.639-3.285c-0.277-0.474-0.03-0.731,0.208-0.968c0.213-0.213,0.474-0.554,0.712-0.831c0.237-0.277,0.316-0.475,0.474-0.791c0.158-0.317,0.079-0.594-0.04-0.831C20.612,19.329,19.69,16.983,19.268,16.045z" clip-rule="evenodd"/></svg>        </div>
    </a>
</div>

    <div class="container pt-5">
        <div class="entry-screen mt-5">
            <div class="entry-left">
                <div class="entry-heading">
                    <h2><?php echo htmlspecialchars($project['project_name']); ?></h2>
                </div>

                <div class="entry-link" data-animation="slideInRight" data-animation-delay="100ms">
                    <h6>Home</h6>
                    <p></p>
                    <h6>Project</h6>
                </div>
            </div>

            <div class="entry-right" data-animation="slideInLeft" data-animation-delay="200ms">
                <div class="entry-img">
                    <img src="<?php echo htmlspecialchars($firstImage); ?>" alt="Project Image" class="img-fluid" />
                </div>
            </div>
        </div>
    </div>

    <div class="container text-entity mt-5 pt-4">
        <div class="work-entry">
            <div class="para-entry" data-animation="slideInRight">
                <p><?php echo htmlspecialchars($formattedDate); ?></p>
            </div>
            <div class="design-entry" data-animation="slideInUp">
                <h4>
                    <?php echo htmlspecialchars($project['project_name']); ?>
                </h4>
            </div>

            <div class="main-entry-para" data-animation="slideInLeft">
                <p><?php echo htmlspecialchars($project['description']); ?></p>
            </div>
        </div>
    </div>


    <div class="container-fluid mt-5">
        <section class="main-gallery">
            <div id="gallery" class="container-lg">
                <?php foreach ($images as $image): ?>
                    <img loading="lazy" src="<?php echo htmlspecialchars($image); ?>" data-bs-toggle="modal"
                        data-bs-target="#imageModal" onclick="showImage('<?php echo htmlspecialchars($image); ?>')" alt="Wright Brick"
                        class="img-fluid" />
                <?php endforeach; ?>
            </div>
        </section>
    </div>

    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body position-relative">

                    <button type="button" class="btn-close position-absolute top-0 end-0 p-3" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                    <img id="modalImage" class="img-fluid" />
                </div>
            </div>
        </div>
    </div>

    

    <?php include 'footer.php'; ?>
    <!-- Bootstrap JavaScript Libraries -->

    <script src="js/footerImg.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/preloader.js"></script>

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