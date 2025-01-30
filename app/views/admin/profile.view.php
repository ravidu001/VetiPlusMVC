<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <title>VetiPlus - Admin Profile</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/adminnav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/profile.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <?php require_once '../app/views/navbar/adminnav.php'; ?>
    <section class="home">
        <div class="profile-container">
            <div class="profile-header">
                <img src="https://via.placeholder.com/200" alt="Admin Profile" class="profile-image">
                <h2>Ramesh Peshala</h2>
                <p>System Administrator</p>
            </div>

            <div>
                <div class="profile-details">
                    <div class="detail-card">
                        <i class='bx bx-envelope'></i>
                        <div class="info">
                            <h4>Email</h4>
                            <p>rameshpeshala@gmail.com</p>
                        </div>
                    </div>
                    <div class="detail-card">
                        <i class='bx bx-phone'></i>
                        <div class="info">
                            <h4>Phone</h4>
                            <p>076 216 3506</p>
                        </div>
                    </div>
                    <div class="detail-card">
                        <i class='bx bx-home'></i>
                        <div class="info">
                            <h4>Address</h4>
                            <p>419, Gangasirigama, Thissamaharama</p>
                        </div>
                    </div>
                    <div class="detail-card">
                        <i class='bx bx-id-card'></i>
                        <div class="info">
                            <h4>NIC</h4>
                            <p>200212702901</p>
                        </div>
                    </div>
                    <div class="detail-card">
                        <i class='bx bx-male-female'></i>
                        <div class="info">
                            <h4>Gender</h4>
                            <p>Male</p>
                        </div>
                    </div>
                </div>

                <div class="action-buttons">
                    <a href="#" class="btn btn-danger" onclick="changePassword()">
                        <i class='bx bx-lock'></i> Change Password
                    </a>
                </div>
            </div>
        </div>
    </section>
</body>

</html>