const slider = document.querySelector('.slider');
const slides = document.querySelectorAll('.slide');
const totalSlides = slides.length;
let currentSlide = 0;
const slideInterval = 3000; // Time between slides in milliseconds

function showSlide(index) {
  if (index >= totalSlides-1) {
    slider.style.transition = 'none'; // Disable transition for instant jump
    slider.style.transform = 'translateX(0)'; // Jump to start
    currentSlide = 0;
    // Force reflow to enable transition again
    slider.offsetHeight;
    slider.style.transition = 'transform 0.5s ease-in-out'; 
  } else if (index < 0) {
    slider.style.transition = 'none'; // Disable transition for instant jump
    slider.style.transform = `translateX(-${(totalSlides - 1) * 100}%)`; // Jump to end
    currentSlide = totalSlides - 1;
    // Force reflow to enable transition again
    slider.offsetHeight;
    slider.style.transition = 'transform 0.5s ease-in-out'; 
  } else {
    currentSlide = index;
  }
  const offset = -currentSlide * 100; // Adjust offset calculation for full-width slides
  slider.style.transform = `translateX(${offset}%)`;
}

function nextSlide() {
  showSlide(currentSlide + 1);
}

// Initialize the first slide
showSlide(currentSlide);

// Automatically move to the next slide every few seconds
setInterval(nextSlide, slideInterval);
