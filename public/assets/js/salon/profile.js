document.addEventListener('DOMContentLoaded', () => {
    // Notification Function
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

    // Image Upload Functionality
    const imageUpload = document.getElementById('image1');
    const imagePreview = document.getElementById('preview');

    imageUpload.addEventListener('change', (event) => {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                imagePreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
    
            // Create FormData and append the file
            const formData = new FormData();
            formData.append('salonProfileImage', file);
    
            fetch('/Salon/updateProfileImage', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification(data.message || 'Profile image updated successfully');
                } else {
                    showNotification(data.message || 'Failed to update profile image', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('An error occurred while updating profile image', 'error');
            });
        }
    });

    // Edit Functionality for Different Sections
    function setupEditSection(editBtnId, formId, actionId) {
        const editBtn = document.getElementById(editBtnId);
        const form = document.getElementById(formId);
        const actions = document.getElementById(actionId);

        if (!editBtn || !form || !actions) {
            console.error(`Element(s) not found: ${editBtnId}, ${formId}, ${actionId}`);
            return;
        }

        const inputs = form.querySelectorAll('input, select, textarea');

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
        const saveBtn = actions.querySelector('[id$="SaveBtn"]');
        saveBtn.addEventListener('click', () => {
            const formData = new FormData(form);
            
            try {
                if (saveBtn.id === 'passwordSaveBtn') {
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
            input.readOnly = isEditing;
        });
        actions.style.display = isEditing ? 'none' : 'block';
    }

    function passwordSaveForm(formData) {
        fetch('/Salon/updatePassword', {
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
    setupEditSection('passwordEditBtn', 'passwordChangeForm', 'passwordEditActions');

    // Account Deletion
    const deleteAccountBtn = document.querySelector('.btn-danger');
    deleteAccountBtn.addEventListener('click', () => {
        if(confirm('Are you sure you want to delete your account? This action cannot be undone.')) {
            fetch('/Salon/deleteAccount', {
                method: 'POST'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification(data.message || 'Account deleted successfully');
                    // Redirect to home or login page
                    window.location.href = '/';
                } else {
                    showNotification(data.message || 'Failed to delete account', 'error');
                }
            })
            .catch(error => {
                showNotification('An error occurred while deleting account', 'error');
                console.error('Error:', error);
            });
        }
    });
});