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
                    

                    <div class="calendar">
                        <?php
                            require __DIR__ .'/saloncalander.view.php';
                        ?>
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
                                        <tbody>
                                            <form action="<?= ROOT ?>/SalonTimeSlot/updateStatus" method="POST">
                                                <?php if (!empty($appointments)) : ?>
                                                    <?php foreach ($appointments as $appointment) : ?>
                                                        <tr>
                                                            <td>
                                                                <div class="user">
                                                                    <?= htmlspecialchars($appointment['fullName']); ?>
                                                                </div>
                                                            </td>
                                                            <td><?= date('Y-m-d', strtotime($appointment['bookedDate'])); ?></td>
                                                            <td><?= htmlspecialchars($appointment['slotDate']); ?></td>
                                                            <td><?= htmlspecialchars($appointment['timeSlot']); ?></td>
                                                            <td><?= htmlspecialchars($appointment['service']); ?></td>
                                                            <td><?= htmlspecialchars($appointment['contactNumber']); ?></td>
                                                            <td>
                                                                <!-- Pass groomingID as a hidden input -->
                                                                <input type="hidden" name="groomingID" value="<?= $appointment['groomingID']; ?>">

                                                                <!-- Completed button sends status 1 -->
                                                                <button type="submit" class="ok" name="action" value="complete">Completed</button>

                                                                <!-- Cancel button sends status 2 -->
                                                                <button type="submit" class="ok" name="action" value="cancel">Cancelled</button>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else : ?>
                                                    <tr>
                                                        <td colspan="7">No appointments found.</td>
                                                    </tr>
                                                <?php endif; ?>
                                            </form>
                                        </tbody>
                                </table>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
    </div>
   
    
</body>
    <script src="<?=ROOT?>/assets/js/navbar/salonnav.js"></script>
</html>