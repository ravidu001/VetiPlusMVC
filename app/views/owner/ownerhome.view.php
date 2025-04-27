<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <title>VetiPlus - Owner Dashboard</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/ownernav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/owner/ownerhome.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <?php require_once '../app/views/navbar/ownernav.php'; ?>
    <section class="home">
        <div class="dashboard">
            <div class="dashboard-header">
                <div class="user-profile">
                    <img src="<?= ROOT ?>/assets/images/systemAdmin/user.png" alt="User Profile">
                    <div class="user-profile-info">
                        <h3>Welcome Back</h3>
                        <p>Owner Dashboard</p>
                    </div>
                </div>
            </div>
            <h1>Account Type</h1>
            <div class="stats-grid">
                <div class="stat-card">
                    <i class='bx bxs-user-circle'></i>
                    <h3>Total Doctors</h3>
                    <p><?php echo htmlspecialchars($doctorcount, ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
                <div class="stat-card">
                    <i class='bx bxs-store'></i>
                    <h3>Total Salons</h3>
                    <p><?php echo htmlspecialchars($saloncount, ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
                <div class="stat-card">
                    <i class='bx bxs-group'></i>
                    <h3> Total Clients</h3>
                    <p><?php echo htmlspecialchars($petownercount, ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
                <div class="stat-card">
                    <i class='bx bxs-user-account icon'></i>
                    <h3>Total Pets</h3>
                    <p><?php echo htmlspecialchars($petcount, ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
            </div>
            <h1>Payment and Appointment details</h1>
            <div class="stats-grid">
                <div class="stat-card">
                    <i class='bx bx-line-chart icon'></i>
                    <h3>Total Revenue</h3>
                    <p>Rs. <?= htmlspecialchars($total ?? '0') ?></p>
                </div>
                <div class="stat-card">
                    <i class='bx bx-trending-up icon'></i>
                    <h3>Daily Revenue</h3>
                    <p>Rs. <?= htmlspecialchars($todayRevenue ?? '0') ?></p>
                </div>
                <div class="stat-card">
                    <i class='bx bx-calendar-x icon'></i>
                    <h3> Daily Appointment</h3>
                    <p><?php echo htmlspecialchars($petownercount, ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
                <div class="stat-card">
                    <i class='bx bxs-calendar'></i>
                    <h3>Total Appointments</h3>
                    <p><?php echo htmlspecialchars($appointmentcount, ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
            </div>
        </div>
    </section>
    <script src="<?= ROOT ?>/assets/js/owner/ownerbarchart.js"></script>

</body>

</html>