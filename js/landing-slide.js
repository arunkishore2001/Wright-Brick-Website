const slider = document.querySelector('.slider');
const slides = document.querySelectorAll('.slide');
const totalSlides = slides.length;

// Clone the first and last slide
const firstSlideClone = slides[0].cloneNode(true);
const lastSlideClone = slides[totalSlides - 1].cloneNode(true);

// Add clones to the slider
slider.appendChild(firstSlideClone);
slider.insertBefore(lastSlideClone, slides[0]);

// Update the slides array and totalSlides
const newSlides = document.querySelectorAll('.slide');
const newTotalSlides = newSlides.length;

let currentSlide = 1; // Start from the actual first slide (index 1)
const slideInterval = 5000; // Time between slides in milliseconds

// Initialize the slider position
slider.style.transition = 'none'; // Disable transition for initial setup
slider.style.transform = `translateX(-${currentSlide * 100}%)`;
slider.offsetHeight; // Force reflow to apply initial positioning
slider.style.transition = 'transform 0.5s ease-in-out'; // Re-enable transition

// Dots setup
const dotsContainer = document.querySelector('.dots-container');
const actualSlides = totalSlides; // Only actual slides, not the clones

function createDots() {
  for (let i = 0; i < actualSlides; i++) {
    const dot = document.createElement('span');
    dot.classList.add('dot');
    dot.setAttribute('onclick', `goToSlide(${i + 1})`);
    dotsContainer.appendChild(dot);
  }
}

function updateDots() {
  const dots = document.querySelectorAll('.dot');
  dots.forEach((dot, index) => {
    dot.classList.toggle('active', currentSlide === index + 1);
  });
}

function showSlide(index) {
  slider.style.transform = `translateX(-${index * 100}%)`;

  if (index === newTotalSlides - 1) {
    setTimeout(() => {
      slider.style.transition = 'none';
      slider.style.transform = `translateX(-${100}%)`;
      slider.offsetHeight;
      slider.style.transition = 'transform 0.5s ease-in-out';
    }, 500);
    currentSlide = 1;
  } else if (index === 0) {
    setTimeout(() => {
      slider.style.transition = 'none';
      slider.style.transform = `translateX(-${(newTotalSlides - 2) * 100}%)`;
      slider.offsetHeight;
      slider.style.transition = 'transform 0.5s ease-in-out';
    }, 500);
    currentSlide = newTotalSlides - 2;
  } else {
    currentSlide = index;
  }

  updateDots(); // Update dot active state
}

function goToSlide(index) {
  showSlide(index);
}

function nextSlide() {
  showSlide(currentSlide + 1);
}

// Automatically move to the next slide every few seconds
setInterval(nextSlide, slideInterval);

// Initialize dots on page load
createDots();
updateDots();
