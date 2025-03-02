<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <title>VetiPlus | Admin Dashboard</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/adminnav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/adminhome.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>
    <?php require_once '../app/views/navbar/adminnav.php'; ?>
    <div class="home">
        <div class="container-fluid">
            <div class="dashboard-wrapper">
                <!-- User Header -->
                <div class="user-header">
                    <div class="user-profile">
                        <img src="https://via.placeholder.com/60" alt="Admin Profile">
                        <div>
                            <h4 class="mb-0">Ramesh Peshala</h4>
                            <small class="text-muted">System Administrator</small>
                        </div>
                    </div>
                    <div class="search-container">
                        <i class='bx bx-search'></i>
                        <input type="text" placeholder="Search dashboard...">
                        <div class="notifications-badge">
                            <i class='bx bx-bell'></i>
                        </div>
                    </div>
                </div>

                <!-- Stats Grid -->
                <div class="stats-grid">
                    <div class="stats-card">
                        <i class='bx bxs-user-account icon'></i>
                        <div class="content">
                            <h3>Total User Accounts</h3>
                            <h2><?php echo htmlspecialchars($userCount, ENT_QUOTES, 'UTF-8'); ?></h2>
                        </div>
                    </div>
                    <div class="stats-card">
                        <i class='bx bx-calendar-plus icon'></i>
                        <div class="content">
                            <h3>Total Appointments</h3>
                            <h2>4,561</h2>
                        </div>
                    </div>
                    <div class="stats-card">
                        <i class='bx bxs-dollar-circle icon'></i>
                        <div class="content">
                            <h3>Total Transactions</h3>
                            <h2>$234,567</h2>
                        </div>
                    </div>
                    <div class="stats-card">
                        <i class='bx bxs-store icon'></i>
                        <div class="content">
                            <h3>Total Salons</h3>
                            <h2>102</h2>
                        </div>
                    </div>
                </div>

                <!-- Dashboard Main Content -->
                <div class="dashboard-main">
                    <div class="chart-container">
                        <canvas id="appointmentChart"></canvas>
                    </div>
                    <div class="complaints-container">
                        <h2>Recent Complaints</h2>
                        <table class="table complaints-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Message</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>John Doe</td>
                                    <td>Service delay issue</td>
                                    <td><button class="view-button">View</button></td>
                                </tr>
                                <tr>
                                    <td>Jane Smith</td>
                                    <td>Billing concern</td>
                                    <td><button class="view-button">View</button></td>
                                </tr>
                                <tr>
                                    <td>Mike Johnson</td>
                                    <td>Appointment not found</td>
                                    <td><button class="view-button">View</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="analytics-container">
                    <div class="analytics-row">
                        <div class="analytics-column">
                            <div class="main-card">
                                <div class="card-header">
                                    <h5 class="card-header-title">Additional Analytics</h5>
                                </div>
                                <div class="card-content">
                                    <div class="sub-cards-row">
                                        <div class="sub-card-column">
                                            <div class="sub-card">
                                                <div class="sub-card-body">
                                                    <h6 class="sub-card-title">Recent Registrations</h6>
                                                    <p class="sub-card-text">120 New Users This Month</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sub-card-column">
                                            <div class="sub-card">
                                                <div class="sub-card-body">
                                                    <h6 class="sub-card-title">Pending Approvals</h6>
                                                    <p class="sub-card-text">15 Salon Registrations Pending</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sub-card-column">
                                            <div class="sub-card">
                                                <div class="sub-card-body">
                                                    <h6 class="sub-card-title">System Health</h6>
                                                    <p class="sub-card-text">All Systems Operational</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= ROOT ?>/assets/js/admin/adminbarchart.js"></script>

</body>

</html>