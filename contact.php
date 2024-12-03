<!doctype html>
<html lang="en">

<head>
  <title>Wright Brick - Contact Us</title>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="icon" href="./img/logo.png" type="image/x-icon" />
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

  <link rel="stylesheet" href="./css/styles.css" />
  <link rel="stylesheet" href="./css/index.css" />
  <link rel="stylesheet" href="./css/about.css" />
  <link rel="stylesheet" href="./css/gallery.css" />
  <link rel="stylesheet" href="./css/popup.css" />
  <link rel="stylesheet" href="./css/contact.css" />
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="./css/aos.css" />
</head>

<body>
  <?php include 'subheader.php'; ?>
  <main>

    <div class="container-fluid-max">
      <div class="landing-image-container">
        <div style="background-image: url('./img/contact.jpg');" alt="Wright Brick" class="landing-image-container-img">
          <div class="landing-text-wrapper">
            <h1>Contact Us</h1>
            <p class="text-white mt-2 ">Home / Contact</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Popup Modal -->

    <div id="popupModal" class="modal">
      <div class="left-modal">
        <div class="modal-content">
          <span class="close">&times;</span>
          <h2 class="step-header">Basic Information</h2>

          <form id="propertyForm" onsubmit="onProperty(event)">
            <div class="form-content">
              <div class="left-section">
                <p class="section-title">I own a...</p>
                <div class="own-a">
                  <button type="button" class="property-type" id="apartment"
                    onclick="setPropertyType('Apartment')">Apartment</button>
                  <button type="button" class="property-type" id="villa"
                    onclick="setPropertyType('Villa')">Villa</button>
                  <button type="button" class="property-type" id="independent-home"
                    onclick="setPropertyType('Independent Home')">Independent
                    Home</button>
                </div>

                <input type="hidden" name="property_type" id="property_type">

                <p class="section-title">My property name...</p>
                <div class="input-container">
                  <input type="text" name="property_name" id="property-name" placeholder="Property name" required>
                </div>

                <p class="section-title">My floorplan type is...</p>
                <div class="floorplane-whole">
                  <button type="button" class="floorplan-type" onclick="setFloorplanType('1BHK')">1BHK</button>
                  <button type="button" class="floorplan-type" onclick="setFloorplanType('2BHK')">2BHK</button>
                  <button type="button" class="floorplan-type" onclick="setFloorplanType('3BHK')">3BHK</button>
                  <button type="button" class="floorplan-type" onclick="setFloorplanType('3+BHK')">3+BHK</button>
                </div>

                <input type="hidden" name="floorplan_type" id="floorplan_type">
              </div>

              <div class="right-section">
                <img loading="lazy" src="./img/about.png" alt="Apartment Illustration">
                <p class="info-text">About your home</p>
                <p class="info-description">The details that you enter here help us
                  understand more
                  about
                  your property.</p>
              </div>
            </div>

            <div class="buttons-step-2">
              <button type="submit" class="btn-next">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="container-lg mt-5 pt-2">
      <div class="row">
        <div class="col-md-5" data-animation="slideInRight">
          <div class="contact-form-page">
            <?php include 'contact-form.php'; ?>
          </div>
        </div>

        <div class="col-md-7 contact-form-right" data-animation="slideInLeft">
          <iframe class="contact-map"
            src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3625.923266831088!2d77.6440229482005!3d12.909314648114728!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMTLCsDU0JzMzLjQiTiA3N8KwMzgnMzguNCJF!5e0!3m2!1sen!2sin!4v1732983773735!5m2!1sen!2sin"
            width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </div>

    <!-- <div class="container-fluid-max mt-5">
      <div class="entry-whole-image" data-animation="slideInDown" data-animation-delay="200ms">
        <img src="./img//default/32.jpg" alt="" />
      </div>
    </div> -->

    <div class="container-fluid mt-5">
      <div class="contact-page">
        <div class="contact-page-box" data-animation="slideInLeft" data-animation-delay="40ms">
          <div class="contact-page-icon">
            <img src="./img/sale.png" alt="">
          </div>
          <div class="contact-page-details">
            <h6>Project Enquiry</h6>
            <p>Mail us at</p>
            <a href="mailto:sales@wrightbrick.com">sales@wrightbrick.com</a>
          </div>
        </div>
        <div class="contact-page-box" data-animation="slideInLeft" data-animation-delay="40ms">
          <div class="contact-page-icon">
            <i class="fa-regular fa-comments" style="color: #000000;"></i>
          </div>
          <div class="contact-page-details">
            <h6>Jobs</h6>
            <p>Mail us at</p>
            <a href="mailto:careers@wrightbrick.com">careers@wrightbrick.com</a>
          </div>
        </div>
        <div class="contact-page-box" data-animation="slideInLeft" data-animation-delay="30ms">
          <div class="contact-page-icon">
            <img src="./img/location.png" alt="">
          </div>
          <div class="contact-page-details">
            <h6>Location</h6>
            <!-- <p>Speak to our friendly team</p> -->
            <a href="https://maps.app.goo.gl/75Egs71jG5Qv69FE6" style="font-size: 12.5px">60, 18th Main Rd, Sector 3, HSR
              Layout, Bengaluru,
              Karnataka 560102</a>
          </div>
        </div>
        <div class="contact-page-box" data-animation="slideInLeft" data-animation-delay="20ms">
          <div class="contact-page-icon">
            <img src="./img/phone.png" alt="">
          </div>
          <div class="contact-page-details">
            <h6 class="mb-1">Contact No</h6>
            <!-- <p>Speak to our friendly team</p> -->
            <a href="tel:+919742880461" class="font-medium-size">+91 97428 80461</a> <br />
            <a href="https://wa.me/919538230974" class="font-medium-size">+91 95382 30974</a>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid mt-4">
      <div class="row">
        <div class="col">
          <div class="team-pic mb-3">
            <img src="./img/team.png" alt="" srcset="">
          </div>
        </div>
      </div>
      <hr />
      <div class="row">
        <div class="col">
          <h2 class="mt-3">About Wright Brick</h2>
          <p class="my-3">Wright Brick is a premier interior design and Construction company offering comprehensive
            turnkey solutions
            for both residential and commercial spaces. Established with a passion for exceptional craftsmanship and
            innovative design, Wright Brick has successfully delivered numerous projects across a diverse range of
            locations. With expertise in creating functional, yet elegant spaces, Wright Brick’s approach ensures that
            each project, from concept to completion, perfectly reflects the client's vision with unparalleled precision
            and integrity. Whether designing bespoke interiors or managing construction projects, Wright Brick is
            committed to transforming spaces that inspire and endure.</p>
        </div>
      </div>
    </div>

    <div class="container mt-5">
      <div class="row">
        <div class="faq-heading" data-animation="slideInRight" data-animation-delay="200ms">
          <h1>FAQs</h1>
        </div>
        <div class="faq-subheading" data-animation="slideInRight" data-animation-delay="200ms">
          <p>People commonly asks</p>
        </div>
      </div>

      <div class="faq-whole mt-4">
        <section class="faq-section py-3">
          <div class="w-lg-50 mx-auto">
            <div class="accordion accordion-flush" id="accordionExample">
              <!-- 1: coll1 -->
              <div class="accordion-item" data-animation="slideInDown" data-animation-delay="10ms">
                <h2 class="accordion-header">
                  <!--   data-bs-target="#coll1",  controls="coll1", id="coll1", aria-expanded="true"      -->
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#coll1"
                    aria-expanded="true" aria-controls="coll1">
                    <h5>What is Wright Brick?</h5>
                  </button>
                </h2>
                <!-- show : by default Always open -->
                <div id="coll1" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    At Wright Brick, we specialize in creating interiors that are uniquely yours. Each
                    home reflects your distinct style, crafted with exceptional precision and care by
                    our expert team. Our designs are more than spaces—they're a true extension of you
                  </div>
                </div>
              </div>

              <!-- 2: coll2 -->
              <div class="accordion-item" data-animation="slideInDown" data-animation-delay="20ms">
                <h2 class="accordion-header">
                  <!--       collapsed,   aria-expanded="false"   -->
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#coll2" aria-expanded="false" aria-controls="coll2">
                    <h5>Does Wright Brick charge taxes? </h5>
                  </button>
                </h2>
                <div id="coll2" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    Yes, Wright Brick is a reputable organization compliant with all statutory
                    requirements. The quoted cost includes GST, with no additional taxes.
                  </div>
                </div>
              </div>

              <!-- 3: coll3 -->
              <div class="accordion-item" data-animation="slideInDown" data-animation-delay="30ms">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#coll3" aria-expanded="false" aria-controls="coll3">
                    <h5>Does Wright Brick offer any Warranty?
                    </h5>
                  </button>
                </h2>
                <div id="coll3" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                  <div class="accordion-body">Wright Brick guarantees that all products will be free from
                    manufacturing defects and installation issues, with a warranty of up to 10 years,
                    provided they are properly maintained and used for standard domestic purposes
                  </div>
                </div>
              </div>

              <!-- 4: coll4 -->
              <div class="accordion-item" data-animation="slideInDown" data-animation-delay="40ms">
                <h2 class="accordion-header">
                  <!--   target="#coll4",  id="coll4"  -->
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#coll4" aria-expanded="false" aria-controls="coll4">
                    <h5>What is the timeline to complete an interior Project?</h5>
                  </button>
                </h2>
                <div id="coll4" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    Every home is unique with its own needs. At Wright Brick, we aim to finish your
                    project in the shortest time possible. Once the design is finalized, we will provide
                    a clear timeline and ensure timely delivery as promised.
                  </div>
                </div>
              </div>

              <!-- 5: coll5 -->
              <div class="accordion-item" data-animation="slideInDown" data-animation-delay="50ms">
                <h2 class="accordion-header">
                  <!--   target="#coll5",  id="coll5"  -->
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#coll5" aria-expanded="false" aria-controls="coll5">
                    <h5>Does Wright Brick take any hidden charges?
                    </h5>
                  </button>
                </h2>
                <div id="coll5" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                  <div class="accordion-body">Wright Brick has no hidden charges beyond those specified in
                    the quote.
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>

  </main>
  <?php include 'footer.php'; ?>
  <!-- Bootstrap JavaScript Libraries -->

  <script src="js/aos.js"></script>
  <script src="js/contact-submission.js"></script>
  <script src="js/popup.js"></script>

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