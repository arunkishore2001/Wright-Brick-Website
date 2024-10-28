// Define modals and essential elements
var modal = document.getElementById("popupModal");
var thankYouModal = document.getElementById("thankYouModal");
var contactLink = document.getElementById("contactLink");
var closeButtons = document.querySelectorAll('.close-thank-you');
var nextButton = document.querySelector('.next-button');
var backButton = document.querySelector('.btn-back');
var submitButton = document.querySelector('.btn-next');
var leftModal = document.querySelector('.left-modal');
var rightModal = document.querySelector('.right-modal');
var reopenButton = document.getElementById("reopenButton");

// Check if essential elements are found
console.log({
    modal, thankYouModal, contactLink, closeButtons, nextButton, 
    backButton, submitButton, leftModal, rightModal, reopenButton
});

// Function to show a modal
function openModal(modalElement) {
    if (modalElement) modalElement.style.display = "block";
}

// Function to hide a modal
function closeModal(modalElement) {
    if (modalElement) modalElement.style.display = "none";
}

// Event listener for opening the main modal on contact link click
if (contactLink) {
    contactLink.onclick = function(event) {
        event.preventDefault();
        openModal(modal);
        rightModal.style.display = "none"; // Ensure left modal starts
        leftModal.style.display = "block"; // Show left modal content
    };
}

// Close all modals when clicking any close button
closeButtons.forEach(function(button) {
    button.addEventListener('click', function() {
        closeModal(modal);
        closeModal(thankYouModal);
        closeModal(leftModal);
        closeModal(rightModal);
    });
});

// Close modals if clicking outside of them
window.onclick = function(event) {
    if (event.target === modal || event.target === thankYouModal) {
        closeModal(modal);
        closeModal(thankYouModal);
    }
};

// Toggle between left and right modal content
if (nextButton) {
    nextButton.onclick = function() {
        leftModal.style.display = "none";
        rightModal.style.display = "block";
    };
}

if (backButton) {
    backButton.onclick = function() {
        rightModal.style.display = "none";
        leftModal.style.display = "block";
    };
}

// Open thank you modal on submit
if (submitButton) {
    submitButton.onclick = function() {
        // Simulate form submission delay
        setTimeout(function() {
            openModal(thankYouModal);
            closeModal(modal);
        }, 500); // Delay to simulate
    };
}

// Reopen main modal if required
if (reopenButton) {
    reopenButton.onclick = function() {
        openModal(modal);
    };
}

// Utility to handle single-selection for button groups
function handleButtonSelection(buttons) {
    if (!buttons.length) return; // Check if buttons are present
    buttons.forEach(function(button) {
        button.addEventListener('click', function() {
            buttons.forEach(btn => btn.classList.remove('selected'));
            this.classList.add('selected');
        });
    });
}

// Initialize button groups for selection handling
handleButtonSelection(document.querySelectorAll('.property-type'));
handleButtonSelection(document.querySelectorAll('.floorplan-type'));
handleButtonSelection(document.querySelectorAll('.planning-type'));
handleButtonSelection(document.querySelectorAll('.looking-type'));
