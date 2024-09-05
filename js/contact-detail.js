
  document.addEventListener('DOMContentLoaded', () => {
    const propertyTypeButtons = document.querySelectorAll('.property-type');
    const floorplanButtons = document.querySelectorAll('.floorplan-type');
    const planningButtons = document.querySelectorAll('.planning-type');
    const lookingForButtons = document.querySelectorAll('.looking-type');
    const budgetSelect = document.querySelector('select');
    const possessionSelect = document.querySelectorAll('select')[1];
    let selectedPropertyType = '';
    let selectedFloorplanType = '';
    let selectedPlanningType = '';
    let selectedLookingForType = '';

    // Add event listeners for property type buttons
    propertyTypeButtons.forEach(button => {
      button.addEventListener('click', () => {
        selectedPropertyType = button.innerText;
      });
    });

    // Add event listeners for floorplan buttons
    floorplanButtons.forEach(button => {
      button.addEventListener('click', () => {
        selectedFloorplanType = button.innerText;
      });
    });

    // Add event listeners for planning type buttons
    planningButtons.forEach(button => {
      button.addEventListener('click', () => {
        selectedPlanningType = button.innerText;
      });
    });

    // Add event listeners for looking for buttons
    lookingForButtons.forEach(button => {
      button.addEventListener('click', () => {
        selectedLookingForType = button.innerText;
      });
    });

    // Add event listener for the submit button
    const submitButton = document.querySelector('.btn-next');
    submitButton.addEventListener('click', () => {
      const budget = budgetSelect.value;
      const possession = possessionSelect.value;

      // Collect and print data in console
      console.log({
        propertyType: selectedPropertyType,
        floorplanType: selectedFloorplanType,
        planningType: selectedPlanningType,
        lookingFor: selectedLookingForType,
        budget: budget,
        possession: possession
      });
    });
  });

