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
        profilePic.src = 'default-profile.jpg';
    });

    // Edit Functionality
    function setupEditSection(editBtnId, formId, actionId) {
        const editBtn = document.getElementById(editBtnId);
        const form = document.getElementById(formId);
        const actions = document.getElementById(actionId);
        const inputs = form.querySelectorAll('input, select');

        editBtn.addEventListener('click', () => {
            toggleEditMode(inputs, actions);
        });

        // Reset Button
        const resetBtn = actions.querySelector('[id$="ResetBtn"]');
        resetBtn.addEventListener('click', () => {
            resetForm(inputs);
            toggleEditMode(inputs, actions);
        });

        // Save Button
        const saveBtn = actions.querySelector('[id$="SaveBtn"]');
        saveBtn.addEventListener('click', () => {
            saveForm(inputs);
            toggleEditMode(inputs, actions);
        });
    }

    function toggleEditMode(inputs, actions) {
        const isEditing = actions.style.display !== 'none';
        
        actions.style.display = isEditing ? 'none' : 'flex';
        inputs.forEach(input => {
            input.readOnly = isEditing;
            input.disabled = isEditing;
        });
    }

    function resetForm(inputs) {
        inputs.forEach(input => {
            input.value = input.defaultValue;
        });
    }

    function saveForm(inputs) {
        // Logic to save the form data (e.g., send to server)
        alert('Changes saved successfully!');
    }

    // Setup edit functionality for personal and professional sections
    setupEditSection('personalEditBtn', 'personalInfoForm', 'personalEditActions');
    setupEditSection('professionalEditBtn', 'professionalInfoForm', 'professionalEditActions');
    setupEditSection('passwordEditBtn', 'passwordChangeForm', 'passwordEditActions');
    setupEditSection('settingsEditBtn', 'accountSettingsForm', 'settingsEditActions');
});