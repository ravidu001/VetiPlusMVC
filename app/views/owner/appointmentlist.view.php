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
          <select>
            <option>All Status</option>
            <option>Accepted</option>
            <option>Cancelled</option>
          </select>
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
          <tr>
            <td>#AP22001</td>
            <td>Fluffy</td>
            <td>2024/04/15</td>
            <td>2:30 PM</td>
            <td>Dr. Emily Johnson</td>
            <td><span class="status-accepted">Accepted</span></td>
          </tr>
          <tr>
            <td>#AP22002</td>
            <td>Buddy</td>
            <td>2024/04/16</td>
            <td>3:00 PM</td>
            <td>Dr. John Smith</td>
            <td><span class="status-cancelled">Cancelled</span></td>
          </tr>
          <tr>
            <td>#AP22003</td>
            <td>Max</td>
            <td>2024/04/17</td>
            <td>1:00 PM</td>
            <td>Dr. Sarah Lee</td>
            <td><span class="status-accepted">Accepted</span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>
</body>

</html>