<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <title>VetiPlus - Pet Profile</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/adminnav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/petaccount.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <?php require_once '../app/views/navbar/adminnav.php'; ?>
    <section class="home">
        
        <div class="profile-container">
            <div class="profile-header">
                <img src="https://placekitten.com/300/300" alt="Pet Profile" class="profile-image">
                <h2><?= htmlspecialchars($admin->name ?? 'N/A') ?></h2>
                <p><?= htmlspecialchars($admin->species ?? 'N/A') ?></p>
            </div>

            <div>
                <div class="profile-details">
                    <div class="detail-card">
                        <i class='bx bx-tag'></i>
                        <div class="info">
                            <h4>Pet ID</h4>
                            <p><?= htmlspecialchars($admin->petID ?? 'N/A') ?></p>
                        </div>
                    </div>
                    <div class="detail-card">
                        <i class='bx bx-male-sign'></i>
                        <div class="info">
                            <h4>Gender</h4>
                            <p><?= htmlspecialchars($admin->gender ?? 'N/A') ?></p>
                        </div>
                    </div>
                    <div class="detail-card">
                        <i class='bx bx-calendar'></i>
                        <div class="info">
                            <h4>DOB</h4>
                            <p><?= htmlspecialchars($admin->DOB ?? 'N/A') ?></p>
                        </div>
                    </div>
                    <div class="detail-card">
                        <i class='bx bxs-dog'></i>
                        <div class="info">
                            <h4>Breed</h4>
                            <p><?= htmlspecialchars($admin->breed ?? 'N/A') ?></p>
                        </div>
                    </div>
                    <div class="detail-card">
                        <i class='bx bxs-user-circle'></i>
                        <div class="info">
                            <h4>Pet Owner</h4>
                            <p><?= htmlspecialchars($admin->petOwnerID ?? 'N/A') ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>