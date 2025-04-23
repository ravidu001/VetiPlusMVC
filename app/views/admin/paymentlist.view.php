<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
  <title>Payment List | VetiPlus</title>
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/adminnav.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/paymentlist.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
  <?php require_once '../app/views/navbar/adminnav.php'; ?>
  <section class="home">
    <div class="payment-container">
      <div class="payment-header">
        <img src="https://via.placeholder.com/120" alt="Profile" class="profile-image">
        <div class="profile-details">
          <h2><i class='bx bx-user'></i> Holder's Name: <?= htmlspecialchars($petownerName) ?></h2>
          <h2><i class='bx bx-credit-card'></i> Account Number: <?= htmlspecialchars($paymentinfoData[0]->cardNumber) ?></h2>
          <h2><i class='bx bx-calendar'></i> Expiry Date: <?= htmlspecialchars($paymentinfoData[0]->expiredmonth) ?>/<?= htmlspecialchars($paymentinfoData[0]->expiredyear) ?></h2>
          <h2><i class='bx bx-lock'></i> CVV: <?= htmlspecialchars($paymentinfoData[0]->CVV) ?></h2>
        </div>
      </div>

      <div class="payment-table">
        <table>
          <thead>
            <tr>
              <th>Payment ID</th>
              <th>Appointment ID</th>
              <th>Date</th>
              <!-- <th>Doctor Name</th> -->
              <th>Amount</th>
            </tr>
          </thead>
          <tbody>
            <?php if (isset($data['paymentdata'])) : ?>
              <?php foreach ($data['paymentdata'] as $payment) : ?>
                <tr>
                  <td><?= htmlspecialchars($payment->paymentID) ?></td>
                  <td><?= htmlspecialchars($payment->appointmentID) ?></td>
                  <td><?= htmlspecialchars($payment->dateTime) ?></td>
                  <!-- <td></td> -->
                  <td>Rs. <?= htmlspecialchars($payment->amount) ?></td>
                </tr>
              <?php endforeach; ?>
            <?php else : ?>
              <tr>
                <td colspan="5">No payment data available.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

      <div class="action-buttons">
        <button class="btn">
          <i class='bx bxs-report'></ ```html
              <i class='bx bxs-report'></i>
          Generate Report
        </button>
      </div>
    </div>
  </section>
</body>

</html>