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
    <title>VetiPlus - Appointments Dashboard</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/adminnav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/common/notification.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/appointment.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
    <?php require_once '../app/views/navbar/adminnav.php'; ?>

    <section class="home">
    <?php echo $notification->display(); ?>
        <div class="main-container">
            <div class="appointment-stats">
                <div class="stat-card">
                    <h3>Pending Appointments</h3>
                    <div class="stat-number"><?php echo htmlspecialchars($pendingappointment, ENT_QUOTES, 'UTF-8'); ?></div>
                </div>
                <div class="stat-card">
                    <h3>Canceled Appointments</h3>
                    <div class="stat-number"><?php echo htmlspecialchars($cancelappointment, ENT_QUOTES, 'UTF-8'); ?></div> 
                </div>
                <div class="stat-card">
                    <h3>Total Appointments</h3>
                    <div class="stat-number"><?php echo htmlspecialchars($appointmentcount, ENT_QUOTES, 'UTF-8'); ?></div>
                </div>
            </div>
            <div class="appointment-search">
                <form class="search-form" action="<?= ROOT ?>/AdminAppointment/appointmentlist" method="GET">
                    <div class="search-inputs">
                        <input type="text" name="petownerid" placeholder="Enter User ID">
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
                        <?php
                        if(is_array($data['appointmentdata'] )):
                             if (isset($data['appointmentdata'])) : ?>
                                <?php foreach ($data['appointmentdata'] as $appointment) : ?>
                                    <tr>
                                        <td><?= $appointment->appointmentID ?></td>
                                        <td><?= $appointment->petID ?></td>
                                        <td><?= $appointment->bookedDateTime ?></td>
                                        <td><?= $appointment->sessionID ?></td>
                                        <td><?= $appointment->visitTime ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="6">No appointment data available.</td>
                                </tr>
                            <?php endif; ?>
                            <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</body>

</html>