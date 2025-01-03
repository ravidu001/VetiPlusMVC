<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <title>VetiPlus - Appointments</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/ownernav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/owner/appointment.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>
    <?php require_once '../app/views/navbar/ownernav.php'; ?>
    <section class="home">
        <div class="container">
            <div class="appointments-overview">
                <div class="appointment-card">
                    <i class='bx bx-calendar-check icon'></i>
                    <div class="appointment-card-content">
                        <h3>Daily Appointments</h3>
                        <p>45</p>
                    </div>
                </div>
                <div class="appointment-card">
                    <i class='bx bx-calendar icon'></i>
                    <div class="appointment-card-content">
                        <h3>Monthly Appointments</h3>
                        <p>230</p>
                    </div>
                </div>
                <div class="appointment-card">
                    <i class='bx bx-calendar-x icon'></i>
                    <div class="appointment-card-content">
                        <h3>Canceled Appointments</h3>
                        <p>15</p>
                    </div>
                </div>
                <div class="appointment-card">
                    <i class='bx bx-time icon'></i>
                    <div class="appointment-card-content">
                        <h3>Pending Appointments</h3>
                        <p>22</p>
                    </div>
                </div>
            </div>

            <div class="search-section">
                <form class="search-form" action="<?= ROOT ?>/OwnerAppointment/appointmentlist" method="post">
                    <div class="search-inputs">
                        <input type="text" placeholder="Search by User ID">
                        <input type="text" placeholder="Search by Pet ID">
                        <input type="date">
                    </div>
                    <button type="submit">Search Appointments</button>
                </form>
            </div>

            <div class="chart-section">
                <h2>Appointment Trends</h2>
                <canvas id="appointmentChart"></canvas>
            </div>
        </div>
    </section>
    <script src="<?= ROOT ?>/assets/js/owner/ownerappointmentbarchart.js"></script>

</body>

</html>