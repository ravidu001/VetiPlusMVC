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

            // Smooth scroll to section /^(\d{9}[vVxX]|\d{12})$/
            targetSection.scrollIntoView({ behavior: "smooth", block: "start" });
        });
    });

    // Delete mode Handlers with UI Glow Effect
    const deleteButtons = document.querySelectorAll('.btn-delete');

    deleteButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault(); // Prevent the default form submission
            // const sectionId = button.closest('.section').id;
            // saveChanges(sectionId);
            document.getElementById('confirmationModal').style.display = 'block'; // Show the modal
        });
    });    

    // Handle confirmation for account deletion
    document.getElementById('confirmDeleteButton').addEventListener('click', () => {
        const password = document.getElementById('confirmPasswordInput').value;
        const sectionId = 'account'; // Assuming the section ID for account settings
        handleAccount(sectionId, { enterPassword: password }); // Call the function to delete the account
        document.getElementById('confirmationModal').style.display = 'none'; // Hide the modal after action
    });

    // Handle cancellation
    document.getElementById('cancelDeleteButton').addEventListener('click', () => {
        document.getElementById('confirmationModal').style.display = 'none'; // Hide the modal
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

        // console.log(sectionId);

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
            // saveChanges(sectionId);
        }
    }

    function saveChanges(sectionId) {
        const section = document.getElementById(sectionId);
        const inputs = section.querySelectorAll('input, select');
        const formData = {};

        console.log(sectionId);

        // Collect form data
        inputs.forEach(input => {
            formData[input.name] = input.value;
        });

       if(sectionId == 'salon-info')
       {
            handleSalonInfo(sectionId,formData);
       }
       else if(sectionId == 'security')
       {
            handlePassword(sectionId,formData);
       }
       else if(sectionId == 'account')
       {
            handleAccount(sectionId, formData);
       }
   
    }

    //function to delete account_______________________________________________________________________________________________________
    function handleAccount(sectionId, formData)
    {
        // Simulate API call (replace with actual API endpoint)
        fetch(`${BASE_URL}/SalonProfile/deleteAccount`, {
            method: 'POST',
            headers: {
                'Content-Type' : 'application/json' ,
            },
            body: JSON.stringify({
                sectionId : sectionId,
                data: formData
            })
        })
        .then(response => response.json())
        .then(data => {
            if(data.status === 'success')
            {
                showNotification('✅ Account delete successfully!', 'success');
                redirect('Login');
            }
            else
            {
                showNotification('❌ Failed to delete Your Account: ' + data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('❌ Failed to delele account.Cannot connect backend.!', 'error');
        })
    }

    // function to set the salon information to backend________________________________________________________________________________________
    function handleSalonInfo(sectionId, formData)
    {
        // Simulate API call (replace with actual API endpoint)
        fetch(`${BASE_URL}/SalonProfile/update`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                sectionId : sectionId,
                data: formData
            })
        })
        .then(response => response.json())
        .then(data => {
            if(data.status === 'success')
            {
                showNotification('✅ Changes saved successfully!', 'success');
            }
            else
            {
                showNotification('❌ Failed to save changes: ' + data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('❌ Failed to save changes!', 'error');
        });
    }

    // Password Change Handler_________________________________________________________________________________________________________
    function handlePassword(sectionId,formData)
    {
        const securityForm = document.querySelector('.security-form');
       
            // Simulate password change API call
            fetch(`${BASE_URL}/SalonProfile/changePassword`, 
            {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    sectionId : sectionId,
                    data: formData
                })
            })
            .then(response => response.json())
            .then(data => {
                if(data.status === 'success')
                {
                    showNotification('🔑 Password changed successfully!', 'success');
                    securityForm.reset();
                }
                else
                {
                    showNotification('❌ Failed to change password: ' + data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('❌ Failed to change password!', 'error');
            });
    }
    

    //profile handle js _________________________________________________________________________________________________________________
    document.getElementById("profilePictureUpload").addEventListener("change", function () {
        let formData = new FormData();
        formData.append("profilePicture", this.files[0]);

        console.log(formData);

        fetch(`${BASE_URL}/SalonProfile/profileupdate`, {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                document.getElementById("profilePicture").src = "assets/images/salon/profile/" + data.image;
                showNotification('✅ Profile upload successfully!', 'success');
            } else {
                showNotification('❌ Failed to Uploading!', 'error');
            }
        })
        .catch(error => console.error("Error:", error));
    });

    //profile remove ____________________________________________________________________________________________________________________
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

    // Notification System with Smooth Animation____________________________________________________________________________________________
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
            }, 5000);
        }, 30000);
    }
});

//troggle password icon
function togglePassword(event) {
    const span = event.target; // Get the clicked 👁️
    const input = span.previousElementSibling; // The input before the span

    if (input.type === "password") {
        input.type = "text";
        span.textContent = "🙈"; // Change icon to show it's now visible
    } else {
        input.type = "password";
        span.textContent = "👁️"; // Change icon back to hidden
    }
}