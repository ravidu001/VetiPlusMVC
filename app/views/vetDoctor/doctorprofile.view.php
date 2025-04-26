<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veterinarian Profile</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/doctornav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/vetDoctor/profile.css">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?php require_once '../app/views/navbar/doctornav.php'; ?>
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
                            <img src="<?= ROOT ?>/assets/images/vetDoctor/<?= htmlspecialchars($doctor->profilePicture ?? 'N/A') ?>"
                                alt="Profile Picture" class="profile-picture" id="profilePicture">
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

                    <form class="form-grid" id="personalInfoForm">

                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" class="form-input" name="fullName"
                                value="<?= htmlspecialchars($doctor->fullName ?? 'N/A') ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-input" name="address"
                                value="<?= htmlspecialchars($doctor->address ?? 'N/A') ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="tel" class="form-input" name="contactNumber"
                                value="<?= htmlspecialchars($doctor->contactNumber ?? 'N/A') ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label>Date of Birth</label>
                            <input type="date" class="form-input" name="DOB"
                                value="<?= htmlspecialchars($doctor->DOB ?? 'N/A') ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <select class="form-input" name="gender" disabled>
                                <option value="Male" <?= ($doctor->gender ?? '') === 'Male' ? 'selected' : '' ?>>Male
                                </option>
                                <option value="Female" <?= ($doctor->gender ?? '') === 'Female' ? 'selected' : '' ?>>
                                    Female</option>
                                <option value="Other" <?= ($doctor->gender ?? '') === 'Other' ? 'selected' : '' ?>>Other
                                </option>
                            </select>

                        </div>
                    </form>

                    <div class="edit-actions" id="personalEditActions" style="display: none;">
                        <button class="btn btn-secondary" id="personalResetBtn">
                            <i class="fas fa-undo"></i> Reset
                        </button>
                        <button type="submit" class="btn btn-primary" id="personalSaveBtn">
                            <i class="fas fa-save"></i> Save
                        </button>
                        <!-- <input type="submit" class="btn btn-primary" id="personalSaveBtn" value="Save"> -->
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
                            <input type="text" name="lnumber" class="form-input"
                                value="<?= htmlspecialchars($doctor->lnumber ?? 'N/A') ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="specialization">Specialization</label>
                            <select id="specialization" class="form-input" name="specialization" disabled>
                                <option value="Small Animal Care"
                                    <?= (htmlspecialchars($doctor->specialization) ?? '') === 'Small Animal Care' ? 'selected' : '' ?>>
                                    Small Animal Care</option>
                                <option value="Large Animal Medicine"
                                    <?= (htmlspecialchars($doctor->specialization) ?? '') === 'Large Animal Medicine' ? 'selected' : '' ?>>
                                    Large Animal Medicine</option>
                                <option value="Exotic Pet Care"
                                    <?= (htmlspecialchars($doctor->specialization) ?? '') === 'Exotic Pet Care' ? 'selected' : '' ?>>
                                    Exotic Pet Care</option>
                                <option value="Wildlife Conservation"
                                    <?= (htmlspecialchars($doctor->specialization) ?? '') === 'Wildlife Conservation' ? 'selected' : '' ?>>
                                    Wildlife Conservation</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Years of Experience</label>
                            <input type="number" name="experience" class="form-input"
                                value="<?= htmlspecialchars($doctor->experience ?? 'N/A') ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label>Time Taken for a Treatment (minutes)</label>
                            <input type="number" name="timeSlot" class="form-input"
                                value="<?= htmlspecialchars($doctor->timeSlot ?? 'N/A') ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label>Certifications</label>
                            <div class="certificate-container">
                                <div class="certificate-wrapper">
                                    <img src="<?= ROOT ?>/assets/images/vetDoctor/<?= $doctor->doctorCertificate ?>"
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
                                </div> -->
                                <!-- <button class="add-certificate-btn">
                                    <i class="fas fa-plus"></i> Add Certificate
                                </button> -->
                            </div>
                        </div>
                    </form>

                    <div class="edit-actions" id="professionalEditActions" style="display: none;">
                        <button class="btn btn-secondary" id="professionalResetBtn">
                            <i class="fas fa-undo"></i> Reset
                        </button>
                        <button type="submit" class="btn btn-primary" id="professionalSaveBtn">
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
                            <input type="password" name="password" class="form-input" disabled>
                        </div><br />
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" name="newPassword" class="form-input" disabled>
                        </div>
                        <div class="form-group">
                            <label>Confirm New Password</label>
                            <input type="password" name="confirmPassword" class="form-input" disabled>
                        </div>
                    </form>
                    <div class="edit-actions" id="passwordEditActions" style="display: none;">
                        <button class="btn btn-secondary" id="passwordResetBtn">
                            <i class="fas fa-undo"></i> Reset
                        </button>
                        <button type="submit" class="btn btn-primary" id="passwordSaveBtn">
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
                            <input type="text" class="form-input" value="<?= htmlspecialchars($doctor->ID ?? 'N/A') ?>"
                                readonly>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-input"
                                value="<?= htmlspecialchars($doctor->doctorID ?? 'N/A') ?>" readonly>
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
        fetch('/VetiPlusMVC/public/DoctorProfile/deleteAccount', {
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
            <script src="<?= ROOT ?>/assets/js/vetDoctor/profile.js" defer></script>
            <script src="<?= ROOT ?>/assets/js/vetDoctor/jsnotification.js"></script>
</body>

</html>