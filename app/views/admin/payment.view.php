<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <title>VetiPlus - Payments Dashboard</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/adminnav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/payment.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <?php require_once '../app/views/navbar/adminnav.php'; ?>

    <section class="home">
        <div class="main-container">
            <!-- <div class="payment-stats">
                <div class="stat-card">
                    <h3>Daily Transactions</h3>
                    <div class="stat-number">Rs. 25,000</div>
                </div>
                <div class="stat-card">
                    <h3>Total Users</h3>
                    <div class="stat-number">1,256</div>
                </div>
                <div class="stat-card">
                    <h3>Total Revenue</h3>
                    <div class="stat-number">Rs. 500,000</div>
                </div>
            </div> -->

            <div class="payment-search">
                <form class="search-form" action="<?= ROOT ?>/AdminPayment/paymentlist" method="post">
                    <div class="search-inputs">
                        <input type="text" placeholder="Enter User ID">
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
                        <tr>
                            <td>TXN001</td>
                            <td>John Doe</td>
                            <td>Buddy</td>
                            <td>Rs. 1,500</td>
                            <td>2023-10-01</td>
                            <td class="action-buttons">
                                <button class="btn btn-view">View</button>
                            </td>
                        </tr>
                        <tr>
                            <td>TXN002</td>
                            <td>Jane Smith</td>
                            <td>Max</td>
                            <td>Rs. 2,000</td>
                            <td>2023-10-01</td>
                            <td class="action-buttons">
                                <button class="btn btn-view">View</button>
                            </td>
                        </tr>
                        <tr>
                            <td>TXN003</td>
                            <td>Emily Johnson</td>
                            <td>Charlie</td>
                            <td>Rs. 1,200</td>
                            <td>2023-10-01</td>
                            <td class="action-buttons">
                                <button class="btn btn-view">View</button>
                            </td>
                        </tr>
                        <tr>
                            <td>TXN004</td>
                            <td>Michael Brown</td>
                            <td>Lucy</td>
                            <td>Rs. 1,800</td>
                            <td>2023-10-02</td>
                            <td class="action-buttons">
                                <button class="btn btn-view">View</button>
                            </td>
                        </tr>
                        <tr>
                            <td>TXN005</td>
                            <td>Sarah Wilson</td>
                            <td>Rocky</td>
                            <td>Rs. 2,500</td>
                            <td>2023-10-02</td>
                            <td class="action-buttons">
                                <button class="btn btn-view">View</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</body>

</html>