<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Appointments</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/salon/saloncompleteappointment.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/salon/sidebar.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/images/vetiplus-logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>
<body>
    <div class="pagecontent">
        <div class="sidebarandappointmentcontent">
            <div>
                <?php
                    include __DIR__ . '/../navbar/salonnav.php';
                ?>
            </div>
            <div class="appointmentcontent">
            <div class="calendarpart">
                <div class="calendar" data-backend-url="<?= ROOT ?>/SalonCompleteAppointment/findDataTab2">
                    <?php
                        require __DIR__ .'/saloncalander.view.php';
                    ?>
                </div>
            </div>
            <div class="appointmentdetailpart">
                <div class="upcomingappointmentdetails">
                    <h3>Complete Appointments</h3>
                        <div class="userdetail">
                            <table>
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Booked Date</th>
                                        <th>Slot Date</th>
                                        <th>Time Slot</th>
                                        <th>Service</th>
                                        <th>Contact Number</th>
                                    </tr>
                                </thead>
                                <tbody id="appointmentTableBody">
                                    <tr>
                                        <td colspan="7">No appointments found.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
<script src="<?=ROOT?>/assets/js/navbar/salonnavbar.js"></script>
<script src="<?=ROOT?>/assets/js/salon/saloncalendar.js"></script>
<script src="<?=ROOT?>/assets/js/salon/saloncompleteappointments.js"></script>
</html>