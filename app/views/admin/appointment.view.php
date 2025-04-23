<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <title>VetiPlus - Appointments Dashboard</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/adminnav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/appointment.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
    <?php require_once '../app/views/navbar/adminnav.php'; ?>

    <section class="home">
        <div class="main-container">
            <!-- <div class="appointment-stats">
                <div class="stat-card">
                    <h3>Daily Appointments</h3>
                    <div class="stat-number">345</div>
                </div>
                <div class="stat-card">
                    <h3>Canceled Appointments</h3>
                    <div class="stat-number">23</div>
                </div>
                <div class="stat-card">
                    <h3>Total Appointments</h3>
                    <div class="stat-number">2,356</div>
                </div>
            </div> -->

            <!-- <div class="appointment-search">
                <form class="search-form" action="<?= ROOT ?>/AdminAppointment/appointmentlist" method="GET">
                    <div class="search-inputs">
                        <input type="text" name="user_id" placeholder="Enter User ID">
                        <input type="text" name="pet_id" placeholder="Enter Pet ID">
                        <input type="date" name="appointment_date">
                    </div>
                    <button type="submit" class="search-btn">Search Appointments</button>
                </form>

            </div> -->
            <div class="appointment-search">
                <form class="search-form" action="<?= ROOT ?>/AdminAppointment/appointmentlist" method="GET">
                    <div class="search-inputs">
                        <input type="text" name="petownerid" placeholder="Enter User ID">
                        <!-- <input type="text" name="petid" placeholder="Enter Pet ID">  -->
                        <button type="submit" name="submit" value="1" class="search-btn">Search Appointments</button>
                    </div>
                </form>
            </div>

            <div class="appointments-list">
            <table class="appointments-table">
        <thead>
          <tr>
            <th>Appointment ID</th>
            <th>Pet Name</th>
            <th>Date and Time</th>
            <th>Session ID</th>
            <th>Visit Time</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($admin as $data): ?>
            <tr>
              <td><?= $data->appointmentID ?? 'N/A' ?></td>
              <td><?= htmlspecialchars($data->petID ?? 'N/A') ?></td>
              <td><?= htmlspecialchars($data->bookedDateTime ?? 'N/A') ?></td>
              <td><?= htmlspecialchars($data->sessionID ?? 'N/A') ?></td>
              <td><?= htmlspecialchars($data->visitTime ?? 'N/A') ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
            </div>
        </div>
    </section>
</body>

</html>