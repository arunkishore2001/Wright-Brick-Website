// Define modals and essential elements
var modal = document.getElementById("popupModal");
var thankYouModal = document.getElementById("thankYouModal");
var contactLink = document.getElementById("contactLink");
var closeButtons = document.querySelectorAll('.close, .close-thank-you');
var allButtons = modal.querySelectorAll('button');
var leftModal = document.querySelector('.left-modal');
var rightModal = document.querySelector('.right-modal');

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
        if (rightModal) rightModal.style.display = "none";
        if (leftModal) leftModal.style.display = "block";
    };
}

// Close all modals when clicking any close button
closeButtons.forEach(function(button) {
    button.addEventListener('click', function() {
        closeModal(modal);
        closeModal(thankYouModal);
    });
});

// Close modals if clicking outside of them
window.onclick = function(event) {
    if (event.target === modal || event.target === thankYouModal) {
        closeModal(modal);
        closeModal(thankYouModal);
    }
};

allButtons.forEach(function(button) {
    button.addEventListener('click', function() {
        button.style.backgroundColor = 'red';
        button.style.color = 'white';
    });
});
