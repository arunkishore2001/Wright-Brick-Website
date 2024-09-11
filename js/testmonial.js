const img = document.querySelector("#pic");
const btnNext = document.querySelector(".btn-right");
const btnPrevious = document.querySelector(".btn-left");
const name = document.querySelector("#name");
const role = document.querySelector("#role");
const text = document.querySelector("#text");
let currentIndex = 0;
let data = [];

// Fetch testimonials from the server
fetch('get_testimonials.php')
    .then(response => response.json())
    .then(testimonials => {
        data = testimonials;
        loadTestimonial(data[currentIndex]);
    })
    .catch(error => console.log('Error fetching testimonials:', error));

function loadTestimonial(testimonial) {
    img.src = testimonial.img;
    name.textContent = testimonial.name;
    role.textContent = testimonial.role;
    text.textContent = testimonial.text;
}

btnNext.addEventListener("click", function () {
    currentIndex++;
    if (currentIndex > data.length - 1) {
        currentIndex = 0;
    }
    loadTestimonial(data[currentIndex]);
});

btnPrevious.addEventListener("click", function () {
    currentIndex--;
    if (currentIndex < 0) {
        currentIndex = data.length - 1;
    }
    loadTestimonial(data[currentIndex]);
});

setInterval(function () {
    currentIndex++;
    if (currentIndex > data.length - 1) {
        currentIndex = 0;
    }
    loadTestimonial(data[currentIndex]);
}, 3000);
