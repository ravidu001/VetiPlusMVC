<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
  <title>VetiPlus - Appointments</title>
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/ownernav.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/owner/appointmentlist.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
  <?php require_once '../app/views/navbar/ownernav.php'; ?>
  <section class="home">
    <div class="appointment-container">
      <div class="appointments-header">
        <h1>Appointment Management</h1>
        <div class="search-filter">
        </div>
      </div>

      <table class="appointments-table">
        <thead>
          <tr>
            <th>Appointment ID</th>
            <th>Pet Name</th>
            <th>Date</th>
            <th>Time</th>
            <th>Doctor</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($owner as $data): ?>
            <tr>
              <td><?= $data->appointmentID ?? 'N/A' ?></td>
              <td><?= htmlspecialchars($data->petID ?? 'N/A') ?></td>
              <td><?= htmlspecialchars($data->bookedDateTime ?? 'N/A') ?></td>
              <td><?= htmlspecialchars($data->sessionID ?? 'N/A') ?></td>
              <td><?= htmlspecialchars($data->visitTime ?? 'N/A') ?></td>
              <td><?= htmlspecialchars($data->status ?? 'N/A') ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </section>
</body>

</html>