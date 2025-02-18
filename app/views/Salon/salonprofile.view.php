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
    <div class="pagecontent">
        <div class="profile-container">
            <div class="sidebar">
                <div class="profile-header">
                <div class="profile-picture-container">
                            <div class="profile-picture-wrapper">
                                <img src="<?= ROOT ?>/assets/images/" alt="Profile Picture"
                                    class="profile-picture" id="profilePicture">
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
                    <h2>Glamour Salon</h2>
                </div>
                <nav class="navigation">
                    <ul>
                        <li class="nav-item active" data-section="salon-info">
                            <i class="fas fa-store"></i>
                            <span>Salon Details</span>
                        </li>
                        <li class="nav-item" data-section="schedule">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Working Hours</span>
                        </li>
                        <li class="nav-item" data-section="services">
                            <i class="fas fa-cog"></i>
                            <span>Account Setting</span>
                        </li>
                        <li class="nav-item" data-section="security">
                            <i class="fas fa-lock"></i>
                            <span>Security</span>
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
                                <input type="text" name="salonName" disabled>
                            </div>
                            <div class="form-group">
                                <label>Owner Name</label>
                                <input type="text" name="ownerName" disabled>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Contact Number</label>
                                <input type="tel" name="phone" disabled>
                            </div>
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" name="email" disabled>
                            </div>
                        </div>
                        <div class="form-group full-width">
                            <label>Address</label>
                            <input type="text" name="address" disabled>
                        </div>
                        <div class="form-group full-width">
                            <label>Location</label>
                            <input type="text" name="location" disabled>
                        </div>
                        <div class="form-group full-width">
                            <label>Description</label>
                            <input type="text" name="description" disabled>
                        </div>
                    </form>
                </section>

                <!-- Working Hours Section -->
                <section id="schedule" class="section">
                    <div class="section-header">
                        <h1>Working Hours</h1>
                        <button class="edit-btn" id="editSchedule">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                    </div>
                    <div class="schedule-grid">
                        <div class="day-schedule">
                                    <h4>Open Time</h4>
                                    <select name="openTime" disabled>
                                        <option value="0.00">00:00</option>
                                        <option value="1.00">01:00</option>
                                        <option value="2.00">02:00</option>
                                        <option value="3.00">03:00</option>
                                        <option value="4.00">04:00</option>
                                        <option value="5.00">05:00</option>
                                        <option value="6.00">06:00</option>
                                        <option value="7.00">07:00</option>
                                        <option value="8.00">08:00</option>
                                        <option value="9.00">09:00</option>
                                        <option value="10.00">10:00</option>
                                        <option value="11.00">11:00</option>
                                        <option value="12.00">12:00</option>
                                        <option value="13.00">13:00</option>
                                        <option value="14.00">14:00</option>
                                        <option value="15.00">15:00</option>
                                        <option value="16.00">16:00</option>
                                        <option value="17.00">17:00</option>
                                        <option value="18.00">18:00</option>
                                        <option value="19.00">19:00</option>
                                        <option value="20.00">20:00</option>
                                        <option value="21.00">21:00</option>
                                        <option value="22.00">22:00</option>
                                        <option value="23.00">23:00</option>
                                        <option value="24.00">24:00</option>
                                    </select>
                                </div>
                                <div class="day-schedule">
                                    <h4>Close Time</h4>
                                    <select name="closeTime" disabled>
                                        <option value="0.00">00:00</option>
                                        <option value="1.00">01:00</option>
                                        <option value="2.00">02:00</option>
                                        <option value="3.00">03:00</option>
                                        <option value="4.00">04:00</option>
                                        <option value="5.00">05:00</option>
                                        <option value="6.00">06:00</option>
                                        <option value="7.00">07:00</option>
                                        <option value="8.00">08:00</option>
                                        <option value="9.00">09:00</option>
                                        <option value="10.00">10:00</option>
                                        <option value="11.00">11:00</option>
                                        <option value="12.00">12:00</option>
                                        <option value="13.00">13:00</option>
                                        <option value="14.00">14:00</option>
                                        <option value="15.00">15:00</option>
                                        <option value="16.00">16:00</option>
                                        <option value="17.00">17:00</option>
                                        <option value="18.00">18:00</option>
                                        <option value="19.00">19:00</option>
                                        <option value="20.00">20:00</option>
                                        <option value="21.00">21:00</option>
                                        <option value="22.00">22:00</option>
                                        <option value="23.00">23:00</option>
                                        <option value="24.00">24:00</option>
                                    </select>
                                </div>
                                <div class="day-schedule">
                                    <h4>Time duration for the Slot(min)</h4>
                                    <select name="slotDuration" disabled>
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                        <option value="40">40</option>
                                        <option value="50">50</option>
                                        <option value="60">60</option>
                                        <option value="70">70</option>
                                        <option value="80">80</option>
                                        <option value="90">90</option>
                                        <option value="100">100</option>
                                        <option value="110">110</option>
                                        <option value="120">120</option>
                                    </select>
                                </div>
                    </div>
                </section>

                <!-- Account Setting Section -->
                <section id="services" class="section">
                    <div class="section-header">
                        <h1>Account Setting</h1>
                    </div>
                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text" name="username">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email">
                    </div>
                    <br>
                    <p>Account Actions ?</p>
                    
                    <button class="btn-delete"><i class="fas fa-delete"></i>Delete Account</button>
                </section>

                <!-- Security Section -->
                <section id="security" class="section">
                    <div class="section-header">
                        <h1>Account Security</h1>
                    </div>
                    <form class="security-form">
                        <div class="form-group">
                            <label>Current Password</label>
                            <input type="password" name="currentPassword" required>
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" name="newPassword" required>
                        </div>
                        <div class="form-group">
                            <label>Confirm New Password</label>
                            <input type="password" name="confirmPassword" required>
                        </div>
                        <button type="submit" class="btn-update">Update Password</button>
                    </form>
                </section>
            </div>
        </div>
    </div>
   

    <script src="<?=ROOT?>/assets/js/salon/profile.js"></script>
</body>
</html>


