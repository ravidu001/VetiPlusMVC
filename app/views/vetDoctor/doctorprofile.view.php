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
                    </div><br />
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
                    <!-- <button class="edit-btn" id="settingsEditBtn">
                        <i class="fas fa-edit"></i> Edit
                    </button> -->
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
                </div>

                <!-- <div class="edit-actions" id="settingsEditActions" style="display: none;">
                    <button class="btn btn-secondary" id="settingsResetBtn">
                        <i class="fas fa-undo"></i> Reset
                    </button>
                    <button class="btn btn-primary" id="settingsSaveBtn">
                        <i class="fas fa-save"></i> Save
                    </button>
                </div> -->
                <div class="form-group">
                    <label>Account Actions</label>
                    <div>
                        <button class="edit-btn">
                            <i class='bx bx-log-out'></i>Logout
                        </button>
                        <button class="btn-danger">
                            <i class='bx bx-trash'></i>Delete Account
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script src="<?= ROOT ?>/assets/js/vetDoctor/profile.js"></script>
</body>
</html>