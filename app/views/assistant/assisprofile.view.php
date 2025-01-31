<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vet Assistant Profile</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/doctornav.css">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --body-color: #E4E9F7;
            --primary-color: #6A0DAD;
            --secondary-color: #8E44AD;
            --white-color: #FFFFFF;
            --text-color: #333;
            --light-text: #666;
            --border-color: #E0E0E0;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: var(--body-color);
            line-height: 1.6;
        }

        .home {
            position: relative;
            left: 250px;
            height: 100vh;
            width: calc(100% - 250px);
            background: var(--body-color);
            transition: var(--transition);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            box-sizing: border-box;
        }

        .profile-container {
            display: flex;
            background-color: var(--white-color);
            max-width: 1200px;
            margin: 30px auto;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            overflow: hidden;
            width: 100%;
            max-height: 90vh;
        }

        .section-navigation {
            width: 250px;
            background-color: var(--primary-color-light);
            padding: 20px;
            border-right: 1px solid var(--border-color);
        }

        .nav-buttons {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .nav-button {
            background: transparent;
            border: none;
            color: var(--text-color);
            padding: 12px 15px;
            text-align: left;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: var(--transition);
        }

        .nav-button:hover,
        .nav-button.active {
            background-color: var(--primary-color);
            color: var(--white-color);
        }

        .profile-content {
            flex-grow: 1;
            padding: 30px;
            display: flex;
            flex-direction: column;
            max-height: 70vh; /* Consistent maximum height */
            overflow: hidden; /* Prevent overall container overflow */
        }

        .section {
            display: none;
            flex: 1; /* Equal height for all sections */
            overflow-y: auto; /* Enable scrolling for individual sections */
            padding-right: 15px; /* Space for scrollbar */
        }

        .section.active {
            display: flex;
            flex-direction: column;
        }

        /* Minimum content styling to ensure consistent layout */
        .section .section-header {
            flex-shrink: 0; /* Prevent header from shrinking */
        }

        .section .form-grid {
            flex-grow: 1; /* Allow content to fill available space */
        }

        /* For shorter sections like Password and Account Settings */
        #password .form-grid,
        #settings .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            align-content: start; 
            min-height: 500px; /* Minimum height to match other sections */
        }

        /* Additional styling for account actions */
        #settings .form-group:last-child {
            margin-top: auto;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
        }

        /* Custom scrollbar for better aesthetics */
        .section::-webkit-scrollbar {
            width: 8px;
        }

        .section::-webkit-scrollbar-track {
            background: var(--body-color);
            border-radius: 10px;
        }

        .section::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 10px;
        }

        .section::-webkit-scrollbar-thumb:hover {
            background: var(--secondary-color);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .profile-content {
                max-height: none;
                height: auto;
            }

            #password .form-grid,
            #settings .form-grid {
                grid-template-columns: 1fr;
            }
        }

        .profile-picture-container {
            display: flex;
            justify-content: center;
            margin-bottom: 25px;
        }

        .profile-picture-wrapper {
            position: relative;
            width: 200px;
            height: 200px;
        }

        .profile-picture {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid var(--primary-color);
        }

        .profile-picture-overlay {
            position: absolute;
            bottom: 0;
            right: 0;
            display: flex;
            gap: 10px;
        }

        .upload-btn, 
        .remove-btn {
            background-color: var(--primary-color);
            color: var(--white-color);
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            margin-bottom: 8px;
            color: var(--light-text);
        }

        .form-input {
            padding: 10px;
            border: 1px solid var(--border-color);
            border-radius: 5px;
            transition: var(--transition);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(106, 13, 173, 0.2);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: var(--primary-color);
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .edit-btn {
            background-color: var(--primary-color);
            color: var(--white-color);
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
        }

        .edit-actions {
            display: none;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 25px;
        }

        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: var(--white-color);
        }

        .btn-secondary {
            background-color: var(--border-color);
            color: var(--text-color);
        }

        .file-input {
            display: none;
        }

        .btn-danger {
            background-color: red;
            color: white;
            margin-top: 10px;
        }

        /* Styles for full-width form groups */
        .form-grid .full-width {
            grid-column: 1 / -1;
        }

        /* Bio input styling */
        .bio-input {
            min-height: 100px;
            resize: vertical;
        }

        /* Language Checkbox Styling */
        .language-checkboxes {
            display: flex;
            gap: 20px;
        }

        .checkbox-container {
            display: block;
            position: relative;
            padding-left: 35px;
            margin-bottom: 12px;
            cursor: pointer;
            user-select: none;
        }

        .checkbox-container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 25px;
            width: 25px;
            background-color: #eee;
            border-radius: 4px;
        }

        .checkbox-container:hover input ~ .checkmark {
            background-color: #ccc;
        }

        .checkbox-container input:checked ~ .checkmark {
            background-color: var(--primary-color);
        }

        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        .checkbox-container input: checked ~ .checkmark:after {
            display: block;
        }

        .checkbox-container .checkmark:after {
            left: 9px;
            top: 5px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 3px 3px 0;
            transform: rotate(45deg);
        }

        .add-certificate-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--primary-color);
            color: var(--white-color);
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
            transition: var(--transition);
            gap: 10px;
            margin-top: 10px;
            font-size: 14px;
        }

        .add-certificate-btn:hover {
            background-color: var(--secondary-color);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .add-certificate-btn i {
            font-size: 16px;
        }

        .certificate-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            align-items: center;
        }

        .certificate-wrapper {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .certificate-image {
            width: 150px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
            border: 2px solid var(--border-color);
        }

        .remove-certificate-btn {
            background-color: #DC3545;
            color: var(--white-color);
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            margin-top: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }

        .remove-certificate-btn:hover {
            background-color: #C82333;
        }

        .remove-certificate-btn i {
            font-size: 14px;
        }
    </style>
</head>
<body>
<?php require_once '../app/views/navbar/assistantnav.php'; ?>

    <div class="home">
        <div class="profile-container">
            <!-- Side Navigation -->
            <div class="section-navigation">
                <div class="nav-buttons">
                    <button class="nav-button active" data-section="personal">
                        <i class="fas fa-user"></i> Personal Info
                    </button>
                    <button class="nav-button" data-section="professional">
                        <i class="fas fa-briefcase"></i> Professional Details
                    </button>
                    <button class="nav-button" data-section="password">
                        <i class="fas fa-lock"></i> Change Password
                    </button>
                    <button class="nav-button" data-section="settings">
                        <i class="fas fa-cog"></i> Account Settings
                    </button>
                </div>
            </div>

            <!-- Profile Content -->
            <div class="profile-content">
                <!-- Personal Information Section -->
                <div id="personal" class="section active">
                    <h2 class="section-header">
                        Personal Information 
                        <button class="edit-btn" id="personalEditBtn">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                    </h2>
                    
                    <div class="profile-picture-container">
                        <div class="profile-picture-wrapper">
                            <img src="<?= ROOT ?>/assets/images/common/defaultProfile.png" alt="Profile Picture" class="profile-picture" id="profilePicture">
                            <div class="profile-picture-overlay">
                                <input type="file" id="profilePictureUpload" accept="image/*" class="file-input">
                                <label for="profilePictureUpload" class="upload-btn">
                                    <i class="fas fa-camera"></i>
                                </label>
                                <button class="remove-btn" id="removeProfilePicture">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-grid" id="personalInfoForm">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" class="form-input" value="Dr. Jane Doe" readonly>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-input" value="jane.doe@veterinary.com" readonly>
                        </div>
                        <div class="form-group">
                            <label>NIC Number</label>
                            <input type="text" class="form-input" value="199845123456" readonly>
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="tel" class="form-input" value="+1 (555) 123-4567" readonly>
                        </div>
                        <div class="form-group">
                            <label>Date of Birth</label>
                            <input type="date" class="form-input" readonly>
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <select class="form-input" disabled>
                                <option>Male</option>
                                <option selected>Female</option>
                                <option>Other</option>
                            </select>
                        </div>
                        <div class="form-group full-width">
                            <label>Address</label>
                            <input type="text" class="form-input" value="123 Veterinary Street, Animal City, AC 12345" readonly>
                        </div>
                        <div class="form-group full-width">
                            <label>Bio</label>
                            <textarea class="form-input bio-input" readonly>Passionate veterinary assistant with 5 years of experience in small animal care. Dedicated to providing compassionate and professional support to both animals and their owners.</textarea>
                        </div>
                    </div>

                    <div class="edit-actions" id="personalEditActions" style="display: none;">
                        <button class="btn btn-secondary" id="personalResetBtn">
                            <i class="fas fa-undo"></i> Reset
                        </button>
                        <button class="btn btn-primary" id="personalSaveBtn">
                            <i class="fas fa-save"></i> Save
                        </button>
                    </div>
                </div>

                <!-- Professional Details Section -->
                <div id="professional" class="section">
                    <h2 class="section-header">
                        Professional Details
                        <button class="edit-btn" id="professionalEditBtn">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                    </h2>
                    
                    <div class="form-grid professional-details" id="professionalInfoForm">
                        <div class="form-group">
                            <label>License Number</label>
                            <input type="text" class="form-input" value="VET123456" readonly>
                        </div>
                        <div class="form-group">
                            <label>Specialization</label>
                            <input type="text" class="form-input" value="Small Animal Surgery" readonly>
                        </div>
                        <div class="form-group">
                            <label>Years of Experience</label>
                            <input type="number" class="form-input" value="10" readonly>
                        </div>
                        <div class="form-group">
                            <label>Charge per Hour</label>
                            <input type="number" class="form-input" value="50" readonly>
                        </div>
                        <div class="form-group full-width">
                            <label>Languages Spoken</label>
                            <div class="language-checkboxes">
                                <label class="checkbox-container">
                                    <input type="checkbox" disabled checked default> English
                                    <span class="checkmark"></span>
                                </label>
                                <label class="checkbox-container">
                                    <input type="checkbox" disabled> Sinhala
                                    <span class="checkmark"></span>
                                </label>
                                <label class="checkbox-container">
                                    <input type="checkbox" disabled> Tamil
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Certifications</label>
                            <div class="certificate-container">
                                <div class="certificate-wrapper">
                                    <img src="cert1.jpg" alt="Certification 1" class="certificate-image">
                                    <button class="remove-certificate-btn">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                <div class="certificate-wrapper">
                                    <img src="cert2.jpg" alt="Certification 2" class="certificate-image">
                                    <button class="remove-certificate-btn">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                <button class="add-certificate-btn">
                                    <i class="fas fa-plus"></i> Add Certificate
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="edit-actions" id="professionalEditActions" style="display: none;">
                        <button class="btn btn-secondary" id="professionalResetBtn">
                            <i class="fas fa-undo"></i> Reset
                        </button>
                        <button class="btn btn-primary" id="professionalSaveBtn">
                            <i class="fas fa-save"></i> Save
                        </button>
                    </div>
                </div>


                <!-- Password Change Section -->
                <div id="password" class="section">
                    <h2 class="section-header">
                        Change Password
                        <button class="edit-btn" id="passwordEditBtn">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                    </h2>
                    
                    <div class="form-grid" id="passwordChangeForm">
                        <div class="form-group">
                            <label>Current Password</label>
                            <input type="password" class="form-input" readonly>
                        </div>
                        <br />
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" class="form-input" readonly>
                        </div>
                        <div class="form-group">
                            <label>Confirm New Password</label>
                            <input type="password" class="form-input" readonly>
                        </div>
                    </div>

                    <div class="edit-actions" id="passwordEditActions" style="display: none;">
                        <button class="btn btn-secondary" id="passwordResetBtn">
                            <i class="fas fa-undo"></i> Reset
                        </button>
                        <button class="btn btn-primary" id="passwordSaveBtn">
                            <i class="fas fa-save"></i> Save
                        </button>
                    </div>
                </div>

                <!-- Account Settings Section -->
                <div id="settings" class="section">
                    <h2 class="section-header">
                        Account Settings
                    </h2>
                    
                    <div class="form-grid" id="accountSettingsForm">
                        <div class="form-group">
                            <label>User ID</label>
                            <input type="text" class="form-input" value="101" readonly>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-input" value="jane.doe@veterinary.com" readonly>
                        </div>
                        <div class="form-group">
                        <label>Account Actions</label>
                        <div>
                            <button class="edit-btn">
                                <i class='fas fa-sign-out-alt'></i> Logout
                            </button>
                            <button class="btn-danger">
                                <i class='fas fa-trash'></i> Delete Account
                            </button>
                        </div>
                    </div>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const navButtons = document.querySelectorAll('.nav-button');
            const sections = document.querySelectorAll('.section');

            navButtons.forEach(button => {
                button.addEventListener('click', () => {
                    navButtons.forEach(btn => btn.classList.remove('active'));
                    sections.forEach(section => section.classList.remove('active'));

                    button.classList.add('active');
                    const sectionId = button.getAttribute('data-section');
                    document.getElementById(sectionId).classList.add('active');
                });
            });

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
                profilePic.src = 'defaultProfile.png';
            });

            function setupEditSection(editBtnId, formId, actionId) {
                const editBtn = document.getElementById(editBtnId);
                const form = document.getElementById(formId);
                const actions = document.getElementById(actionId);
                const inputs = form.querySelectorAll('input, select');

                if (editBtn) {
                    editBtn.addEventListener('click', () => {
                        toggleEditMode(inputs, actions);
                    });
                } else {
                //     console.log('editBtn element not found');
                }

                const resetBtn = actions.querySelector('[id$="ResetBtn"]');
                resetBtn.addEventListener('click', () => {
                    resetForm(inputs);
                    toggleEditMode(inputs, actions);
                });

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
                    // Reset text inputs, select, and number inputs
                    if (input.type === 'text' || input.type === 'email' || 
                        input.type === 'number' || input.tagName.toLowerCase() === 'select') {
                        input.value = input.defaultValue;
                    }
                    
                    // Reset checkboxes
                    if (input.type === 'checkbox') {
                        // Reset to original checked state
                        input.checked = input.defaultChecked;
                    }
                });
            }

            function saveForm(inputs) {
                alert('Changes saved successfully!');
            }

            setupEditSection('personalEditBtn', 'personalInfoForm', 'personalEditActions');
            setupEditSection('professionalEditBtn', 'professionalInfoForm', 'professionalEditActions');
            setupEditSection('passwordEditBtn', 'passwordChangeForm', 'passwordEditActions');
            setupEditSection('settingsEditBtn', 'accountSettingsForm', 'settingsEditActions');
        });
    </script>
</body>
</html>