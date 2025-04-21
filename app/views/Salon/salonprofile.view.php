<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Salon Profile Editor</title>
        <link rel="stylesheet" href="<?=ROOT?>/assets/css/salon/salonprofile.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    </head>

    <body>
        <?php include __DIR__ . '/../navbar/salonnav.php'; ?>

        <div class="home">
                <?php 
                    if(isset($data['salon_details']))
                    {
                        $x = $data['salon_details'];

                        $profile_picture = $x->profilePicture;
                        $profilePicture = $profile_picture ? ROOT.'/'. $profile_picture : "assets/images/common/defaultProfile.png";
                ?>   

                <!-- 
                    <div class="fgh" id="fetch_data"></div> -->
                <div class="profile-container">
                    <div class="sidebar">
                        <div class="profile-header">
                        <div class="profile-picture-container">
                                    <div class="profile-picture-wrapper">
                                        <img src="<?= $profilePicture ?>" alt="Profile Picture" class="profile-picture" id="profilePicture">
                                        <div class="profile-picture-overlay">
                                            <input type="file" id="profilePictureUpload" accept="image/*" class="file-input" hidden>
                                            <label for="profilePictureUpload" class="upload-btn">
                                                <i class="fas fa-camera"></i>
                                            </label>
                                            <button class="remove-btn" id="removeProfilePicture">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            
                            <h2><?= $x->name?></h2>
                        </div>
                        <nav class="navigation">
                            <ul>
                                <li class="nav-item active" data-section="salon-info">
                                    <i class="fas fa-store"></i>
                                    <span>Salon Details</span>
                                </li>
                                <li class="nav-item" data-section="security">
                                    <i class="fas fa-lock"></i>
                                    <span>Security</span>
                                </li>
                                <li class="nav-item" data-section="account">
                                    <i class="fas fa-cog"></i>
                                    <span>Account</span>
                                </li>
                            </ul>
                        </nav>
                    </div>

                    <div class="content">
                        <!-- Salon Info Section -->
                        <section id="salon-info" class="section active">
                            <div class="section-header">
                                <h1>Salon Information</h1>
                                <button class="edit-btn" id="editSalonInfo">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                            </div>
                                    <form class="salon-form">
                                        <div class="form-row">
                                            <div class="form-group">
                                                <label>Salon Name</label>
                                                <input type="text" name="name" value="<?= ($x->name) ?? 'N/A'?>" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>Owner Name</label>
                                                <input type="text" name="ownerName" value="<?= ($x->ownerName) ?? 'N/A' ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group">
                                                <label>Contact Number</label>
                                                <input type="tel" name="phoneNumber" value="<?= ($x->phoneNumber) ?? 'N/A' ?>" disabled>
                                            </div>
                                            <!-- <div class="form-group">
                                                <label>Email Address</label>
                                                <input type="email" name="salonID" value="<>" disabled>
                                            </div> -->
                                        </div>
                                        <div class="form-group full-width">
                                            <label>Address</label>
                                            <input type="text" name="address" value="<?= ($x->address) ?? 'N/A' ?>" disabled>
                                        </div>
                                        <div class="form-group full-width">
                                            <label>Location</label>
                                            <input type="text" name="GMapLocation" value="<?= ($x->GMapLocation) ?? 'N/A' ?>" disabled>
                                        </div>
                                        <div class="form-group full-width">
                                            <label>Salon Type</label>
                                            <input type="text" name="salonType" value="<?= ($x->salonType) ?? 'N/A' ?>" disabled>
                                        </div>
                                        <div class="form-group full-width">
                                            <label>Description</label>
                                            <input type="text" name="salonDetails" value="<?= ($x->salonDetails) ?? 'N/A' ?>" disabled>
                                        </div>
                                    </form>
                            <?php       
                                } 
                            ?>
                        </section>

                        <!-- Account Setting Section -->
                        <section id="account" class="section">
                            <form class="acount-form">
                                <div class="section-header">
                                    <h1>Account Setting</h1>
                                </div>
                                <div class="alert alert-warning">
                                    <strong>Warning:</strong> 
                                    <ul>
                                        <li>Deleting your account will permanently remove all your data, including bookings and preferences. This action cannot be undone.</li>
                                        <li>You cannot delete your account if you have existing bookings.</li>
                                        <li>You cannot delete your account if you have created slots.</li>
                                        <li>You can delete your account only after the end date of your created slots.</li>
                                    </ul>
                                </div>
                                <!-- <div class="form-group">
                                    <label>Current Password</label>
                                    <input type="password" name="enterPassword" id="enterPassword">
                                </div> -->
                                <br>
                                <div class="delete-account-section">
                                        <p>Do you want to Delete this Account ?</p><br>
                                    <button class="btn-delete" id="deleteAccount">
                                        <i class="fas fa-trash-alt"></i><p>Delete Account</p>
                                    </button>
                                </div>    

                                <!-- Confirmation Modal -->
                                <div id="confirmationModal" class="modal" style="display: none;">
                                    <div class="modal-content">
                                        <h3>Confirm Account Deletion</h3>
                                        <p>Are you sure you want to delete your account? This action cannot be undone.</p>
                                        <input type="password" class="password" id="confirmPasswordInput" placeholder="Enter your password to confirm" required><br>
                                        <button id="confirmDeleteButton">Confirm</button>
                                        <button id="cancelDeleteButton">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </section>

                        <!-- Security Section -->
                        <section id="security" class="section">
                            <div class="section-header">
                                <h1>Change Password</h1>
                                <button class="edit-btn" id="passwordEditBtn">
                                        <i class="fas fa-edit"></i> Edit
                                </button>
                            </div>
                            <form class="security-form">
                                <div class="form-group">
                                    <label>Current Password</label>
                                    <div style="display: flex;">
                                        <input type="password" id="currentPassword" name="currentPassword" disabled>
                                        <span class="toggle-password" onclick="togglePassword(event)">👁️</span>
                                    </div>    
                                </div>
                                <div class="form-group">
                                    <label>New Password</label>
                                    <div style="display: flex;">
                                        <input type="password"  id="newPassword" name="newPassword" disabled>
                                        <span class="toggle-password" onclick="togglePassword(event)">👁️</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Confirm New Password</label>
                                    <div style="display: flex;">
                                        <input type="password"  id="confirmPassword" name="confirmPassword" disabled>
                                        <span class="toggle-password" onclick="togglePassword(event)">👁️</span>
                                    </div>
                                </div>
                                <div class="edit-actions" id="passwordEditActions" style="display: none;">
                                    <button class="btn btn-secondary" id="passwordResetBtn">
                                        <i class="fas fa-undo"></i> Reset
                                    </button>
                                    <button type="submit" class="btn btn-primary" id="passwordSaveBtn">
                                        <i class="fas fa-save"></i> Save
                                    </button>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
                <script>
                    const BASE_URL = "<?=ROOT?>";
                </script>
                <script src="<?=ROOT?>/assets/js/salon/profile.js"></script>
                <!-- <script src="<?=ROOT?>/assets/js/login.js"></script> -->
        </div>
    </body>
</html>
  