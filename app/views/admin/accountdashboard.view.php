<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <title>VetiPlus</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/adminnav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/accountdashboard.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <!-- Include navbar -->
    <?php require_once '../app/views/navbar/adminnav.php'; ?>

    <section class="home">
        <div class="dashboard-container">
            <div class="dashboard-header">
                <h1>Admin Account Management Dashboard</h1>
            </div>

            <div class="account-cards">
                <div class="account-card">
                    <i class="fas fa-users account-card-icon"></i>
                    <h2 class="account-card-title">User Accounts</h2>
                </div>
                <div class="account-card">
                    <i class="fas fa-user-md account-card-icon"></i>
                    <h2 class="account-card-title">Doctor Accounts</h2>
                </div>
                <div class="account-card">
                    <i class="fas fa-dog account-card-icon"></i>
                    <h2 class="account-card-title">Pet Accounts</h2>
                </div>
            </div>

            <div class="search-section">
                <div class="search-card">
                    <form class="search-form" action="<?= ROOT ?>/AdminAccountDashboard/petuserselect"method="GET">
                        <input type="email" id="email" name="email" placeholder="Search User ID">
                        <input type="password" name="admin_password" placeholder="Admin Password">
                        <button name="submit" type="submit">Search Users</button>
                    </form>
                </div>
                <div class="search-card">
                    <form class="search-form" action="<?= ROOT ?>/AdminAccountDashboard/doctorselect" method="GET">
                        <input type="email" id="email" name="email" placeholder="Search Doctor ID">
                        <input type="password" name="admin_password" placeholder="Admin Password">
                        <button  name="submit"  type="submit">Search Doctors</button>
                    </form>
                </div>
                <div class="search-card">
                    <form class="search-form" action="<?= ROOT ?>/AdminAccountDashboard/petselect" method="GET">
                        <input type="email" id="email" name="email" placeholder="Search Pet ID">
                        <input type="password" name="admin_password" placeholder="Admin Password">
                        <button  name="submit"  type="submit">Search Pets</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>