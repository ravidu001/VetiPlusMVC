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
                        <p><?php echo htmlspecialchars($dailyappointmentcount, ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                </div>
                <div class="appointment-card">
                    <i class='bx bx-calendar icon'></i>
                    <div class="appointment-card-content">
                        <h3>completed Appointments</h3>
                        <p><?php echo htmlspecialchars($completeappointment, ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                </div>
                <div class="appointment-card">
                    <i class='bx bx-calendar-x icon'></i>
                    <div class="appointment-card-content">
                        <h3>Canceled Appointments</h3>
                        <p><?php echo htmlspecialchars($cancelappointment, ENT_QUOTES, 'UTF-8'); ?></p> 
                    </div>
                </div>
                <div class="appointment-card">
                    <i class='bx bx-time icon'></i>
                    <div class="appointment-card-content">
                        <h3>Pending Appointments</h3> 
                        <p><?php echo htmlspecialchars($pendingappointment, ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                </div>
            </div>

            <div class="search-section">
                <form class="search-form" action="<?= ROOT ?>/OwnerAppointment/appointmentlist" method="GET">
                    <div class="search-inputs">
                        <input type="text" name="petownerid" placeholder="Enter User ID">
                        <!-- <input type="text" placeholder="Search by Pet ID"> -->
                        <!-- <input type="date"> -->
                    </div>
                    <button type="submit" name="submit" value="1" class="search-btn">Search Appointments</button>
                </form>
            </div>

            <!-- <div class="chart-section">
                 <h2>Appointment Trends</h2>
                <canvas id="appointmentChart"></canvas> 
            </div> -->
            <div class="appointments-list">
                <table class="appointments-table">
                    <thead>
                        <tr>
                            <th>Appointment ID</th>
                            <th>Pet Name</th>
                            <th>Date and Time</th>
                            <th>Session ID</th>
                            <th>Visit Time</th>
                            <th>Status
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($data['appointmentdata'])) : ?>
                            <?php foreach ($data['appointmentdata'] as $appointment) : ?>
                                <tr>
                                    <td><?= $appointment->appointmentID ?></td>
                                    <td><?= $appointment->petID ?></td>
                                    <td><?= $appointment->bookedDateTime ?></td>
                                    <td><?= $appointment->sessionID ?></td>
                                    <td><?= $appointment->visitTime ?></td>
                                    <td><?= $appointment->status ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="6">No appointment data available.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <script src="<?= ROOT ?>/assets/js/owner/ownerappointmentbarchart.js"></script>

</body>

</html>