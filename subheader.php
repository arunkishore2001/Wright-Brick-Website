<header class="nav-bar-container">
  <div class="container-fluid-max">
    <div class="navigation  d-flex justify-content-between align-items-center">
      <div class="nav-main-wrapper">
        <div class="nav-image d-md-block">
          <img src="./img/logo.png" alt="Logo" />
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
            <a class="nav-item <?php echo basename($_SERVER['REQUEST_URI'], '.php') == 'contact' ? 'active-nav' : ''; ?>"
              href="contact">Contact Us</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>