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
                        <img src="<?= ROOT ?>/assets/images/systemAdmin/user.png" alt="Admin Profile">
                        <div>
                            <small class="text-muted">System Administrator</small>
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
                            <h2><?php echo htmlspecialchars($appointmentCount, ENT_QUOTES, 'UTF-8'); ?></h2>
                        </div>
                    </div>
                    <div class="stats-card">
                        <i class='bx bxs-dollar-circle icon'></i>
                        <div class="content">
                            <h3>Total Transactions</h3>
                            <h2>Rs.<?= htmlspecialchars($total ?? '0')  ?></h2>
                        </div>
                    </div>
                    <div class="stats-card">
                        <i class='bx bxs-store icon'></i>
                        <div class="content">
                            <h3>Total Salons</h3>
                            <h2><?php echo htmlspecialchars($salonCount, ENT_QUOTES, 'UTF-8'); ?></h2>
                        </div>
                    </div>
                </div>

                <!-- Dashboard Main Content -->
                <div class="dashboard-main">
                    <div class="chart-container">
                        <!-- <canvas id="appointmentChart"></canvas> -->
                         <h2>Account Type</h2>
                          <div>
                            <div class="stats-cards card">
                                <h3>Pet Account</h3>
                                <h4><?php echo htmlspecialchars($petcount, ENT_QUOTES, 'UTF-8'); ?></h4>
                            </div>
                             <div class="stats-cards card">
                                <h3>Pet Owner Account</h3>
                                <h4><?php echo htmlspecialchars($petownercount, ENT_QUOTES, 'UTF-8'); ?></h4>
                             </div>
                             <div class="stats-cards card">
                                <h3>Doctor Account</h3>
                                <h4><?php echo htmlspecialchars($doctorcount, ENT_QUOTES, 'UTF-8'); ?></h4>
                             </div>
                             <div class="stats-cards card">
                                <h3>Salon Account</h3>
                                <h4><?php echo htmlspecialchars($salonCount, ENT_QUOTES, 'UTF-8'); ?></h4>
                             </div>
                          </div>
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
                                <?php
                                if(is_array($complain)): ?>

                                    <?php foreach ($complain as $complaint): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($complaint->email) ?></td>
                                            <td><?= htmlspecialchars($complaint->issue) ?></td>
                                            <td><a href="<?= ROOT ?>/AdminComplain/complainlist?email=<?= ($complaint->email) ?>" class="view-button">View</a></td>
                                        </tr>
                                        <?php endforeach; ?>
                                     <?php endif?>
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
                                                    <h6 class="sub-card-title">Vet Doctor Pending Approvels</h6>
                                                    <p class="sub-card-text"><?php echo htmlspecialchars($pendingvetdoctorcount, ENT_QUOTES, 'UTF-8'); ?> Vet Doctor Registrations Pending </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sub-card-column">
                                            <div class="sub-card">
                                                <div class="sub-card-body">
                                                    <h6 class="sub-card-title"> Salon Pending Approvals</h6>
                                                    <p class="sub-card-text"><?php echo htmlspecialchars($pendingsaloncount, ENT_QUOTES, 'UTF-8'); ?> Salon Registrations Pending</p>
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