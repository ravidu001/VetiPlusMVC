<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <title>VetiPlus - Pet Owner Profile</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/adminnav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/petuseraccount.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
    <?php require_once '../app/views/navbar/adminnav.php'; ?>

    <section class="home">
        <div class="profile-container">
            <div class="profile-header">
                <img src="https://via.placeholder.com/200" alt="Profile" class="profile-image">
                <h2><?= htmlspecialchars($admin->fullName ?? 'N/A') ?></h2>
                <p>Pet Owner</p>
            </div>

            <div>
                <div class="profile-details">
                    <div class="detail-card">
                        <i class='bx bx-envelope'></i>
                        <div class="info">   
                            <h4>Email</h4>
                            <p><?= htmlspecialchars($admin->petOwnerID ?? 'N/A') ?></p>
                        </div>
                    </div>
                    <div class="detail-card">
                        <i class='bx bx-phone'></i>
                        <div class="info">
                            <h4>Phone</h4>
                            <p><?= htmlspecialchars($admin->contactNumber ?? 'N/A') ?></p>
                        </div>
                    </div>
                    <div class="detail-card">
                        <i class='bx bx-home'></i>
                        <div class="info">
                            <h4>Address</h4>
                            <p><?= htmlspecialchars($admin->city ?? 'N/A') ?></p>
                        </div>
                    </div>
                    <div class="detail-card">
                        <i class='bx bx-id-card'></i>
                        <div class="info">
                            <h4>NIC</h4>
                            <p><?= htmlspecialchars($admin->NIC ?? 'N/A') ?></p>
                        </div>
                    </div>
                    <div class="detail-card">
                        <i class='bx bx-male-female'></i>
                        <div class="info">
                            <h4>Gender</h4>
                            <p><?= htmlspecialchars($admin->gender ?? 'N/A') ?></p>
                        </div>
                    </div>
                </div>

                <div class="action-buttons">
                    <a href="#" class="btn btn-primary" onclick="resetPassword()">
                        <i class='bx bx-reset'></i> Reset Password
                    </a>
                    <a href="#" class="btn btn-danger" onclick="deleteAccount()">
                        <i class='bx bx-trash'></i> Delete Account
                    </a>
                </div>

                <div class="stats-section">
                    <div class="stat-card">
                        <h3>40</h3>
                        <p>Total Appointments</p>
                    </div>
                    <div class="stat-card">
                        <h3>10</h3>
                        <p>Cancelled Appointments</p>
                    </div>
                    <div class="stat-card">
                        <h3>3</h3>
                        <p>Number of Pets</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>