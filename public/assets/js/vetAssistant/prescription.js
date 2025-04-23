// Existing code for showing/hiding surgicalname input
const surgicalYes = document.getElementById('surgical-yes');
const surgicalNo = document.getElementById('surgical-no');
const surgicalNameContainer = document.getElementById('surgicalname-container');
const surgicalDetailContainer = document.getElementById('surgicaldetail-container');


surgicalYes.addEventListener('change', function() {
    if (surgicalYes.checked) {
        surgicalNameContainer.style.display = 'block';
        surgicalDetailContainer.style.display = 'block';
    }
});

surgicalNo.addEventListener('change', function() {
    if (surgicalNo.checked) {
        surgicalNameContainer.style.display = 'none';
        surgicalDetailContainer.style.display = 'none';
    }
});

// Existing code for showing/hiding allergyname input
const allergiesYes = document.getElementById('allergies-yes');
const allergiesNo = document.getElementById('allergies-no');
const allergyNameContainer = document.getElementById('allergyname-container');
const allergyDetailContainer = document.getElementById('allergydetail-container');

allergiesYes.addEventListener('change', function() {
    if (allergiesYes.checked) {
        allergyNameContainer.style.display = 'block';
        allergyDetailContainer.style.display = 'block';
    }
});

allergiesNo.addEventListener('change', function() {
    if (allergiesNo.checked) {
        allergyNameContainer.style.display = 'none';
        allergyDetailContainer.style.display = 'none';
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



// Close the popup when the OK button is clicked
// document.getElementById('okButton').onclick = closePopup;

// Popup functionality for selecting pet name by petID
document.getElementById('sessionID').addEventListener('change', function() {
    const sessionID = this.value;
    const petSelect = document.getElementById('petID');
    petSelect.innerHTML = '<option value="">Select Pet</option>'; // Reset pet options

    if (sessionID && petsBySession[sessionID]) {
        petsBySession[sessionID].forEach(pet => {
            const option = document.createElement('option');
            option.value = pet.petID; 
            option.textContent = `#${pet.petID} - ${pet.name}`; // Display pet ID and the name
            option.dataset.name = pet.name; 
            petSelect.appendChild(option);
        });
        petSelect.disabled = false; // Enable pet select
    } else {
        petSelect.disabled = true; // Disable if no session selected
    }
});

// document.getElementById('okButton').onclick = function() {
//     var selectedPetID = document.getElementById('petID').value;  
    
//     function sendPetID() {
//         var xhr = new XMLHttpRequest();
//         xhr.open("POST", "/VetiPlusMVC/public/doctorprescription", true); // Send to the same PHP file
//         xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        
//         xhr.onreadystatechange = function () {
//             if (xhr.readyState === 4 && xhr.status === 200) {
//                 console.log(xhr.responseText); // Handle response from PHP if needed
//             }
//         };
        
//         xhr.send("petID=" + selectedPetID);
//     }
    
//     // Call the function when needed, for example, on a button click
//     sendPetID();

//     closePopup(); // Close the popup after selection
// };

// Close the popup when the OK button is clicked
document .getElementById('okButton').onclick = function() {
    const petID = petIDSelect.value;
    const sessionID = document.getElementById('sessionID').value;
    // const appointmentID = document.getElementById('appointmentID').value;

    if (petID && sessionID) {
        const data = {
            petID: petID,
            sessionID: sessionID,
        };

        fetch('/VetiPlusMVC/public/assisprescription/getpetdetails', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(result => {
            if (result.status === 'success') {
                // Redirect to the index method to show the updated UI without showing the popup
                window.location.href = '/VetiPlusMVC/public/assisprescription/index?petID=' + petID + '&sessionID=' + sessionID;
            } else {
                alert(result.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    } else {
        alert('Please select a Pet and Session before proceeding.');
    }
};
    