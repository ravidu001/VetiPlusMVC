document.addEventListener('DOMContentLoaded', () => 
{
    // Navigation Handler with Smooth Scrolling
    const navItems = document.querySelectorAll('.nav-item');
    const sections = document.querySelectorAll('.section');

    navItems.forEach(item => {
        item.addEventListener('click', () => {
            // Remove active classes
            navItems.forEach(nav => nav.classList.remove('active'));
            sections.forEach(section => section.classList.remove('active'));

            // Add active class to clicked item and corresponding section
            item.classList.add('active');
            const sectionId = item.dataset.section;
            const targetSection = document.getElementById(sectionId);
            targetSection.classList.add('active');

            // Smooth scroll to section
            targetSection.scrollIntoView({ behavior: "smooth", block: "start" });
        });
    });

    // Edit Mode Handlers with UI Glow Effect
    const editButtons = document.querySelectorAll('.edit-btn');

    editButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            const sectionId = button.closest('.section').id;
            handleEditMode(sectionId);
        });
    });

    function handleEditMode(sectionId) {
        const section = document.getElementById(sectionId);
        const inputs = section.querySelectorAll('input, select');
        const editBtn = section.querySelector('.edit-btn');

        // Toggle input disabled state
        let isEditing = !inputs[0].disabled;
        inputs.forEach(input => {
            input.disabled = isEditing;
            input.classList.toggle("glow-effect", !isEditing);
        });

        // Change button text and style
        if (isEditing) {
            editBtn.innerHTML = '<i class="fas fa-edit"></i> Edit';
            saveChanges(sectionId);
        } else {
            editBtn.innerHTML = '<i class="fas fa-save"></i> Save';
        }
    }

    function saveChanges(sectionId) {
        const section = document.getElementById(sectionId);
        const inputs = section.querySelectorAll('input, select');
        const formData = {};

        // Collect form data
        inputs.forEach(input => {
            formData[input.name] = input.value;
        });

        // Simulate API call (replace with actual API endpoint)
        fetch('/update-profile', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                section: sectionId,
                data: formData
            })
        })
        .then(response => response.json())
        .then(data => {
            showNotification('✅ Changes saved successfully!', 'success');
        })
        .catch(error => {
            showNotification('❌ Failed to save changes!', 'error');
        });
    }

    // Password Change Handler
    const securityForm = document.querySelector('.security-form');
    securityForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const formData = new FormData(securityForm);
        const passwords = Object.fromEntries(formData.entries());

        // Validate passwords
        if (passwords.newPassword !== passwords.confirmPassword) {
            showNotification('⚠️ Passwords do not match', 'error');
            return;
        }

        // Simulate password change API call
        fetch('/change-password', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(passwords)
        })
        .then(response => response.json())
        .then(data => {
            showNotification('🔑 Password changed successfully!', 'success');
            securityForm.reset();
        })
        .catch(error => {
            showNotification('❌ Failed to change password!', 'error');
        });
    });

    //________________________________________________________________
    //profile handle js 
document.getElementById("profilePictureUpload").addEventListener("change", function () {
    let formData = new FormData();
    formData.append("profilePicture", this.files[0]);

    fetch(`${BASE_URL}/SalonProfile/profileupdate`, {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === "success") {
            document.getElementById("profilePicture").src = "assets/images/salon/profile/" + data.image;
            showNotification('✅ Profile delete successfully!', 'success');
        } else {
            showNotification('❌ Failed to Deleting!', 'error');
        }
    })
    .catch(error => console.error("Error:", error));
});

document.getElementById("removeProfilePicture").addEventListener("click", function () {
    fetch(`${BASE_URL}/SalonProfile/profiledelete`, {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "deleteProfilePicture=true"
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === "success") {
            document.getElementById("profilePicture").src = "assets/images/common/defaultProfile.png";
        } else {
            alert(data.message);
        }
    })
    .catch(error => console.error("Error:", error));
});

        

    // Notification System with Smooth Animation
    function showNotification(message, type) {
        const notification = document.createElement('div');
        notification.classList.add('notification', type);
        notification.textContent = message;

        document.body.appendChild(notification);

        // Fade in
        setTimeout(() => {
            notification.classList.add('show');
        }, 10);

        // Remove notification after 3 seconds
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 500);
        }, 3000);
    }
});
