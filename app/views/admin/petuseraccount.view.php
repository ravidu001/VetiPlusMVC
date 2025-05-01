<?php
$notification = new Notification();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <title>VetiPlus - Pet Owner Profile</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/adminnav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/common/notification.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/petuseraccount.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
    <?php require_once '../app/views/navbar/adminnav.php'; ?>

    <section class="home">
        <?php echo $notification->display(); ?>
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
                    <a href="<?= ROOT ?>/AdminAccountDashboard/accept?petOwnerID=<?= urlencode($admin->petOwnerID) ?>" class="btn btn-primary">
                        <i class='bx bx-reset'></i> Reset Password
                    </a>
                    <a href="#" class="btn btn-danger" onclick="deleteAccount()">
                        <i class='bx bx-trash'></i> Delete Account
                    </a>
                </div>
            </div>
        </div>
        <div id="deleteModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Confirm Delete</h2>
                <p>Are you sure you want to delete this pet owner account?</p>
                <div class="modal-details">
                    <p><strong>Full Name:</strong> <?= htmlspecialchars($admin->fullName ?? 'N/A') ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($admin->petOwnerID ?? 'N/A') ?></p>
                    <p><strong>Phone:</strong> <?= htmlspecialchars($admin->contactNumber ?? 'N/A') ?></p>
                </div>
                <div class="modal-actions">
                    <a href="<?= ROOT ?>/AdminAccountDashboard/delete?petOwnerID=<?= urlencode($admin->petOwnerID) ?>" class="btn btn-danger">Yes, Delete</a>
                    <button onclick="closeModal()" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
        </div>

    </section>

</body>
<script>
    function deleteAccount() {
        document.getElementById('deleteModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('deleteModal').style.display = 'none';
    }

    window.onclick = function(event) {
        const modal = document.getElementById('deleteModal');
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

</html>