<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Appointments</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/salon/saloncancelappointment.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/navbar/salonnav.css">
    <!-- <link rel="stylesheet" href="<?=ROOT?>/assets/cssFiles/salon/Enterdatebox.css"> -->
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
                <div class="calendar">
                    <?php
                        require __DIR__ .'/saloncalander.view.php';
                    ?>
                </div>
            </div>
            <div class="appointmentdetailpart">
                <div class="upcomingappointmentdetails">
                    <h3>Incomplete Appointments(Cancel)</h3>
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
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="user">
                                                <!-- <img src="../../assets/images/salon/boy.jpg" alt="userimage"> -->
                                                Abdual Rahim Vijepala
                                            </div>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td>6.00 a.m - 6.30 a.m</td>
                                        <td>Pet Bathing</td>
                                        <td>0776533229</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
        
    </div>
    
</body>
    <script src="<?=ROOT?>/assets/js/navbar/salonnav.js"></script>
</html>