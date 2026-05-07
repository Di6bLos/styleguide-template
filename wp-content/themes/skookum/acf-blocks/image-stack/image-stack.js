const checkboxes = document.querySelectorAll('.layers-checkbox-group input[type="checkbox"]');
const toggleBtn = document.querySelector('.layers-checkbox-group__toggle-btn');

// Function to update layer visibility based on checkbox states
function updateLayerVisibility() {
    checkboxes.forEach(checkbox => {
        // Get the layer ID from the checkbox value attribute
        const layerId = checkbox.value;
        const layer = document.getElementById(layerId);
        
        // Toggle the visibility of the corresponding layer
        layer.classList.toggle('hidden', !checkbox.checked);
    });
}

checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', updateLayerVisibility);
});

// Function to toggle all checkboxes
function toggleAllCheckboxes() {
    // Check if all checkboxes are currently checked
    const allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);

    // If all are checked, uncheck all; otherwise, check all
    checkboxes.forEach(checkbox => {
        checkbox.checked = !allChecked; 
    });
    
    updateLayerVisibility();
}

if (toggleBtn) {
    toggleBtn.addEventListener('click', toggleAllCheckboxes);
}

// Initialize layer visibility on page load
updateLayerVisibility();
