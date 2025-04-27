<?php
// Create an instance of the Notification controller
$notification = new Notification();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <title>VetiPlus - Payments Dashboard</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/adminnav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/common/notification.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/payment.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <?php require_once '../app/views/navbar/adminnav.php'; ?>

    <section class="home">
        <?php echo $notification->display(); ?>
        <div class="main-container">
            <div class="payment-stats">
                <div class="stat-card">
                    <h3>Daily Transactions</h3>
                    <div class="stat-number">Rs. <?= htmlspecialchars($todayRevenue ?? '0') ?></div>
                </div>
                <div class="stat-card">
                    <h3>Total Pet Owner</h3>
                    <div class="stat-number"><?= htmlspecialchars($petownercount) ?></div>
                </div>
                <div class="stat-card">
                    <h3>Total Revenue</h3>
                    <div class="stat-number">Rs. <?= htmlspecialchars($total  ?? '0') ?></div>
                </div>
            </div>

            <div class="payment-search">
                <form class="search-form" action="<?= ROOT ?>/AdminPayment/paymentlist" method="post">
                    <div class="search-inputs">
                        <input type="text" name="petownerID" placeholder="Enter User ID">
                        <!-- <input type="text" placeholder="Enter Pet ID">
                        <input type="date"> -->
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
                        <?php if (isset($data['paymentdata'])) : ?>
                            <?php foreach ($data['paymentdata'] as $payment) : ?>
                                <tr>
                                    <td><?= $payment->paymentID ?></td>
                                    <td><?= $payment->petownerID ?></td>
                                    <td><?= $payment->appointmentID ?></td>
                                    <td>Rs. <?= $payment->amount ?></td>
                                    <td><?= date('Y-m-d', strtotime($payment->dateTime)) ?></td>
                                    <td><a href="<?= ROOT ?>/AdminPayment/paymentdetailpay/<?= $payment->petownerID ?>" class="btn-view btn">View</a></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="6">No payment data available.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</body>

</html>