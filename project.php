<?php
include './admin_php/config.php';
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Wright Brick - Our Project</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="icon" href="./img/logo.png" type="image/x-icon" />
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
    <link rel="stylesheet" href="./css/project.css" />

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <?php include 'preloader.html'; ?>

    <?php include 'subheader.php'; ?>

    <div class="container pt-5">
        <div class="entry-screen mt-5">
            <div class="entry-left">
                <div class="entry-heading">
                    <h2>OUR PROJECTS</h2>
                </div>

                <div class="entry-link" data-animation="slideInRight" data-animation-delay="400ms">
                    <h6>Home</h6>
                    <p></p>
                    <h6>Projects</h6>
                </div>
            </div>

            <div class="entry-right" data-animation="slideInLeft" data-animation-delay="700ms">
                <div class="entry-img">
                    <img src="./img/default/28.jpg" alt="" />
                </div>
            </div>
        </div>
    </div>

    <div class="container text-entity mt-5 pt-4">
        <div class="work-entry">
            <div class="para-entry" data-animation="slideInRight">
                <p>Wright Brick</p>
            </div>
            <div class="design-entry" data-animation="slideInUp">
                <h4>
                    We care a lot,<br />
                    about our craft
                </h4>
            </div>

            <div class="main-entry-para" data-animation="slideInLeft">
                <p>
                    Sorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu
                    turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus
                    t
                </p>
            </div>
        </div>
    </div>

    <div class="container-fluid-max mt-5">
        <div class="entry-whole-image" data-animation="slideInDown" data-animation-delay="200ms">
            <img src="./img/default/31.jpg" alt="" />
        </div>
    </div>

    <div class="container-fluid-max project-grid">
        <div class="grid-background py-5">
            <div class="container-fluid">
                <div class="project-heading">
                    <h1>OUR PROJECTS</h1>
                </div>

                <?php
                // Fetch all projects
                $sql = "SELECT * FROM projects LIMIT 5";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $i = 0;
                    while ($project = $result->fetch_assoc()) {
                        // Fetch images for the current project
                        $projectId = $project['project_id'];
                        $imgSql = "SELECT image_url FROM images WHERE project_id = $projectId LIMIT 1";
                        $imgResult = $conn->query($imgSql);
                        // Fetch the first image
                        if ($imgResult && $imgResult->num_rows > 0) {
                            $firstImage = $imgResult->fetch_assoc()['image_url'];
                            $firstImage = strpos($firstImage, '../') === 0 ? substr($firstImage, 3) : $firstImage;
                        } else {
                            $firstImage = 'default-image.jpg'; // Fallback if no image found
                        }
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

                        $order = $i % 2 == 0 ? 'order-md-1' : '';
                        $colSize = $i % 2 == 0 ? 'col-md-5 offset-md-1' : 'col-md-6';
                        $i++;
                        ?>

                        <div class="row">
                            <div class="col-md-6 <?php echo $order ?>">
                                <div class="project-img mt-5">
                                    <img src="<?php echo $firstImage ?>" alt="" />
                                </div>
                            </div>
                            <div class="<?php echo $colSize ?> mt-md-5 pt-md-5 right-whole-project">

                                <div id="project-right" class="project-right mt-md-5 mt-3">
                                    <div class="project-date">
                                        <p><?php echo $formattedDate ?></p>
                                    </div>

                                    <div class="project-right-line mt-4 d-none d-md-block"></div>

                                    <div class="project-right-heading mt-3 mt-md-4">
                                        <h3 class="text-uppercase"><?php echo $project['project_name'] ?></h3>
                                    </div>

                                    <div class="project-right-para mt-3 d-none d-md-block">
                                        <p><?php echo $project['description'] ?></p>
                                    </div>

                                    <a style="text-decoration:none;"
                                        href="best-project.php?project_id=<?php echo $project['project_id'] ?>"
                                        class="view-more-link">
                                        <div class="view-more view-project mt-3 mt-md-4">

                                            <p class="mb-0">View More</p>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                                fill="none">
                                                <path d="M7 17L17 7M17 7H7M17 7V17" stroke="black" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>

                                        </div>
                                    </a>

                                </div>
                            </div>
                        </div>
                    <?php }
                } ?>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-5">
        <div class="project-heading my-5">
            <h1>Gallery</h1>
        </div>

        <section class="main-gallery">
            <div id="gallery" class="container-lg">
                <?php
                // Fetch all image URLs from the database
                $imgSql = "SELECT image_url FROM images";
                $imgResult = $conn->query($imgSql);

                if ($imgResult->num_rows > 0) {
                    // Loop through each image
                    while ($row = $imgResult->fetch_assoc()) {
                        $imageUrl = $row['image_url'];
                        // If the URL starts with '../', remove it
                        $imageUrl = (strpos($imageUrl, '../') === 0) ? substr($imageUrl, 3) : $imageUrl;
                        ?>
                        <!-- Each image will have a click event to show the modal -->
                        <img loading="lazy" src="<?php echo $imageUrl; ?>" class="img-responsive" data-bs-toggle="modal"
                            data-bs-target="#imageModal" onclick="showImage('<?php echo $imageUrl; ?>')" />
                    <?php }
                } else {
                    echo "<p>No images found.</p>";
                }

                $conn->close();
                ?>
            </div>
        </section>


        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body position-relative">

                        <button type="button" class="btn-close position-absolute top-0 end-0 p-3"
                            data-bs-dismiss="modal" aria-label="Close"></button>
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
        <script src="js/textparallax.js"></script>

        <script>
            function toggleMenu() {
                const mobileNav = document.querySelector(".mobile-nav");
                mobileNav.classList.toggle("active");
            }
            function toggleMenu() {
                const mobileNav = document.querySelector(".mobile-nav-wrapper");
                const burgerMenu = document.querySelector(".burger-menu");
                mobileNav.classList.toggle("active");
                burgerMenu.classList.toggle("active");
            }
        </script>
</body>

</html>