$("#reviewForm").on("submit", function (e) {
  e.preventDefault();
  if ($("#reviewForm").valid()) {
    // Check if the form is valid
    $.ajax({
      url: $(this).attr("action"),
      type: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
        $("#ReviewSubmitMessage").html(
          '<div class="alert alert-success my-4">' + data + "</div>"
        ); // Display success message
        $("#reviewForm")[0].reset(); // Clear the form fields
        $(".modal-footer button").click();
        $("#myModal").modal("hide"); // Close the modal
      },
      error: function () {
        $("#ReviewSubmitMessage").html(
          '<div class="alert alert-danger">An error occurred.</div>'
        ); // Display error message
      },
    });
  }
});

$.validator.addMethod(
  "filesize",
  function (value, element, param) {
    return this.optional(element) || element.files[0].size <= param * 1024;
  },
  "File size must be less than {0}KB"
);

$("#reviewForm").validate({
  rules: {
    name: {
      required: true,
      minlength: 4,
    },
    designation: {
      required: true,
      minlength: 3,
    },
    photo: {
      extension: "jpg|jpeg|png|gif",
      filesize: 200,
    },
    title: {
      required: true,
      minlength: 5,
    },
    review: {
      required: true,
      minlength: 10,
    },
  },
  messages: {
    name: {
      required: "Please enter your name",
      minlength: "Your name must consist of at least 4 characters",
    },
    designation: {
      required: "Please enter your designation",
      minlength: "Your designation must consist of at least 3 characters",
    },
    photo: {
      extension:
        "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed",
      filesize: "File size must be less than 200KB",
    },
    title: {
      required: "Please enter your review title",
      minlength: "Review title must consist of at least 5 characters",
    },
    review: {
      required: "Please write a review",
      minlength: "Your review must consist of at least 10 characters",
    },
  },
});

// code for testimonial sliders

const swiper = new Swiper('.testimonials-container .swiper', {
    slidesPerView: 1,
    spaceBetween: 24,
    loop: true,
    autoplay: {
        delay: 3000,
        disableOnInteraction: true,
    },
    pagination: {
        el: '.testimonials-container .swiper-pagination',
        clickable: true,
    },
    breakpoints: {
        640: {
            slidesPerView: 2,
        },
        1024: {
            slidesPerView: 3,
        },
    },
});

// Fetch testimonials from PHP file
async function fetchTestimonials() {
    try {
        const response = await fetch('./admin_php/fetch_userReview.php');
        const testimonials = await response.json();

        const swiperWrapper = document.querySelector('.testimonials-container .swiper-wrapper');

        testimonials.forEach(testimonial => {
            const slide = document.createElement('div');
            slide.className = 'swiper-slide';

            // Create a handle from the name (for demonstration)
            const handle = testimonial.name.toLowerCase().replace(/\s+/g, '');

            slide.innerHTML = `
            <div class="testimonial-card">
                <div class="quote-mark"> <svg fill="#929696" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 349.078 349.078" xml:space="preserve" stroke="#929696"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M150.299,26.634v58.25c0,7.9-6.404,14.301-14.304,14.301c-28.186,0-43.518,28.909-45.643,85.966h45.643 c7.9,0,14.304,6.407,14.304,14.304v122.992c0,7.896-6.404,14.298-14.304,14.298H14.301C6.398,336.745,0,330.338,0,322.447V199.455 c0-27.352,2.754-52.452,8.183-74.611c5.568-22.721,14.115-42.587,25.396-59.048c11.608-16.917,26.128-30.192,43.16-39.44 C93.886,17.052,113.826,12.333,136,12.333C143.895,12.333,150.299,18.734,150.299,26.634z M334.773,99.186 c7.896,0,14.305-6.407,14.305-14.301v-58.25c0-7.9-6.408-14.301-14.305-14.301c-22.165,0-42.108,4.72-59.249,14.023 c-17.035,9.248-31.563,22.523-43.173,39.44c-11.277,16.461-19.824,36.328-25.393,59.054c-5.426,22.166-8.18,47.266-8.18,74.605 v122.992c0,7.896,6.406,14.298,14.304,14.298h121.69c7.896,0,14.299-6.407,14.299-14.298V199.455 c0-7.896-6.402-14.304-14.299-14.304h-44.992C291.873,128.095,306.981,99.186,334.773,99.186z"></path> </g> </g></svg> </div>
                <div class="testimonial-text">${testimonial.review}</div>
                <div class="user-info">
                    <img src="${testimonial.photo}" alt="${testimonial.name}" class="user-avatar">
                    <div class="user-details">
                        <span class="user-name">${testimonial.name}</span>
                        <span class="user-handle">@${handle}</span>
                    </div>
                </div>
            </div>
        `;

            swiperWrapper.appendChild(slide);
        });

        // Update Swiper after adding slides
        swiper.update();
    } catch (error) {
        console.error('Error fetching testimonials:', error);
    }
}

// Load testimonials when page loads
document.addEventListener('DOMContentLoaded', fetchTestimonials);