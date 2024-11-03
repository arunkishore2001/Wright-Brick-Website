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

    console.log("Sending data:", JSON.stringify(formData));

    // Send data to server as JSON
    fetch('http://localhost/Wright-Brick-Website01/admin_php/submit_property.php', {  // Replace with your server URL
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(formData)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log("Response from server:", data);
        // Show thank you modal or handle success
        openModal(thankYouModal);
    })
    .catch(error => {
        console.error("Error:", error);
        alert("An error occurred: " + error.message);
    });
}
