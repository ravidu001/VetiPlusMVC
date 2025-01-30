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
                    <img src="https://via.placeholder.com/80" alt="User Profile">
                    <div class="user-profile-info">
                        <h3>Welcome Back, Ramesh Peshala</h3>
                        <p>Owner Dashboard</p>
                    </div>
                </div>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <i class='bx bxs-user-circle'></i>
                    <h3>Total Doctors</h3>
                    <p>1,200</p>
                </div>
                <div class="stat-card">
                    <i class='bx bxs-store'></i>
                    <h3>Total Salons</h3>
                    <p>120</p>
                </div>
                <div class="stat-card">
                    <i class='bx bxs-group'></i>
                    <h3> Total Clients</h3>
                    <p>5,000</p>
                </div>
                <div class="stat-card">
                    <i class='bx bxs-calendar'></i>
                    <h3>Appointments Today</h3>
                    <p>300</p>
                </div>
            </div>

            <div class="chart-container">
                <div class="chart-card">
                    <h2>Monthly Revenue</h2>
                    <canvas id="revenueChart"></canvas>
                </div>
                <div class="chart-card">
                    <h2>Client Growth</h2>
                    <canvas id="growthChart"></canvas>
                </div>
            </div>
        </div>
    </section>
    <script src="<?= ROOT ?>/assets/js/owner/ownerbarchart.js"></script>

</body>

</html>