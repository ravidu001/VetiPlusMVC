<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <title>VetiPlus - Owner Payment Dashboard</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/ownernav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/owner/payment.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <?php require_once '../app/views/navbar/ownernav.php'; ?>
    <section class="home">
        <div class="container">
            <!-- Payment Dashboard Cards -->
            <div class="payment-dashboard">
                <div class="dashboard-card">
                    <i class='bx bx-trending-up icon'></i>
                    <div class="dashboard-card-content">
                        <h3>Daily Income</h3>
                        <p>Rs. 15,000</p>
                    </div>
                </div>
                <div class="dashboard-card">
                    <i class='bx bx-line-chart icon'></i>
                    <div class="dashboard-card-content">
                        <h3>Total Income</h3>
                        <p>Rs. 1,000,000</p>
                    </div>
                </div>
                <div class="dashboard-card">
                    <i class='bx bx-trending-down icon'></i>
                    <div class="dashboard-card-content">
                        <h3>Monthly Expenses</h3>
                        <p>Rs. 9,000</p>
                    </div>
                </div>
                <div class="dashboard-card">
                    <i class='bx bx-chart icon'></i>
                    <div class="dashboard-card-content">
                        <h3>Total Expenses</h3>
                        <p>Rs. 100,000</p>
                    </div>
                </div>
            </div>

            <!-- Search Section -->
            <div class="payment-search">
                <form class="search-form">
                    <div class="search-inputs">
                        <input type="text" placeholder="Enter User ID">
                        <input type="text" placeholder="Enter Pet ID">
                        <input type="date">
                    </div>
                    <div class="search-button-row">
                        <button type="submit">Search</button>
                    </div>
                </form>
            </div>

            <!-- Chart Section -->
            <div class="payment-chart">
                <h2>Monthly Income and Expenses</h2>
                <canvas id="paymentChart"></canvas>
            </div>
        </div>
    </section>
    <script src="<?= ROOT ?>/assets/js/owner/ownerpaymentbarchart.js"></script>

</body>

</html>