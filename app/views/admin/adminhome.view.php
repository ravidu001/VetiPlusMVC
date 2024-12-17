<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <title>VetiPlus</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/adminnav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/adminhome.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <!-- Include navbar -->
    <?php require_once '../app/views/navbar/adminnav.php'; ?>

    <section class="home">
        <div class="home-before">
            <div class="home-1">
                <div class="home-inside">
                    <img src="../../assets/images/user.png" alt="">
                    <div>
                        <h1>Ramesh Peshala</h1>
                        <h2>System Admin</h2>
                    </div>
                </div>
                <div class="home-inside-right">
                    <img src="../../assets/images/image_9.png" alt="">
                </div>
            </div>
            <div class="home-search">
                <div class="searchbar">
                    <i class='bx bx-search-alt-2 icon'></i>
                    <input class="search" type="text" placeholder="Search...">
                    <i class='bx bx-bell icon'></i>
                </div>
            </div>
            <div class="home-after">
                <div class="home-after-inside">
                    <i class='bx bxs-user-account icon'></i>
                    <div>
                        <h3>Total Account</h3>
                        <h1>2345</h1>
                    </div>
                </div>
                <div class="home-after-inside">
                    <i class='bx bx-calendar-plus icon'></i>
                    <div>
                        <h3>Total Appointment</h3>
                        <h1>4561</h1>
                    </div>
                </div>

                <div class="home-after-inside">
                    <i class='bx bxs-dollar-circle icon'></i>
                    <div>
                        <h3>Total Transactions</h3>
                        <h1>234</h1>
                    </div>
                </div>
                <div class="home-after-inside">
                    <i class='bx bxs-store icon'></i>
                    <div>
                        <h3>Total Salon </h3>
                        <h1>102</h1>
                    </div>
                </div>
            </div>
            <div class="home-down">
                <div class="home-chart">
                    <canvas id="barChart"></canvas>
                    <script src="<?= ROOT ?>/assets/js/admin/adminbarchart.js"></script>
                </div>
                <div class="home-down-message">
                    <table>
                        <thead>
                            <tr>
                                <th>User's Name</th>
                                <th>Complain Message</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr onclick="window.location.href='complain_profile.php'">
                                <td>Ramesh Peshala</td>
                                <td>It is a long established fact that a reader will be...</td>
                                <td>2022/05/15</td>
                            </tr>
                            <tr>
                                <td>Ramesh Peshala</td>
                                <td>It is a long established fact that a reader will be...</td>
                                <td>2022/05/15</td>
                            </tr>
                            <tr>
                                <td>Ramesh Peshala</td>
                                <td>It is a long established fact that a reader will be...</td>
                                <td>2022/05/15</td>
                            </tr>
                            <tr>
                                <td>Ramesh Peshala</td>
                                <td>It is a long established fact that a reader will be...</td>
                                <td>2022/05/15</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</body>

</html>