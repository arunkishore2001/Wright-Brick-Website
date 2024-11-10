// Set property type function
function setPropertyType(type) {
    document.getElementById('property_type').value = type;
    console.log("Property type selected:", type);
}

// Set floorplan type function
function setFloorplanType(type) {
    document.getElementById('floorplan_type').value = type;
    console.log("Floorplan type selected:", type);
}
function onProperty(event) {
    event.preventDefault(); // Prevent default form submission

    // Get form values
    const propertyType = document.getElementById('property_type').value;
    const propertyName = document.getElementById('property-name').value;
    const floorplanType = document.getElementById('floorplan_type').value;

    // Structure data as JSON
    const formData = {
        property_type: propertyType,
        property_name: propertyName,
        floorplan_type: floorplanType
    };

    $.ajax({
        url: './admin_php/submit_property.php',
        type: 'POST',
        data: JSON.stringify(formData), // Convert formData to JSON
        contentType: 'application/json', // Set the correct content type
        processData: false, // Prevents jQuery from converting the data
        success: function (data) {
            // Check if status is success or error
            if (data.status === "success") {
                $("#ContactSubmitMessage").html(
                    '<div class="alert alert-success my-1 p-2 px-3">' + data.message + '</div>'
                );
                $("#contactForm")[0].reset();
            } else {
                $("#ContactSubmitMessage").html(
                    '<div class="alert alert-danger my-1 p-2 px-3">' + data.message + '</div>'
                );
            }
            // Re-enable the button after the form has been processed
            $("button[type=submit]").prop("disabled", false);

            var modalElem = document.getElementById("popupModal");
            closeModal(modalElem);
        },
        error: function () {
            $("#ContactSubmitMessage").html(
                '<div class="alert alert-danger">An error occurred.</div>'
            );
            // Re-enable the button in case of error
            $("button[type=submit]").prop("disabled", false);
        }
    });
}

