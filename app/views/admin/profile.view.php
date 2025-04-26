<?php
// Create an instance of the Notification controller
$notification = new Notification();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <title>VetiPlus - Admin Profile</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/adminnav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/common/notification.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/profile.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <?php require_once '../app/views/navbar/adminnav.php'; ?>
    <section class="home">
    <?php echo $notification->display(); ?>
        <div class="profile-container">
            <div class="profile-header">
                <img src="<?= ROOT ?>/assets/images/systemAdmin/user.png" alt="Admin Profile" class="profile-image">
                <h2><?= htmlspecialchars($admin[0]->name ?? '') ?></h2>
                <p>System Administrator</p>
            </div>

            <div>
                <div class="profile-details">
                    <div class="detail-card">
                        <i class='bx bx-envelope'></i>
                        <div class="info">
                            <h4>Email</h4>
                            <p><?= htmlspecialchars($admin[0]->email ?? '') ?></p>
                        </div>
                    </div>
                    <div class="detail-card">
                        <i class='bx bx-phone'></i>
                        <div class="info">
                            <h4>Phone</h4>
                            <p><?= htmlspecialchars($admin[0]->contactNumber ?? '') ?></p>
                        </div>
                    </div>
                    <div class="detail-card">
                        <i class='bx bx-home'></i>
                        <div class="info">
                            <h4>Address</h4>
                            <p><?= htmlspecialchars($admin[0]->address ?? '') ?></p>
                        </div>
                    </div>
                    <div class="detail-card">
                        <i class='bx bx-id-card'></i>
                        <div class="info">
                            <h4>NIC</h4>
                            <p><?= htmlspecialchars($admin[0]->NIC ?? '') ?></p>
                        </div>
                    </div>
                    <div class="detail-card">
                        <i class='bx bx-male-female'></i>
                        <div class="info">
                            <h4>Gender</h4>
                            <p><?= htmlspecialchars($admin[0]->gender ?? '') ?></p>
                        </div>
                    </div>
                </div>

                <div class="action-buttons">
                    <a href="#" class="btn btn-danger" onclick="openPasswordPopup()">
                        <i class='bx bx-lock'></i> Change Password
                    </a>
                </div>

                <!-- Popup Modal -->
                <div id="passwordPopup" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.5);">
                    <div style="background:white; width:400px; margin:100px auto; padding:20px; border-radius:10px; position:relative;">
                        <h3>Change Password</h3>

                        <!-- Notice the action attribute points to your controller function -->
                        <form action="<?= ROOT ?>/AdminProfile/changePassword?email=<?= ($admin[0]->email) ?>" method="POST">
                            <div>
                                <label>Current Password</label><br>
                                <input type="password" name="current_password" required>
                            </div>
                            <div style="margin-top:10px;">
                                <label>New Password</label><br>
                                <input type="password" name="new_password" required>
                            </div>
                            <div style="margin-top:10px;">
                                <label>Re-enter New Password</label><br>
                                <input type="password" name="confirm_password" required>
                            </div>
                            <div style="margin-top:20px; text-align:right;">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" onclick="closePasswordPopup()" class="btn btn-secondary">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>

                <script>
                    function openPasswordPopup() {
                        document.getElementById('passwordPopup').style.display = 'block';
                    }

                    function closePasswordPopup() {
                        document.getElementById('passwordPopup').style.display = 'none';
                    }
                </script>

            </div>
        </div>
    </section>
</body>

</html>