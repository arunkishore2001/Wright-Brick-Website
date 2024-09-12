const reviewPic = document.querySelector("#reviewPic");
const btnNext = document.querySelector(".btn-right");
const btnPrevious = document.querySelector(".btn-left");
const reviewName = document.querySelector("#reviewName");
const reviewRole = document.querySelector("#reviewRole");
const reviewContent = document.querySelector("#reviewContent");
let currentIndex = 0;

window.addEventListener("DOMContentLoaded", function () {
  loadTestimonial(reviewData[currentIndex]);
});

function loadTestimonial(testimonial) {
  reviewPic.src = testimonial.photo;
  reviewName.textContent = testimonial.name;
  reviewRole.textContent = testimonial.designation;
  reviewContent.textContent = testimonial.review;
}

btnNext.addEventListener("click", function () {
  currentIndex++;
  if (currentIndex > reviewData.length - 1) {
    currentIndex = 0;
  }
  loadTestimonial(reviewData[currentIndex]);
});

btnPrevious.addEventListener("click", function () {
  currentIndex--;
  if (currentIndex < 0) {
    currentIndex = reviewData.length - 1;
  }
  loadTestimonial(reviewData[currentIndex]);
});

setInterval(function () {
  currentIndex++;
  if (currentIndex > reviewData.length - 1) {
    currentIndex = 0;
  }
  loadTestimonial(reviewData[currentIndex]);
}, 3000);




$("#reviewForm").on('submit', function(e) {
    e.preventDefault();
    if ($("#reviewForm").valid()) { // Check if the form is valid
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $("#ReviewSubmitMessage").html('<div class="alert alert-success my-4">' + data +
                    '</div>'); // Display success message
                $("#reviewForm")[0].reset(); // Clear the form fields
                $('.modal-footer button').click();
                $("#myModal").modal('hide'); // Close the modal
            },
            error: function() {
                $("#ReviewSubmitMessage").html(
                    '<div class="alert alert-danger">An error occurred.</div>'
                ); // Display error message
            }
        });
    }
});

$.validator.addMethod('filesize', function(value, element, param) {
    return this.optional(element) || (element.files[0].size <= param * 1024)
}, 'File size must be less than {0}KB');


$("#reviewForm").validate({
    rules: {
        name: {
            required: true,
            minlength: 4
        },
        designation: {
            required: true,
            minlength: 3,
        },
        photo: {
            extension: "jpg|jpeg|png|gif",
            filesize: 200
        },
        title: {
            required: true,
            minlength: 5
        },
        review: {
            required: true,
            minlength: 10
        }
    },
    messages: {
        name: {
            required: "Please enter your name",
            minlength: "Your name must consist of at least 4 characters"
        },
        designation: {
            required: "Please enter your designation",
            minlength: "Your designation must consist of at least 3 characters"
        },
        photo: {
            extension: "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed",
            filesize: "File size must be less than 200KB"
        },
        title: {
            required: "Please enter your review title",
            minlength: "Review title must consist of at least 5 characters"
        },
        review: {
            required: "Please write a review",
            minlength: "Your review must consist of at least 10 characters"
        }
    },
});