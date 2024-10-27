let testimonials = [
    {
        name: "Guy Hawkins",
        handle: "@guyhawkins",
        photo: "https://via.placeholder.com/40",
        text: "Impressed by the professionalism and attention to detail."
    },
    {
        name: "Karla Lynn",
        handle: "@karlalynn28",
        photo: "https://via.placeholder.com/40",
        text: "A seamless experience from start to finish. Highly recommend!"
    },
    {
        name: "Jane Cooper",
        handle: "@janecooper",
        photo: "https://via.placeholder.com/40",
        text: "Reliable and trustworthy. Made my life so much easier!"
    }
];

// Slider functionality
const track = document.getElementById('track');
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');
const dotsContainer = document.getElementById('dots');
let currentIndex = 0;

// Create dots
testimonials.forEach((_, index) => {
    const dot = document.createElement('div');
    dot.className = `dot ${index === 0 ? 'active' : ''}`;
    dot.addEventListener('click', () => goToSlide(index));
    dotsContainer.appendChild(dot);
});

function updateSlider() {
    const offset = -currentIndex * 100;
    track.style.transform = `translateX(${offset}%)`;
    
    // Update dots
    document.querySelectorAll('.dot').forEach((dot, index) => {
        dot.classList.toggle('active', index === currentIndex);
    });
}

function goToSlide(index) {
    currentIndex = index;
    updateSlider();
}

function nextSlide() {
    currentIndex = (currentIndex + 1) % testimonials.length;
    updateSlider();
}

function prevSlide() {
    currentIndex = (currentIndex - 1 + testimonials.length) % testimonials.length;
    updateSlider();
}

// Event listeners
prevBtn.addEventListener('click', prevSlide);
nextBtn.addEventListener('click', nextSlide);

// Auto-slide
let autoSlideInterval = setInterval(nextSlide, 5000);

// Pause auto-slide on hover
track.addEventListener('mouseenter', () => clearInterval(autoSlideInterval));
track.addEventListener('mouseleave', () => {
    autoSlideInterval = setInterval(nextSlide, 5000);
});

// Form functionality
const reviewBtn = document.getElementById("reviewBtn");
const testimonialForm = document.getElementById("testimonialForm");
const cancelBtn = document.getElementById("cancelBtn");

reviewBtn.addEventListener("click", () => {
    testimonialForm.style.display = "block";
});

cancelBtn.addEventListener("click", () => {
    testimonialForm.style.display = "none";
    testimonialForm.reset();
    clearErrors();
});

function addTestimonialToSlider(testimonial) {
    testimonials.push(testimonial);
    
    const newCard = document.createElement('div');
    newCard.className = 'testimonial-card';
    newCard.innerHTML = `
        <div class="quote-icon">"</div>
        <p class="testimonial-text">${testimonial.text}</p>
        <div class="testimonial-author">
            <img src="${testimonial.photo}" alt="${testimonial.name}" class="author-avatar">
            <div class="author-info">
                <span class="author-name">${testimonial.name}</span>
                <span class="author-handle">${testimonial.handle}</span>
            </div>
        </div>
    `;
    
    track.appendChild(newCard);

    // Add new dot
    const dot = document.createElement('div');
    dot.className = 'dot';
    dot.addEventListener('click', () => goToSlide(testimonials.length - 1));
    dotsContainer.appendChild(dot);
}

// Form validation and submission
testimonialForm.addEventListener("submit", (e) => {
    e.preventDefault();
    if (validateForm()) {
        const newTestimonial = {
            name: document.getElementById("name").value,
            handle: document.getElementById("handle").value,
            photo: URL.createObjectURL(document.getElementById("photo").files[0]),
            text: document.getElementById("review").value
        };
        
        addTestimonialToSlider(newTestimonial);
        
        testimonialForm.reset();
        testimonialForm.style.display = "none";
        clearErrors();

        // Go to the new testimonial
        goToSlide(testimonials.length - 1);
    }
});

function validateForm() {
    let isValid = true;
    clearErrors();

    const name = document.getElementById("name");
    const handle = document.getElementById("handle");
    const photo = document.getElementById("photo");
    const review = document.getElementById("review");

    if (name.value.length < 4) {
        showError("nameError", "Name must be at least 4 characters long");
        isValid = false;
    }

    if (!handle.value) {
        showError("handleError", "Handle is required");
        isValid = false;
    }

    if (!photo.files.length) {
        showError("photoError", "Photo is required");
        isValid = false;
    }

    if (review.value.length < 10) {
        showError("reviewError", "Review must be at least 10 characters long");
        isValid = false;
    }

    return isValid;
}

function showError(elementId, message) {
    const errorElement = document.getElementById(elementId);
    errorElement.textContent = message;
    errorElement.style.display = "block";
}

function clearErrors() {
    const errorElements = document.getElementsByClassName("error-message");
    Array.from(errorElements).forEach(element => {
        element.style.display = "none";
        element.textContent = "";
    });
}