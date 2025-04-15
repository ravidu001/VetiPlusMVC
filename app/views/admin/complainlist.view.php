<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <title>Complaint Profile</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/adminnav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/complainlist.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <?php require_once '../app/views/navbar/adminnav.php'; ?>
    <section class="home">
        <div class="complain-container">
            <div class="profile-header">
                <img src="../../assets/images/user.png" alt="User Profile" class="profile-image">
                <div class="profile-details">
                    <div class="detail-item">
                        <label>Name</label>
                        <span>ramesh</span>
                    </div>
                    <div class="detail-item">
                        <label>Email</label>
                        <span><?= htmlspecialchars($admin->email ?? 'N/A') ?></span>
                    </div>
                    <div class="detail-item">
                        <label>Contact Number</label>
                        <span>0762163506</span>
                    </div>
                    <div class="detail-item">
                        <label>Date & Time</label>
                        <span><?= htmlspecialchars($admin->dateTime ?? 'N/A') ?></span>
                    </div>
                </div>
            </div>

            <div class="complaint-section">
                <div class="complaint-message">
                    <h2>Complaint Message</h2>
                    <p><?= htmlspecialchars($admin->issue ?? 'N/A') ?></p>
                </div>
                <div class="complaint-images">
                    <h2>Complaint Images</h2>
                    <div class="image-gallery">
                        <img src='<?= htmlspecialchars($admin->image ?? 'N/A') ?>' alt="Complaint Image 1">
                        <img src="../../assets/images/Owner/complain_image.png" alt="Complaint Image 2">
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>