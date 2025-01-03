<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <title>Payment List | VetiPlus</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/ownernav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/owner/paymentlist.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <?php require_once '../app/views/navbar/ownernav.php'; ?>
    <section class="home">
        <div class="payment-container">
            <div class="payment-header">
                <img src="https://via.placeholder.com/120" alt="Profile" class="profile-image">
                <div class="profile-details">
                    <h2><i class='bx bx-user'></i> Holder's Name: Ramesh Peshala</h2>
                    <h2><i class='bx bx-credit-card'></i> Account Number: 061200140007057</h2>
                    <h2><i class='bx bx-calendar'></i> Expiry Date: 25/28</h2>
                    <h2><i class='bx bx-lock'></i> CVV: 199</h2>
                </div>
            </div>

            <div class="payment-table">
                <table>
                    <thead>
                        <tr>
                            <th>Payment ID</th>
                            <th>Appointment ID</th>
                            <th>Date</th>
                            <th>Doctor Name</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>220022</td>
                            <td>22001557</td>
                            <td>2024/04/07</td>
                            <td>Ravindu Piris</td>
                            <td>$150.00</td>
                        </tr>
                        <tr>
                            <td>220023</td>
                            <td>22001558</td>
                            <td>2024/04/08</td>
                            <td>Saman Kumar</td>
                            <td>$200.00</td>
                        </tr>
                        <tr>
                            <td>220024</td>
                            <td>22001559</td>
                            <td>2024/04/09</td>
                            <td>Nimal Silva</td>
                            <td>$180.00</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</body>

</html>