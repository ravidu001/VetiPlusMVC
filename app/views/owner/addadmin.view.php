<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <title>VetiPlus - Add Admin</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/ownernav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/owner/addadmin.css">
</head>

<body>
    <?php require_once '../app/views/navbar/ownernav.php'; ?>
    <section class="home">
    <div class="container">
        <div class="admin-dashboard">
            <div class="admin-stats">
                <div class="stat-card">
                    <h2>Total Admins</h2>
                    <h3>24</h3>
                </div>
                <div class="stat-card">
                    <h2>Active Admins</h2>
                    <h3>14</h3>
                </div>
                <div class="stat-card">
                    <h2>Left Admins</h2>
                    <h3>03</h3>
                </div>
            </div>

            <div class="admin-actions">
            <form action="<?= ROOT ?>/OwnerAddAdmin/adminprofile" method="GET">
                <div class="search-admin">
                    <input  type="email" id="email" name="email" placeholder="Search Admin by Email">
                    <a class="search-btn" href="<?= ROOT ?>/OwnerAddAdmin/adminprofile" type="submit" name="submit">Search</a>
                </div>
                </form>
                <a href="<?= ROOT ?>/OwnerAddAdmin/adminregistration" class="add-admin-btn">Add New Admin</a>
            </div>
        </div>
    </div>
    </section>
</body>

</html>