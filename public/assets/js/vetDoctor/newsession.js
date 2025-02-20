function showNotification(message, type = 'success') {
    // Remove any existing notifications
    const existingNotification = document.querySelector('.notification');
    if (existingNotification) {
        existingNotification.remove();
    }

    // Create notification element
    const notification = document.createElement('div');
    notification.classList.add('notification', `notification-${type}`);
    
    // Set icon based on type
    const icons = {
        success: '✅',
        error: '❌',
        warning: '⚠️'
    };

    notification.innerHTML = `
        <div class="notification-content">
            <span class="notification-icon">${icons[type] || icons.success}</span>
            <p>${message}</p>
        </div>
        <button class="notification-close">&times;</button>
    `;

    // Add to body
    document.body.appendChild(notification);

    // Auto-remove after 5 seconds
    const removeTimer = setTimeout(() => {
        notification.classList.add('notification-exit');
        setTimeout(() => notification.remove(), 500);
    }, 5000);

    // Close button functionality
    const closeBtn = notification.querySelector('.notification-close');
    closeBtn.addEventListener('click', () => {
        clearTimeout(removeTimer);
        notification.classList.add('notification-exit');
        setTimeout(() => notification.remove(), 500);
    });
}

// In your AJAX call or fetch request
// fetch('/VetiPlusMVC/public/DoctorNewSession/createSession', {
//     method: 'POST',
//     body: new FormData(document.getElementById('session-form'))
// })
// .then(response => response.json())
// .then(data => {
//     if (data.success) {
//         showNotification(data.message, 'success');
//     } else {
//         showNotification(data.message, 'error');
//     }
// })
// .catch(error => {
//     showNotification('An error occurred', 'error');
// });

// Assistant Section Toggle
function toggleAssistantSection() {
    const assistantSelect = document.getElementById('assistant-select');
    const assistantRadio = document.querySelector('input[name="assistant"]:checked');
    const canlendarImage = document.querySelector('.calendar-image img');
    
    assistantSelect.style.display = 
        assistantRadio.value === 'yes' ? 'block' : 'none';
        
    canlendarImage.style.display = 
        assistantRadio.value === 'yes' ? 'block' : 'none';
}

// Form Reset
function resetForm() {
    // Reset form fields
    document.getElementById('session-form').reset();
    
    // Clear selected date
    document.getElementById('selected-date').value = '';
    
    // Remove calendar selection
    document.querySelectorAll('.calendar-day').forEach(el => 
        el.classList.remove('selected')
    );
    
    // Hide assistant section
    document.getElementById('assistant-select').style.display = 'none';

    document.getElementById('assistantList').innerHTML = '';
}

// Initialize calendar and event listeners when DOM is fully loaded
document.addEventListener('DOMContentLoaded', () => {
    // Initialize calendar
    const vetCalendar = new VetCalendar();

    // Add event listeners to radio buttons
    document.querySelectorAll('input[name="assistant"]').forEach(radio => {
        radio.addEventListener('change', toggleAssistantSection);
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const districtSelect = document.getElementById('filterDistrict');
    const assistantList = document.getElementById('assistantList');
    const submitButton = document.getElementById('submit-button');

    function calculateAge(dob) {
        const birthDate = new Date(dob);
        const today = new Date();
        let age = today.getFullYear() - birthDate.getFullYear();
        const monthDifference = today.getMonth() - birthDate.getMonth();
    
        // Adjust age if the birth date hasn't occurred yet this year
        if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
    
        return age;
    }

    districtSelect.addEventListener('change', () => {
        const selectedDistrict = districtSelect.value;

        // Make an AJAX request to fetch relevant assistants
        fetch(`/VetiPlusMVC/public/DoctorNewSession/getAssistantsByDistrict?district=${selectedDistrict}`)
            .then(response => response.json())
            .then(data => {
                // Clear the current list
                assistantList.innerHTML = '';
                
                // Check if there are any assistants
                if (data.success && data.assistants.length > 0) {
                    // Display the relevant assistants
                    data.assistants.forEach(assistant => {
                        const assistantItem = document.createElement('div');
                        const age = calculateAge(assistant.DOB);
                        assistantItem.classList.add('assistant-item');
                        assistantItem.innerHTML = `
                            <div class="assistant-card" data-assistant-id="${assistant.assistantID}">
                                <div class="assistant-avatar">
                                    <img src="<?= ROOT ?>/assets/images/vetAssistant/${assistant.profilePicture}" alt="assistant">
                                </div>
                                <div class="assistant-details">
                                    <div class="details-header">
                                        <h4>${assistant.fullName}</h4>
                                        <div class="hourly-rate">
                                            <span>${assistant.chargePerHour}</span>
                                            <small>/hr</small>
                                        </div>
                                    </div>
                                    <div class="rating">
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-half-line"></i>
                                        4.5
                                    </div>
                                    <div class="assistant-badges">
                                        
                                        <span class="badge">Age: ${age}</span>
                                        <span class="badge">Exp: ${assistant.experience} Yrs</span>
                                    </div>
                                </div>
                                <label class="custom-checkbox">
                                    <input type="checkbox" name="assistant-select">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        `;
                        assistantList.appendChild(assistantItem);
                    });
                } else {
                    assistantList.innerHTML = '<p>No assistants found for the selected district.</p>';
                }
            })
            .catch(error => {
                console.error('Error fetching assistants:', error);
                assistantList.innerHTML = '<p>Error fetching assistants. Please try again later.</p>';
            });
    });

    submitButton.addEventListener('click', (event) => {
        event.preventDefault(); // Prevent the default form submission

        // Get all checked checkboxes
        const selectedAssistants = [];
        const checkboxes = document.querySelectorAll('input[name="assistant-select"]:checked');

        checkboxes.forEach(checkbox => {
            // Assuming you have a way to identify the assistant, e.g., by ID
            const assistantCard = checkbox.closest('.assistant-card');
            const assistantID = assistantCard.getAttribute('data-assistant-id'); // Add data attribute in HTML
            selectedAssistants.push(assistantID);
        });

        // Now you can do something with the selected assistants
        console.log('Selected Assistants:', selectedAssistants);

        // Optionally, you can submit the form with the selected assistants
        // You can add the selected assistants to a hidden input field or send them via AJAX
        // For example, if you want to add them to a hidden input:
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'assistantIDs'; // Name it appropriately
        hiddenInput.value = JSON.stringify(selectedAssistants); // Convert to JSON string
        document.getElementById('session-form').appendChild(hiddenInput);

        const form = document.getElementById('session-form');
    const formData = new FormData(form);

    fetch('/VetiPlusMVC/public/DoctorNewSession/createSession', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            showNotification(data.message, 'success');
            // Optional: Reset form or redirect
            form.reset();
        } else {
            showNotification(data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('An unexpected error occurred', 'error');
    });
    });
    
});

