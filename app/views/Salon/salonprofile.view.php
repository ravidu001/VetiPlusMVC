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

    <!-- 
        <div class="fgh" id="fetch_data"></div> -->
    <div class="profile-container">
        <div class="sidebar">
            <div class="profile-header">
            <div class="profile-picture-container">
                        <div class="profile-picture-wrapper">
                            <img src="<?= ROOT ?>/assets/images/" alt="Profile Picture"
                                class="profile-picture" id="profilePicture">
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
                <?php 
                    if(isset($data['salon_details']))
                    {
                        $x = $data['salon_details'];
                ?>    
                <h2><?= $x->name?></h2>
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
                                    <input type="text" name="salonName" value="<?= $x->name?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Owner Name</label>
                                    <input type="text" name="ownerName" value="<?= $x->ownerName?>" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Contact Number</label>
                                    <input type="tel" name="phone" value="<?= $x->phoneNumber?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input type="email" name="email" value="<?= $x->salonID?>" disabled>
                                </div>
                            </div>
                            <div class="form-group full-width">
                                <label>Address</label>
                                <input type="text" name="address" value="<?= $x->address?>" disabled>
                            </div>
                            <div class="form-group full-width">
                                <label>Location</label>
                                <input type="text" name="location" value="<?= $x->GMapLocation?>" disabled>
                            </div>
                            <div class="form-group full-width">
                                <label>Description</label>
                                <input type="text" name="description" value="<?= $x->salonDetails?>" disabled>
                            </div>
                        </form>
                <?php       
                    } 
                ?>
            </section>

            <!-- Working Hours Section -->
            <section id="schedule" class="section">
                <div class="section-header">
                    <h1>Working Hours</h1>
                    <button class="edit-btn" id="editSchedule">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                </div>
                <?php 
                    if(isset($data['salon_details']))
                    {
                        $x = $data['salon_details'];
                ?> 
                    <form class="working-form">
                        <div class="schedule-grid">
                            <div class="day-schedule">
                                        <h4>Open Time</h4>
                                        <select name="openTime" disabled>
                                            <option value="00:00" <?= ($x->open_time == "00:00:00") ? "selected" : "" ?>>00:00</option>
                                            <option value="01:00" <?= ($x->open_time == "01:00:00") ? "selected" : "" ?>>01:00</option>
                                            <option value="02:00" <?= ($x->open_time == "02:00:00") ? "selected" : "" ?>>02:00</option>
                                            <option value="03:00" <?= ($x->open_time == "03:00:00") ? "selected" : "" ?>>03:00</option>
                                            <option value="04:00" <?= ($x->open_time == "04:00:00") ? "selected" : "" ?>>04:00</option>
                                            <option value="05:00" <?= ($x->open_time == "05:00:00") ? "selected" : "" ?>>05:00</option>
                                            <option value="06:00" <?= ($x->open_time == "06:00:00") ? "selected" : "" ?>>06:00</option>
                                            <option value="07:00" <?= ($x->open_time == "07:00:00") ? "selected" : "" ?>>07:00</option>
                                            <option value="08:00" <?= ($x->open_time == "08:00:00") ? "selected" : "" ?>>08:00</option>
                                            <option value="09:00" <?= ($x->open_time == "09:00:00") ? "selected" : "" ?>>09:00</option>
                                            <option value="10:00" <?= ($x->open_time == "10:00:00") ? "selected" : "" ?>>10:00</option>
                                            <option value="11:00" <?= ($x->open_time == "11:00:00") ? "selected" : "" ?>>11:00</option>
                                            <option value="12:00" <?= ($x->open_time == "12:00:00") ? "selected" : "" ?>>12:00</option>
                                            <option value="13:00" <?= ($x->open_time == "13:00:00") ? "selected" : "" ?>>13:00</option>
                                            <option value="14:00" <?= ($x->open_time == "14:00:00") ? "selected" : "" ?>>14:00</option>
                                            <option value="15:00" <?= ($x->open_time == "15:00:00") ? "selected" : "" ?>>15:00</option>
                                            <option value="16:00" <?= ($x->open_time == "16:00:00") ? "selected" : "" ?>>16:00</option>
                                            <option value="17:00" <?= ($x->open_time == "17:00:00") ? "selected" : "" ?>>17:00</option>
                                            <option value="18:00" <?= ($x->open_time == "18:00:00") ? "selected" : "" ?>>18:00</option>
                                            <option value="19:00" <?= ($x->open_time == "19:00:00") ? "selected" : "" ?>>19:00</option>
                                            <option value="20:00" <?= ($x->open_time == "20:00:00") ? "selected" : "" ?>>20:00</option>
                                            <option value="21:00" <?= ($x->open_time == "21:00:00") ? "selected" : "" ?>>21:00</option>
                                            <option value="22:00" <?= ($x->open_time == "22:00:00") ? "selected" : "" ?>>22:00</option>
                                            <option value="23:00" <?= ($x->open_time == "23:00:00") ? "selected" : "" ?>>23:00</option>
                                            <option value="24:00" <?= ($x->open_time == "24:00:00") ? "selected" : "" ?>>24:00</option>
                                        </select>
                                    </div>
                                    <div class="day-schedule">
                                        <h4>Close Time</h4>
                                        <select name="closeTime" disabled>
                                            <option value="00:00" <?= ($x->close_time == "00:00:00") ? "selected" : "" ?>>00:00</option>
                                            <option value="01:00" <?= ($x->close_time == "01:00:00") ? "selected" : "" ?>>01:00</option>
                                            <option value="02:00" <?= ($x->close_time == "02:00:00") ? "selected" : "" ?>>02:00</option>
                                            <option value="03:00" <?= ($x->close_time == "03:00:00") ? "selected" : "" ?>>03:00</option>
                                            <option value="04:00" <?= ($x->close_time == "04:00:00") ? "selected" : "" ?>>04:00</option>
                                            <option value="05:00" <?= ($x->close_time == "05:00:00") ? "selected" : "" ?>>05:00</option>
                                            <option value="06:00" <?= ($x->close_time == "06:00:00") ? "selected" : "" ?>>06:00</option>
                                            <option value="07:00" <?= ($x->close_time == "07:00:00") ? "selected" : "" ?>>07:00</option>
                                            <option value="08:00" <?= ($x->close_time == "08:00:00") ? "selected" : "" ?>>08:00</option>
                                            <option value="09:00" <?= ($x->close_time == "09:00:00") ? "selected" : "" ?>>09:00</option>
                                            <option value="10:00" <?= ($x->close_time == "10:00:00") ? "selected" : "" ?>>10:00</option>
                                            <option value="11:00" <?= ($x->close_time == "11:00:00") ? "selected" : "" ?>>11:00</option>
                                            <option value="12:00" <?= ($x->close_time == "12:00:00") ? "selected" : "" ?>>12:00</option>
                                            <option value="13:00" <?= ($x->close_time == "13:00:00") ? "selected" : "" ?>>13:00</option>
                                            <option value="14:00" <?= ($x->close_time == "14:00:00") ? "selected" : "" ?>>14:00</option>
                                            <option value="15:00" <?= ($x->close_time == "15:00:00") ? "selected" : "" ?>>15:00</option>
                                            <option value="16:00" <?= ($x->close_time == "16:00:00") ? "selected" : "" ?>>16:00</option>
                                            <option value="17:00" <?= ($x->close_time == "17:00:00") ? "selected" : "" ?>>17:00</option>
                                            <option value="18:00" <?= ($x->close_time == "18:00:00") ? "selected" : "" ?>>18:00</option>
                                            <option value="19:00" <?= ($x->close_time == "19:00:00") ? "selected" : "" ?>>19:00</option>
                                            <option value="20:00" <?= ($x->close_time == "20:00:00") ? "selected" : "" ?>>20:00</option>
                                            <option value="21:00" <?= ($x->close_time == "21:00:00") ? "selected" : "" ?>>21:00</option>
                                            <option value="22:00" <?= ($x->close_time == "22:00:00") ? "selected" : "" ?>>22:00</option>
                                            <option value="23:00" <?= ($x->close_time == "23:00:00") ? "selected" : "" ?>>23:00</option>
                                            <option value="24:00" <?= ($x->close_time == "24:00:00") ? "selected" : "" ?>>24:00</option>
                                        </select>
                                    </div>
                                    <div class="day-schedule">
                                        <h4>Time duration for the Slot(min)</h4>
                                        <select name="slotDuration" disabled>
                                            <option value="10" <?= ($x->slot_duration == 10) ? "selected" : "" ?>>10</option>
                                            <option value="20" <?= ($x->slot_duration == 20) ? "selected" : "" ?>>20</option>
                                            <option value="30" <?= ($x->slot_duration == 30) ? "selected" : "" ?>>30</option>
                                            <option value="40" <?= ($x->slot_duration == 40) ? "selected" : "" ?>>40</option>
                                            <option value="50" <?= ($x->slot_duration == 50) ? "selected" : "" ?>>50</option>
                                            <option value="60" <?= ($x->slot_duration == 60) ? "selected" : "" ?>>60</option>
                                            <option value="70" <?= ($x->slot_duration == 70) ? "selected" : "" ?>>70</option>
                                            <option value="80" <?= ($x->slot_duration == 80) ? "selected" : "" ?>>80</option>
                                            <option value="90" <?= ($x->slot_duration == 90) ? "selected" : "" ?>>90</option>
                                            <option value="100" <?= ($x->slot_duration == 100) ? "selected" : "" ?>>100</option>
                                            <option value="110" <?= ($x->slot_duration == 110) ? "selected" : "" ?>>110</option>
                                            <option value="120" <?= ($x->slot_duration == 120) ? "selected" : "" ?>>120</option>
                                        </select>
                                    </div>
                            </div>
                    </form>    
                <?php
                    }
                ?>    
            </section>

            <!-- Account Setting Section -->
            <section id="services" class="section">
                <form class="acount-form">
                    <div class="section-header">
                        <h1>Account Setting</h1>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="email">
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="email">
                    </div>
                    <br>
                    <p>Account Actions ?</p><br>
                    
                    <button class="btn-delete"> <i class="fas fa-trash-alt"> </i>Delete Account</button>
                </form>
            </section>

            <!-- Security Section -->
            <section id="security" class="section">
                <div class="section-header">
                    <h1>Account Security</h1>
                </div>
                <form class="security-form">
                    <div class="form-group">
                        <label>Current Password</label>
                        <input type="password" id="password" name="currentPassword" required>
                        <span class="toggle-password" onclick="togglePassword()">👁️</span>
                    </div>
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password"  id="password" name="newPassword" required>
                        <span class="toggle-password" onclick="togglePassword()">👁️</span>
                    </div>
                    <div class="form-group">
                        <label>Confirm New Password</label>
                        <input type="password"  id="password" name="confirmPassword" required>
                        <span class="toggle-password" onclick="togglePassword()">👁️</span>
                    </div>
                    <button type="submit" class="btn-primary"> <i class="fas fa-key"></i>Update Password</button>
                </form>
            </section>
        </div>
    </div>
    <script>
    const BASE_URL = "<?= ROOT ?>";
    </script>
    <script src="<?=ROOT?>/assets/js/salon/profile.js"></script>
    <script src="<?=ROOT?>/assets/js/login.js"></script>
</body>
</html>


