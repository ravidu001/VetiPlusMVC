<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <title>Edit Admin Profile</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/ownernav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/owner/editprofile.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <?php require_once '../app/views/navbar/ownernav.php'; ?>

    <div class="profile-container">
        <div class="profile-sidebar">
            <img src="https://via.placeholder.com/200" alt="Admin Profile" class="profile-image">
            <h2><?= htmlspecialchars($admin->name ?? 'N/A') ?></h2>
            <p>Senior Admin</p>
            <p><?= htmlspecialchars($admin->email ?? 'N/A') ?></p>
        </div>
        <form class="edit-form" action="<?= ROOT ?>/OwnerAddAdmin/adminupdate" method="post">
            <h1>Edit Profile</h1>
            <input type="hidden" name="email" value="<?= htmlspecialchars($admin->email ?? '') ?>">

            <div class="form-group">
                <label>Full Name</label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($admin->name ?? '') ?>" required>
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input type="tel" id="phone_number" name="phone_number" value="<?= htmlspecialchars($admin->contactNumber ?? '') ?>" required>
            </div>
            <div class="form-group">
                <label>Address</label>
                <input type="text" id="address" name="address" value="<?= htmlspecialchars($admin->address ?? '') ?>" required>
            </div>
            <button type="submit" name="submit" class="update-btn">Update Profile</button>
        </form>
    </div>
</body>

</html>