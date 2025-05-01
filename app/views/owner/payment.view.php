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
            <div class="payment-dashboard">
                <div class="dashboard-card">
                    <i class='bx bx-trending-up icon'></i>
                    <div class="dashboard-card-content">
                        <h3>Daily Income</h3>
                        <p>Rs. <?= htmlspecialchars($todayRevenue ?? '0') ?></p> 
                    </div>
                </div>
                <div class="dashboard-card">
                    <i class='bx bx-line-chart icon'></i>
                    <div class="dashboard-card-content">
                        <h3>Total Income</h3>
                        <p>Rs.  <?= htmlspecialchars($total ?? '0') ?></p>
                    </div>
                </div>
            </div>

            <div class="payment-search">
                <form class="search-form"  action="<?= ROOT ?>/OwnerPayment/paymentlist" method="post">
                <div class="search-inputs">
                        <input type="text" name="petownerID" placeholder="Enter User ID">
                    </div>
                    <div class="search-button-row">
                    <button type="submit" class="search-btn">Search Transactions</button>
                    </div>
                </form>
            </div>

            <div class="payments-list">
                <table class="payments-table">
                    <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>User Name</th>
                            <th>Pet Name</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php 
                        if(is_array($data['paymentdata'])):
                            if (isset($data['paymentdata'])) : ?>
                                <?php foreach ($data['paymentdata'] as $payment) : ?>
                                    <tr>
                                        <td><?= $payment->paymentID ?></td>
                                        <td><?= $payment->petownerID ?></td>
                                        <td><?= $payment->appointmentID ?></td>
                                        <td>Rs. <?= $payment->amount ?></td>
                                        <td><?= date('Y-m-d', strtotime($payment->dateTime)) ?></td>
                                        <td><a href="<?= ROOT ?>/OwnerPayment/paymentdetailpay/<?= $payment->petownerID ?>" class="btn-view btn">View</a></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="6">No payment data available.</td>
                                </tr>
                            <?php endif; ?>
                            <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <script src="<?= ROOT ?>/assets/js/owner/ownerpaymentbarchart.js"></script>

</body>

</html>