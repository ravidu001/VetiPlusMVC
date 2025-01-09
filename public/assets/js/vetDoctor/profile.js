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

document.addEventListener('DOMContentLoaded', () => {
    // Navigation Functionality
    const navButtons = document.querySelectorAll('.nav-button');
    const sections = document.querySelectorAll('.section');

    navButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Remove active classes
            navButtons.forEach(btn => btn.classList.remove('active'));
            sections.forEach(section => section.classList.remove('active'));

            // Add active classes
            button.classList.add('active');
            const sectionId = button.getAttribute('data-section');
            document.getElementById(sectionId).classList.add('active');
        });
    });

    // Profile Picture Upload
    const profilePicUpload = document.getElementById('profilePictureUpload');
    const profilePic = document.getElementById('profilePicture');
    const removeProfilePicBtn = document.getElementById('removeProfilePicture');

    profilePicUpload.addEventListener('change', (event) => {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                profilePic.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    removeProfilePicBtn.addEventListener('click', () => {
        profilePic.src = '/VetiPlusMVC/public/assets/images/vetDoctor/defaultProfile.png'; // Replace with the correct default profile image path.
    });

    // Edit Functionality
    function setupEditSection(editBtnId, formId, actionId) {
        const editBtn = document.getElementById(editBtnId);
        const form = document.getElementById(formId);
        const actions = document.getElementById(actionId);

        if (!editBtn || !form || !actions) {
            console.error(`Element(s) not found: ${editBtnId}, ${formId}, ${actionId}`);
            return;
        }

        const inputs = form.querySelectorAll('input, select');

        editBtn.addEventListener('click', () => {
            toggleEditMode(inputs, actions);
        });

        // Reset Button
        const resetBtn = actions.querySelector('[id$="ResetBtn"]');
        resetBtn.addEventListener('click', () => {
            inputs.forEach(input => {
                input.value = input.defaultValue;
            });
            toggleEditMode(inputs, actions);
        });

        // Save Button
        const saveBtn = actions.querySelector('[id$="SaveBtn"]'); // Selects the element with an ID that ends with 'SaveBtn'.
        // window.alert(saveBtn);
        saveBtn.addEventListener('click', () => {
            const formData = new FormData(form);
            
            try {
                if (saveBtn.id === 'personalSaveBtn') {
                    personalSaveForm(formData);
                } else if (saveBtn.id === 'professionalSaveBtn') {
                    professionalSaveForm(formData);
                } else if (saveBtn.id === 'passwordSaveBtn') {
                    passwordSaveForm(formData);
                } else {
                    console.error('Unknown save button');
                    return;
                }
                
                toggleEditMode(inputs, actions);
            } catch (error) {
                console.error('Error saving form:', error);
            }
        });
    }

    function toggleEditMode(inputs, actions) {
        const isEditing = actions.style.display !== 'none';
        inputs.forEach(input => {
            // input.readOnly = isEditing;
            input.disabled = isEditing;
        });
        actions.style.display = isEditing ? 'none' : 'block';
    }

    function personalSaveForm(formData) {
        fetch('/VetiPlusMVC/public/DoctorProfile/updatePersonal', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification(data.message || 'Profile updated successfully');
            } else {
                showNotification(data.message || 'Failed to update profile', 'error');
            }
        })
        .catch(error => {
            showNotification('An error occurred while updating profile', 'error');
            console.error('Error:', error);
        });
    }
    
    // Do similar modifications for professionalSaveForm and passwordSaveForm
    function professionalSaveForm(formData) {
        fetch('/VetiPlusMVC/public/DoctorProfile/updateProfessional', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification(data.message || 'Professional details updated successfully');
            } else {
                showNotification(data.message || 'Failed to update professional details', 'error');
            }
        })
        .catch(error => {
            showNotification('An error occurred while updating professional details', 'error');
            console.error('Error:', error);
        });
    }
    
    function passwordSaveForm(formData) {
        fetch('/VetiPlusMVC/public/DoctorProfile/updatePassword', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification(data.message || 'Password updated successfully');
            } else {
                showNotification(data.message || 'Failed to update password', 'error');
            }
        })
        .catch(error => {
            showNotification('An error occurred while updating password', 'error');
            console.error('Error:', error);
        });
    }

    // Initialize Edit Sections
    setupEditSection('personalEditBtn', 'personalInfoForm', 'personalEditActions');
    setupEditSection('professionalEditBtn', 'professionalInfoForm', 'professionalEditActions');
    setupEditSection('passwordEditBtn', 'passwordChangeForm', 'passwordEditActions');
    // setupEditSection('settingsEditBtn', 'accountSettingsForm', 'settingsEditActions');
});
