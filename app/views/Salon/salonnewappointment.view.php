<!DOCTYPE html>
<html lang="en">
<head>
    <title>New Appointments</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/salon/salonnewappointment.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/navbar/salonnav.css">
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
                    

                    <!-- <div class="calendar">
                        <?php
                            // require __DIR__ .'/saloncalander.view.php';
                        ?>
                    </div> -->

                    <div class="calendar" data-backend-url="<?= ROOT ?>/SalonNewAppointment/findDataTab1">
                        <?php require __DIR__ . '/saloncalander.view.php'; ?>
                    </div>
                </div>
                <div class="appointmentdetailpart">
                    <div class="upcomingappointmentdetails">
                        <h3>Upcoming Appointments</h3>
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
                                        <th>Status</th>
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
    </div>
   
    
</body>
<!-- <script>
    const BASE_URL = "<?=ROOT?>";
</script> -->
    <script src="<?=ROOT?>/assets/js/navbar/salonnav.js"></script>
    <script src="<?=ROOT?>/assets/js/salon/saloncalendar.js"></script>
    <script src="<?=ROOT?>/assets/js/salon/salonnewappointments.js"></script>


</html>