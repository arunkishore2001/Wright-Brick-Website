// Get the modal
var modal = document.getElementById("popupModal");

// Get the link that opens the modal
// var link = document.getElementById("contactLink"); need to use

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// Get the property type buttons
var propertyButtons = document.querySelectorAll('.property-type');

// Get the 'Next' button
var nextButton = document.querySelector('.next-button');

// Get the 'Back' button
var backButton = document.querySelector('.btn-back');

// Get the 'left-modal' and 'right-modal' sections
var leftModal = document.querySelector('.left-modal');
var rightModal = document.querySelector('.right-modal');

// When the user clicks the link, open the modal
link.onclick = function(event) {
    event.preventDefault();  // Prevent default link behavior
    modal.style.display = "block";

    // Show the right modal content
    rightModal.style.display = "none";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Function to handle the property selection
propertyButtons.forEach(function(button) {
    button.addEventListener('click', function() {
        // Remove the 'selected' class from all property-type buttons
        propertyButtons.forEach(function(btn) {
            btn.classList.remove('selected');
        });
        
        // Add the 'selected' class to the clicked button
        this.classList.add('selected');
    });
});

// Handle 'Next' button click to show the right-modal
nextButton.addEventListener('click', function() {
    // Hide the left modal content
    leftModal.style.display = "none";
    
    // Show the right modal content
    rightModal.style.display = "block";
});

// Handle 'Back' button click to go back to the left-modal
backButton.addEventListener('click', function() {
    // Hide the right modal content
    rightModal.style.display = "none";
    
    // Show the left modal content
    leftModal.style.display = "block";
});

// Function to handle button selection
function handleButtonSelection(buttons) {
    buttons.forEach(function(button) {
        button.addEventListener('click', function() {
            // Remove the 'selected' class from all buttons
            buttons.forEach(function(btn) {
                btn.classList.remove('selected');
            });

            // Add the 'selected' class to the clicked button
            this.classList.add('selected');
        });
    });
}

// Get all floorplan-type buttons
var floorplanTypeButtons = document.querySelectorAll('.floorplan-type');

// Call the function to handle selection
handleButtonSelection(floorplanTypeButtons);

// Function to handle button selection
function handleButtonSelection(buttons) {
    buttons.forEach(function(button) {
        button.addEventListener('click', function() {
            // Remove the 'selected' class from all buttons
            buttons.forEach(function(btn) {
                btn.classList.remove('selected');
            });

            // Add the 'selected' class to the clicked button
            this.classList.add('selected');
        });
    });
}

// Get all planning-type and looking-type buttons
var planningTypeButtons = document.querySelectorAll('.planning-type');
var lookingTypeButtons = document.querySelectorAll('.looking-type');

// Call the function to handle selection
handleButtonSelection(planningTypeButtons);
handleButtonSelection(lookingTypeButtons);


// Get the modal elements
var leftModal = document.querySelector('.left-modal');
var rightModal = document.querySelector('.right-modal');

// Get the close button in the right modal
var closeButtonRightModal = document.querySelector('.right-modal .close');

// Get the 'Next' and 'Back' buttons
var nextButton = document.querySelector('.next-button');
var backButton = document.querySelector('.btn-back');

// When the user clicks the 'Next' button, show the right modal and hide the left modal
nextButton.addEventListener('click', function() {
    leftModal.style.display = "none";
    rightModal.style.display = "block";
});

// When the user clicks the 'Back' button, show the left modal and hide the right modal
backButton.addEventListener('click', function() {
    rightModal.style.display = "none";
    leftModal.style.display = "block";
});

// When the user clicks the close button in the right modal, hide the right modal
closeButtonRightModal.addEventListener('click', function() {
    rightModal.style.display = "none";
    // Optionally, show the left modal or hide both modals
    leftModal.style.display = "block"; // Show the left modal when closing the right modal
});

// When the user clicks anywhere outside the right modal, close it
window.addEventListener('click', function(event) {
    if (event.target === rightModal) {
        rightModal.style.display = "none";
        leftModal.style.display = "block"; // Optionally show the left modal
    }
});



// Get the thank-you modal
var thankYouModal = document.getElementById("thankYouModal");

// Get the close button in the thank-you modal
var closeThankYouButton = document.querySelector('.close-thank-you');

// Get the 'Submit' button in the right modal
var submitButton = document.querySelector('.btn-next');

// Function to open the thank-you modal
function openThankYouModal() {
    thankYouModal.style.display = "block";
}

// Function to close the thank-you modal
function closeThankYouModal() {
    thankYouModal.style.display = "none";
}

// When the user clicks the close button in the thank-you modal, close it
closeThankYouButton.addEventListener('click', closeThankYouModal);

// When the user clicks anywhere outside the thank-you modal, close it
window.addEventListener('click', function(event) {
    if (event.target === thankYouModal) {
        closeThankYouModal();
    }
});

// Handle 'Submit' button click to show the thank-you modal
submitButton.addEventListener('click', function() {
    // Here you can add your form submission logic
    // For example, making an AJAX request to submit the form data

    // After successful submission, show the thank-you modal
    openThankYouModal();
});


// Get all modals
var modals = {
    main: document.getElementById("popupModal"),
    thankYou: document.getElementById("thankYouModal"),
    left: document.querySelector('.left-modal'),
    right: document.querySelector('.right-modal')
};

// Get close buttons
var closeThankYouButton = document.querySelector('.close-thank-you');
var closeButtons = document.querySelectorAll('.close');

// Function to open the thank-you modal
function openThankYouModal() {
    modals.thankYou.style.display = "block";
    modals.main.style.display = "none";
    modals.left.style.display = "none";
    modals.right.style.display = "none";
}

// Function to close all modals
function closeAllModals() {
    for (var key in modals) {
        if (modals[key]) {
            modals[key].style.display = "none";
        }
    }
}

// Function to reopen the main modal
function reopenMainModal() {
    modals.main.style.display = "block";
}

// When the user clicks the close button in the thank-you modal, close all modals
closeThankYouButton.addEventListener('click', function() {
    closeAllModals();
    // Optionally, you can perform other actions here if needed
});

// When the user clicks any close button (including in other modals), close all modals
closeButtons.forEach(function(button) {
    button.addEventListener('click', closeAllModals);
});

// When the user clicks anywhere outside any modal, close all modals
window.addEventListener('click', function(event) {
    if (event.target === modals.main || event.target === modals.thankYou) {
        closeAllModals();
    }
});

// Handle 'Submit' button click to open the thank-you modal
var submitButton = document.querySelector('.btn-next');
submitButton.addEventListener('click', function() {
    // Simulate form submission logic
    setTimeout(function() {
        openThankYouModal();
    }, 500); // Delay to simulate form submission
});

// Handle reopening of the main modal
var reopenButton = document.getElementById("reopenButton"); // Assuming you have a button to reopen the main modal
reopenButton.addEventListener('click', reopenMainModal);
