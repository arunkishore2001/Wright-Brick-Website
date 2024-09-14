<div class="right-header">
  <div class="right-inside-header text-center">
    <h4>Specialized Design For You</h4>
    <p class="mt-2 mb-0">Fill the details we’ll call you back</p>
  </div>
  <div id="ContactSubmitMessage"></div>
  <div class="form-filling">
    <form method="post" id="contactForm">
      <input type="text" placeholder="Name" id="name" name='name' />
      <input type="email" placeholder="Email" id="email" name='email' />
      <div class="phone-input">
        <span><input type="text" class="country-code-input" value="+91" maxlength="4" id="country" name='country' /></span>
        <input type="tel" placeholder="Mobile Number" id="phone" name='phone' />
      </div>
      <textarea id="message" placeholder="Message..." name='message'></textarea>
      <div class="checkbox-container">
        <input type="checkbox" id="whatsapp" name="whatsapp" value="1" />
        <label for="whatsapp">You can reach me on WhatsApp</label>
      </div>
      <button type="submit" id="contactLink">
        Get Free Quote
        <span>
          <svg xmlns="http://www.w3.org/2000/svg" width="41" height="19" viewBox="0 0 41 19" fill="none">
            <line y1="9.5" x2="40" y2="9.5" stroke="white" />
            <line x1="30.3345" y1="0.628353" x2="40.3345" y2="9.62835" stroke="white" />
            <line x1="29.672" y1="18.4491" x2="39.8256" y2="9.62269" stroke="white" />
          </svg></span>
      </button>
    </form>
  </div>
</div>

<script>
  $(document).ready(function () {
    // modal
    // var modal = document.getElementById("popupModal"); use later
    // var rightModal = document.querySelector('.right-modal');

    $("#contactForm").on('submit', function (e) {
      e.preventDefault();

      // Prevent double submission by disabling the button
      $("#contactForm button[type=submit]").prop("disabled", true);

      if ($(this).valid()) {
        $.ajax({
          url: './admin_php/process_form.php',
          type: 'POST',
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          success: function (data) {
            $("#ContactSubmitMessage").html(
              '<div class="alert alert-success my-1 p-2 px-3">' + data + '</div>'
            );
            $("#contactForm")[0].reset();
            // Re-enable the button after the form has been successfully submitted
            $("button[type=submit]").prop("disabled", false);
          },
          error: function () {
            $("#ContactSubmitMessage").html(
              '<div class="alert alert-danger">An error occurred.</div>'
            );
            // Re-enable the button in case of error
            $("button[type=submit]").prop("disabled", false);
          }
        });
      } else {
        // Re-enable the button if the validation fails
        $("button[type=submit]").prop("disabled", false);
      }
    });

    $("#contactForm").validate({
      rules: {
        name: {
          required: true,
          minlength: 2
        },
        email: {
          required: true,
          email: true
        },
        phone: {
          required: true,
          digits: true,
          minlength: 10,
          maxlength: 10
        },
        message: {
          required: true,
          minlength: 10
        }
      },
      messages: {
        name: {
          required: "Please enter your name",
          minlength: "Your name must consist of at least 2 characters"
        },
        email: {
          required: "Please enter your email",
          email: "Please enter a valid email address"
        },
        phone: {
          required: "Please enter your phone number",
          digits: "Please enter a valid phone number"
        },
        message: {
          required: "Please write a message",
          minlength: "Your message must consist of at least 10 characters"
        }
      }
    });

    $("#contactForm2").on('submit', function (e) {
      e.preventDefault();

      // Prevent double submission by disabling the button
      $("#contactForm2 button[type=submit]").prop("disabled", true);

      if ($(this).valid()) {
        $.ajax({
          url: './admin_php/process_form.php',
          type: 'POST',
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          success: function (data) {
            $("#ContactSubmitMessage2").html(
              '<div class="alert alert-success my-1 p-2 px-3">' + data + '</div>'
            );
            $("#contactForm2")[0].reset();
            // Re-enable the button after the form has been successfully submitted
            $("button[type=submit]").prop("disabled", false);
          },
          error: function () {
            $("#ContactSubmitMessage2").html(
              '<div class="alert alert-danger">An error occurred.</div>'
            );
            // Re-enable the button in case of error
            $("button[type=submit]").prop("disabled", false);
          }
        });
      } else {
        // Re-enable the button if the validation fails
        $("button[type=submit]").prop("disabled", false);
      }
    });

    $("#contactForm2").validate({
      rules: {
        name: {
          required: true,
          minlength: 2
        },
        email: {
          required: true,
          email: true
        },
        phone: {
          required: true,
          digits: true,
          minlength: 10,
          maxlength: 10
        },
        message: {
          required: true,
          minlength: 10
        }
      },
      messages: {
        name: {
          required: "Please enter your name",
          minlength: "Your name must consist of at least 2 characters"
        },
        email: {
          required: "Please enter your email",
          email: "Please enter a valid email address"
        },
        phone: {
          required: "Please enter your phone number",
          digits: "Please enter a valid phone number"
        },
        message: {
          required: "Please write a message",
          minlength: "Your message must consist of at least 10 characters"
        }
      }
    });
  });

</script>