// Define modals and essential elements
var modal = document.getElementById("popupModal");
var thankYouModal = document.getElementById("thankYouModal");
var contactLink = document.getElementById("contactLink");
var closeButtons = document.querySelectorAll('.close, .close-thank-you');
var submitButton = document.querySelector('.btn-next');
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
        rightModal.style.display = "none";
        leftModal.style.display = "block";
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

// Submit the form and show the thank you modal
if (submitButton) {
    submitButton.onclick = function(event) {
        event.preventDefault();
        
        // Validate required fields before submission
        var propertyName = document.getElementById("property-name").value;
        var propertyType = document.getElementById("property_type").value;
        var floorplanType = document.getElementById("floorplan_type").value;

        if (propertyName && propertyType && floorplanType) {
            // Simulate form submission and open the thank you modal
            setTimeout(function() {
                openModal(thankYouModal);
                closeModal(modal);
            }, 500); // Delay to simulate form processing
        } else {
            alert("Please fill out all required fields.");
        }
    };
}

// Function to set property type
function setPropertyType(type) {
    document.getElementById("property_type").value = type;
    updateButtonSelection('.property-type', type);
}

// Function to set floorplan type
function setFloorplanType(type) {
    document.getElementById("floorplan_type").value = type;
    updateButtonSelection('.floorplan-type', type);
}

// Utility function to handle button selection for types
function updateButtonSelection(buttonClass, selectedType) {
    var buttons = document.querySelectorAll(buttonClass);
    buttons.forEach(function(button) {
        button.classList.toggle('selected', button.textContent === selectedType);
    });
}
