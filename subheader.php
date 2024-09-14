<header class="nav-bar-container" data-animation="slideInDown" data-animation-delay="100ms">
  <div class="container-fluid">
    <div class="navigation mt-3 d-flex justify-content-between align-items-center">
      <div class="nav-main-wrapper">
        <div class="nav-image d-md-block">
          <img src="./img/logo.png" alt="Logo" />
        </div>

        <div class="nav-link navigation-pages-wrapper d-md-flex align-items-center">
          <nav class="d-md-flex">
            <a class="<?php echo ($_SERVER['REQUEST_URI'] == '/' || substr($_SERVER['REQUEST_URI'], -1) == '/' || basename($_SERVER['REQUEST_URI'], '.php') == 'home' || basename($_SERVER['REQUEST_URI'], '.php') == 'index') ? 'active-nav' : ''; ?>"
              href="home">Home</a>
            <a class="<?php echo basename($_SERVER['REQUEST_URI'], '.php') == 'about' ? 'active-nav' : ''; ?>"
              href="about">About Us</a>
            <a class="<?php echo basename($_SERVER['REQUEST_URI'], '.php') == 'service' ? 'active-nav' : ''; ?>"
              href="service">Services</a>
            <a class="<?php echo basename($_SERVER['REQUEST_URI'], '.php') == 'project' ? 'active-nav' : ''; ?>"
              href="project">Projects</a>
            <a class="<?php echo basename($_SERVER['REQUEST_URI'], '.php') == 'contact' ? 'active-nav' : ''; ?>"
              href="contact">Contact</a>
          </nav>

        </div>

        <div class="contact-btn">
          <a href="contact.php">Contact Us</a>
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
            <path d="M7 17.5L17 7.5M17 7.5H7M17 7.5V17.5" stroke="#D50F1C" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round" />
          </svg>
        </div>

        <!-- Burger Menu Button -->
        <div class="burger-menu d-md-none" onclick="toggleMenu()">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>

      <div class="mobile-nav-wrapper d-md-none">
        <div class="nav-menu-wrapper">
          <div class="flex-column d-flex d-md-none align-items-center">
            <a class="<?php echo ($_SERVER['REQUEST_URI'] == '/' || substr($_SERVER['REQUEST_URI'], -1) == '/' || basename($_SERVER['REQUEST_URI'], '.php') == 'home' || basename($_SERVER['REQUEST_URI'], '.php') == 'index') ? 'active-nav' : ''; ?>"
              href="home">Home</a>
            <a class="<?php echo basename($_SERVER['REQUEST_URI'], '.php') == 'about' ? 'active-nav' : ''; ?>"
              href="about">About Us</a>
            <a class="<?php echo basename($_SERVER['REQUEST_URI'], '.php') == 'service' ? 'active-nav' : ''; ?>"
              href="service">Services</a>
            <a class="<?php echo basename($_SERVER['REQUEST_URI'], '.php') == 'project' ? 'active-nav' : ''; ?>"
              href="project">Projects</a>
            <a class="<?php echo basename($_SERVER['REQUEST_URI'], '.php') == 'contact' ? 'active-nav' : ''; ?>"
              href="contact">Contact</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>