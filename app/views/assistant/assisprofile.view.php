<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vet Assistant Profile</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/doctornav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/vetAssistant/profile.css">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    
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
                    <button class="nav-button" data-section="dangerArea">
                        <i class="fas fa-exclamation-triangle"></i> Danger Zone
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
                            <img src="<?= ROOT ?>/assets/images/vetAssistant/<?= htmlspecialchars($assis->profilePicture ?? 'N/A') ?>" alt="Profile Picture"
                                class="profile-picture" id="profilePicture">
                            <div class="profile-picture-overlay">
                                <input type="file" id="profilePictureUpload" accept="image/*" class="file-input" name="profilePicture">
                                <label for="profilePictureUpload" class="upload-btn">
                                    <i class="fas fa-camera"></i>
                                </label>
                                <button class="remove-btn" id="removeProfilePicture">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>


                    <form class="form-grid" id="personalInfoForm">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" class="form-input" name="fullName"
                                value="<?= htmlspecialchars($assis->fullName ?? 'N/A') ?>" disabled>
                        </div>
                        <!-- <div class="form-group">
                            <label>Email</label>
                            <input type="hidden" class="form-input" value="" disabled>
                        </div> -->
                        <!-- <div class="form-group">
                            <label>NIC Number</label>
                            <input type="text" class="form-input" value="199845123456" disabled>
                        </div> -->
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="tel" class="form-input" name="contactNumber"
                                value="<?= htmlspecialchars($assis->contactNumber ?? 'N/A') ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label>Date of Birth</label>
                            <input type="date" class="form-input" name="DOB"
                                value="<?= htmlspecialchars($assis->DOB ?? 'N/A') ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <select class="form-input" name="gender" disabled>
                                <option value="Male" <?= ($assis->gender ?? '') === 'Male' ? 'selected' : '' ?>>Male
                                </option>
                                <option value="Female" <?= ($assis->gender ?? '') === 'Female' ? 'selected' : '' ?>>
                                    Female</option>
                                <option value="Other" <?= ($assis->gender ?? '') === 'Other' ? 'selected' : '' ?>>
                                    Other
                                </option>
                            </select>

                        </div>
                        <div class="form-group full-width">
                            <label>Address</label>
                            <input type="text" name="address" class="form-input"
                                value="<?= htmlspecialchars($assis->address ?? 'N/A') ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label>District</label>
                            <input type="text" class="form-input" name="district"
                                value="<?= htmlspecialchars($assis->district ?? 'N/A') ?>" disabled>
                        </div>
                        <div class="form-group full-width">
                            <label>Bio</label>
                            <textarea class="form-input bio-input" name="bio" readonly>
                                <?= htmlspecialchars($assis->bio, ENT_QUOTES, 'UTF-8') ?>
                            </textarea>
                        </div>
                    </form>

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

                    <form class="form-grid professional-details" id="professionalInfoForm">
                        <div class="form-group">
                            <label>License Number</label>
                            <input type="text" class="form-input" name="certificateNumber"
                                value="<?= htmlspecialchars($assis->certificateNumber ?? 'N/A') ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="expertise">Specialization</label>
                            <select id="expertise" class="form-input" name="expertise" disabled>
                                <option value="Small Animal Care"
                                    <?= (htmlspecialchars($assis->expertise) ?? '') === 'Small Animal Care' ? 'selected' : '' ?>>
                                    Small Animal Care</option>
                                <option value="Large Animal Medicine"
                                    <?= (htmlspecialchars($assis->expertise) ?? '') === 'Large Animal Medicine' ? 'selected' : '' ?>>
                                    Large Animal Medicine</option>
                                <option value="Exotic Pet Care"
                                    <?= (htmlspecialchars($assis->expertise) ?? '') === 'Exotic Pet Care' ? 'selected' : '' ?>>
                                    Exotic Pet Care</option>
                                <option value="Wildlife Conservation"
                                    <?= (htmlspecialchars($assis->expertise) ?? '') === 'Wildlife Conservation' ? 'selected' : '' ?>>
                                    Wildlife Conservation</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Years of Experience</label>
                            <input type="number" class="form-input" name="experience"
                                value="<?= htmlspecialchars($assis->experience ?? 'N/A') ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label>Charge per Hour</label>
                            <input type="number" class="form-input" name="chargePerHour"
                                value="<?= htmlspecialchars($assis->chargePerHour ?? 'N/A') ?>" disabled>
                        </div>
                        <div class="form-group full-width">
                            <label>Languages Spoken</label>
                            <div class="language-checkboxes">
                                <label class="checkbox-container">
                                    <input type="checkbox" name="languageSpoken[]" value="English" disabled
                                        <?= in_array('English', $languageSpoken) ? 'checked' : '' ?>> English
                                    <span class="checkmark"></span>
                                </label>
                                <label class="checkbox-container">
                                    <input type="checkbox" name="languageSpoken[]" value="Sinhala" disabled
                                        <?= in_array('Sinhala', $languageSpoken) ? 'checked' : '' ?>> Sinhala
                                    <span class="checkmark"></span>
                                </label>
                                <label class="checkbox-container">
                                    <input type="checkbox" name="languageSpoken[]" value="Tamil" disabled
                                        <?= in_array('Tamil', $languageSpoken) ? 'checked' : '' ?>> Tamil
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Certifications</label>
                            <div class="certificate-container">
                                <div class="certificate-wrapper">
                                    <img src="<?= ROOT ?>/assets/images/vetAssistant/<?= $assis->certificate ?>"
                                        alt="Certification 1" class="certificate-image">
                                    <!-- <button class="remove-certificate-btn">
                                        <i class="fas fa-trash"></i>
                                    </button> -->
                                </div>
                                <!-- <div class="certificate-wrapper">
                                    <img src="cert2.jpg" alt="Certification 2" class="certificate-image">
                                    <button class="remove-certificate-btn">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                <button class="add-certificate-btn">
                                    <i class="fas fa-plus"></i> Add Certificate
                                </button> -->
                            </div>
                        </div>
                    </form>

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

                    <form class="form-grid" id="passwordChangeForm">
                        <div class="form-group">
                            <label>Current Password</label>
                            <input type="password" class="form-input" name="password" disabled>
                        </div>
                        <br />
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" class="form-input" name="newPassword" disabled>
                        </div>
                        <div class="form-group">
                            <label>Confirm New Password</label>
                            <input type="password" class="form-input" name="confirmPassword" disabled>
                        </div>
                    </form>

                    <div class="edit-actions passwordRest" id="passwordEditActions" style="display: none;">
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
                        <!-- <button class="edit-btn" id="settingsEditBtn">
                            <i class="fas fa-edit"></i> Edit
                        </button> -->
                    </h2>

                    <form class="form-grid" id="accountSettingsForm">
                        <div class="form-group">
                            <label>User ID</label>
                            <input type="text" class="form-input" value="<?= htmlspecialchars($assis->ID ?? 'N/A') ?>"
                                readonly>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-input"
                                value="<?= htmlspecialchars($assis->assistantID ?? 'N/A') ?>" readonly>
                        </div>

                        <div class="edit-actions" id="settingsEditActions" style="display: none;">
                            <button class="btn btn-secondary" id="settingsResetBtn">
                                <i class="fas fa-undo"></i> Reset
                            </button>
                            <button type="submit" class="btn btn-primary" id="settingsSaveBtn">
                                <i class="fas fa-save"></i> Save
                            </button>
                        </div>
                    </form>
                    <form action="<?= ROOT?>/Logout/index" method="POST">
                        <div class="form-group">
                            <label>Account Actions</label>
                            <div>
                                <button type="submit" name="send" class="edit-btn">
                                    <i class='bx bx-log-out'></i>Logout
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                        <!-- Danger Zone Section -->
                        <div id="dangerArea" class="section">
                            <h2 class="section-header">
                                Danger Zone
                            </h2>
                            <div class="alert-warning">
                                <strong>Warning:</strong>
                                <ul style="margin-left: 20px;">
                                    <li>Deleting your account will permanently remove all your data, including sessions
                                        and preferences. This action cannot be undone.</li>
                                    <li>You cannot delete your account if you have existing sessions.</li>
                                    <li>You cannot delete your account if you have created Appointments.</li>
                                    <li>You can delete your account only after the created sessions are completed.</li>
                                </ul>
                            </div>
                            <form class="form-grid" id="dangerSettingsForm">
                                <div class="delete-account-section">
                                        <p>Do you want to Delete this Account ?</p><br>
                                    <button class="btn btn-danger" id="deleteAccount">
                                        <i class="fas fa-trash-alt"></i><p>Delete Account</p>
                                    </button>
                                </div>    

                                <!-- Confirmation Modal -->
                                <div id="confirmationModal" class="modal" style="display: none;">
                                    <div class="modal-content">
                                        <h3>Confirm Account Deletion</h3>
                                        <p>Are you sure you want to delete your account? This action cannot be undone.</p>
                                        <input type="password" class="password" id="confirmPasswordInput" placeholder="Enter your password to confirm" required><br>
                                        
                                        <!-- Button Container -->
                                        <div class="button-container">
                                            <button id="confirmDeleteButton">Confirm</button>
                                            <button id="cancelDeleteButton">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('deleteAccount').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default form submission
        document.getElementById('confirmationModal').style.display = 'block'; // Show modal
    });

    document.getElementById('confirmDeleteButton').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default button action
        const password = document.getElementById('confirmPasswordInput').value;

        // Create a form data object
        const formData = new FormData();
        formData.append('password', password);

        // Send the data to the controller
        fetch('/VetiPlusMVC/public/assisProfile/deleteAccount', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // alert('Account deleted successfully.');
                showNotification('Account deleted successfully.', 'success');
                // Wait for 5 seconds before redirecting
                setTimeout(function() {
                    window.location.href = '<?= ROOT ?>/login'; // Redirect to login or home page
                }, 5000); // 5000 milliseconds = 5 seconds
            } else {
                showNotification(data.message || 'Failed to delete the account', 'error');
                // alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

    document.getElementById('cancelDeleteButton').addEventListener('click', function() {
    document.getElementById('confirmationModal').style.display = 'none'; // Hide modal
    });
    </script>
    <script src="<?= ROOT ?>/assets/js/vetAssistant/profile.js"></script>
    <script src="<?= ROOT ?>/assets/js/vetDoctor/jsnotification.js"></script>
</body>

</html>
