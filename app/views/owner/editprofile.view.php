<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <title>Edit Admin Profile</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/ownernav.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <?php require_once '../app/views/navbar/ownernav.php'; ?>

    <div class="profile-container">
        <div class="profile-sidebar">
            <img src="https://via.placeholder.com/200" alt="Admin Profile" class="profile-image">
            <h2>John Doe</h2>
            <p>Senior Admin</p>
            <p>john.doe@example.com</p>
        </div>
        <form class="edit-form">
            <h1>Edit Profile</h1>
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" value="John Doe" required>
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" value="john.doe@example.com" required>
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input type="tel" value="+1 (123) 456-7890" required>
            </div>
            <div class="form-group">
                <label>Address</label>
                <input type="text" value="123 Admin Street, Tech City" required>
            </div>
            <button type="submit" class="update-btn">Update Profile</button>
        </form>
    </div>
</body>

</html>