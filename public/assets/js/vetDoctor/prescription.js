// Existing code for showing/hiding surgicalname input
const surgicalYes = document.getElementById('surgical-yes');
const surgicalNo = document.getElementById('surgical-no');
const surgicalNameContainer = document.getElementById('surgicalname-container');

surgicalYes.addEventListener('change', function() {
    if (surgicalYes.checked) {
        surgicalNameContainer.style.display = 'block';
    }
});

surgicalNo.addEventListener('change', function() {
    if (surgicalNo.checked) {
        surgicalNameContainer.style.display = 'none';
    }
});

// Existing code for showing/hiding allergyname input
const allergiesYes = document.getElementById('allergies-yes');
const allergiesNo = document.getElementById('allergies-no');
const allergyNameContainer = document.getElementById('allergyname-container');

allergiesYes.addEventListener('change', function() {
    if (allergiesYes.checked) {
        allergyNameContainer.style.display = 'block';
    }
});

allergiesNo.addEventListener('change', function() {
    if (allergiesNo.checked) {
        allergyNameContainer.style.display = 'none';
    }
});

document.addEventListener('DOMContentLoaded', function() {
// Set min date for vaccineDate input
const vaccineDateInput = document.getElementById('vaccineDate');
const today = new Date();
const tomorrow = new Date(today);
tomorrow.setDate(tomorrow.getDate() + 1);
const yyyy = tomorrow.getFullYear();
const mm = String(tomorrow.getMonth() + 1).padStart(2, '0'); // Months are zero-based
const dd = String(tomorrow.getDate()).padStart(2, '0');
const minDate = `${yyyy}-${mm}-${dd}`;
vaccineDateInput.setAttribute('min', minDate);
});


// Popup functionality
const petPopup = document.getElementById('petPopup');
const closeBtn = document.querySelector('.close-btn');
const petIDSelect = document.getElementById('petID');
const petNameInput = document.getElementById('petName');

// Example of how to open the popup (you can call this function when needed)
openPopup();

// Function to open the popup
function openPopup() {
    petPopup.style.display = 'block';
}

// Function to close the popup
function closePopup() {
    petPopup.style.display = 'none';
}

// Close the popup when clicking the close button
closeBtn.onclick = closePopup;

// Close the popup when clicking outside of the popup content
window.onclick = function(event) {
    if (event.target === petPopup) {
        closePopup();
    }
}

// Update pet name based on selected pet ID
petIDSelect.addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    petNameInput.value = selectedOption.getAttribute('data-name');
});

// Show the popup when the page is loaded
document.addEventListener('DOMContentLoaded', function() {
    openPopup(); // Automatically open the popup on page refresh
});

// Close the popup when the OK button is clicked
document.getElementById('okButton').onclick = closePopup;