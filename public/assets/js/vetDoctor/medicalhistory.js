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
    const appointmentID = document.getElementById('appointmentID').value;

    if (petID && sessionID && appointmentID) {
        const data = {
            petID: petID,
            sessionID: sessionID,
            appointmentID: appointmentID
        };

        fetch('/VetiPlusMVC/public/doctormedicalhistory/getpetdetails', {
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
                window.location.href = '/VetiPlusMVC/public/doctormedicalhistory/index?petID=' + petID;
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