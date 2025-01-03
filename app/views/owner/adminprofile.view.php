<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <title>VetiPlus - Admin Profile</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/ownernav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/owner/adminprofile.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <?php require_once '../app/views/navbar/ownernav.php'; ?>
    <section class="home">
        <div class="profile-container">
            <div class="profile-header">
                <img src="https://via.placeholder.com/200" alt="Admin Profile" class="profile-image">
                <h2>John Doe</h2>
                <p>Senior Admin</p>
            </div>

            <div>
                <div class="profile-details">
                    <div class="detail-card">
                        <i class='bx bxs-envelope'></i>
                        <div class="info">
                            <h4>Email</h4>
                            <p>john.doe@example.com</p>
                        </div>
                    </div>
                    <div class="detail-card">
                        <i class='bx bxs-phone'></i>
                        <div class="info">
                            <h4>Phone</h4>
                            <p>+1 (123) 456-7890</p>
                        </div>
                    </div>
                    <div class="detail-card">
                        <i class='bx bxs-id-card'></i>
                        <div class="info">
                            <h4>NIC</h4>
                            <p>123456789V</p>
                        </div>
                    </div>
                    <div class="detail-card">
                        <i class='bx bxs-home'></i>
                        <div class="info">
                            <h4>Address</h4>
                            <p>123 Main Street</p>
                        </div>
                    </div>
                    <div class="detail-card">
                        <i class='bx bx-male-female'></i>
                        <div class="info">
                            <h4>Gender</h4>
                            <p>Male</p>
                        </div>
                    </div>
                    <div class="detail-card">
                        <i class='bx bxs-calendar'></i>
                        <div class="info">
                            <h4>Joined</h4>
                            <p>Jan 2023</p>
                        </div>
                    </div>
                </div>

                <div class="action-buttons">
                    <a href="<?= ROOT ?>/OwnerAddAdmin/editprofile" class="btn btn-primary">Edit Profile</a>
                    <a href="<?= ROOT ?>/OwnerAddAdmin/deleteprofile" class="btn btn-danger">Delete Profile</a>
                </div>
            </div>
        </div>
    </section>
</body>

</html>