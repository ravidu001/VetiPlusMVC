<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/navbar/salonnav.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/salon/salondashboard.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/salon/salonchart.css"> 
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/guest/myFooter.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/salon/salonpopup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Document</title>
</head>
<body>
    <div class="homecontent">
        <div class="sideanddashbord">
            <div>
                <?php
                    include __DIR__ . '/../navbar/salonnav.php';
                ?>
            </div>
            <div class="pagecontent">
                <div class="dashbardheader">
                    <div class="profile">
                        <img class="profile" src="<?=ROOT?>/assets/images/salon/service/wallpaper.jpg" alt="profile.php">
                        <p class="owner">Owner :</p>
                        <p class="name">Pabodya Nethsarani</p>
                    </div>
                    <div class="dashboard-icon" id="icon">
                        <a href="<?=ROOT?>/SalonNotifications">
                            <i class="fa-regular fa-bell icon"></i>
                            <span class="notification-count">
                                <?php
                                    if(!empty($data['upcoming']))
                                    {
                                        ?>
                                        <?=$data['upcoming'] ?>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>0<?php
                                    }
                                ?>
                            </span>
                        </a>
                    </div>
                </div>

                <div class="dashcontent">
                <div class="stats-container">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-value">
                                <?php
                                    if(!empty($data['count']))
                                    {
                                        $count = $data['count'];
                                    }
                                ?>
                                <?= $count ?>
                            </div>
                            <div class="stat-label">Total Appointments</div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-value">
                                <?php
                                    if(!empty($data['completedCount']))
                                    {
                                        $count = $data['completedCount'];
                                    }
                                ?>
                                <?= $count ?>
                            </div>
                            <div class="stat-label">Total Complete Appointments</div>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-value">
                                <?php
                                    $countcustomer = 0;
                                    if(!empty($data['customers']))
                                    {
                                        $countcustomer = $data['customers'];
                                    }
                                ?>
                                <?= $countcustomer ?>
                            </div>
                            <div class="stat-label">Total Customers</div>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-value">
                                <?php
                                    if(!empty($data['reviews']))
                                    {
                                        $ratingCount = $data['reviews'];
                                    }
                                    else
                                    {
                                        $ratingCount = 0;
                                    }
                                ?>
                                <?= $ratingCount ?>
                            </div>
                            <div class="stat-label">Total Reviews</div>
                        </div>
                    </div>
                </div>
            </div>

                <div style="display: flex; margin-left:1%">
                    <div class="dashcontent">
                        <div class="timeSlotforTOday">
                            <h3 class="timeslots">Time Slots </h3>
                            <?php
                                $today = date('Y-m-d');
                            ?>
                            <h4 class="date">Today ..............................................................<?= $today ?></h4>

                            <div class="slots">
                                <div class="colorslots">
                                    <p class="timeblocks booked-slot">booking-color</p>
                                    <p class="timeblocks blocked-slot">blocking-color</p>
                                    <p class="timeblocks available-slot">available-color</p>
                                </div>
                
                                <table class="slotdetails">
                                    <tbody>
                                        <thead>
                                            <tr>
                                                <th>Time Slot</th>
                                                <th>Bookings</th>
                                                <th>Completed</th>
                                            </tr>
                                        </thead>
                                        <?php
                                            if(!empty($data['slotdetails']) && is_array($data['slotdetails']))
                                            {
                                                $timeslots = $data['slotdetails'];

                                                // show($timeslots);

                                                foreach ($data['slotdetails'] as $timeslot) 
                                                {
                                                    // show($timeslot['status']);
                                                    $slotstatus = isset($timeslot['status']) ? $timeslot['status'] : 'unknown';
                                                    $timeSlot = isset($timeslot['time_slot']) ? $timeslot['time_slot'] : 'N/A';
                                                    $noOfBookings = isset($timeslot['noOfBookings']) ? $timeslot['noOfBookings'] : 0;
                                                    $completed = isset($timeslot['completeAppointments']) ? $timeslot['completeAppointments'] : 0;

                                                    if($slotstatus == 'booked')
                                                    {
                                                        $class = 'booked-slot';
                                                    }
                                                    else if($slotstatus == 'blocked')
                                                    {
                                                        $class = 'blocked-slot';
                                                    }
                                                    else if($slotstatus == 'available')
                                                    {
                                                        $class = 'available-slot';
                                                    }
                                                    else
                                                    {
                                                        $class = '';
                                                    }
                                                ?>
                                                    <tr>
                                                        <td class="timeblock <?= $class ?>" style="margin-right: 20px;">
                                                            <?= htmlspecialchars($timeSlot) ?>
                                                        </td>
                                                        <td class="timeblock <?= $class ?>">
                                                            <?= htmlspecialchars($noOfBookings) ?>
                                                        </td>
                                                        <td class="timeblock <?= $class ?>">
                                                            <?= htmlspecialchars($completed) ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            else
                                            {
                                                echo '<tr><td colspan="3">No time slots available</td></tr>';
                                            }
                                        ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        
                        <div class="part2">
                            <div class="part2header">
                                <h3>Upcoming Appointments</h3>
                            </div>

                            <div class="appointmentTableBody" id="appointmentContainer">
                            <div class="table">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>User</th>
                                                <th>Slot Date</th>
                                                <th>Time Slot</th>
                                                <th>Service</th>
                                                <th>Contact Number</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            if(!empty($data['upcoming']))
                                            {
                                                // print_r($data);
                                                $details = $data['upcoming'];
                                                foreach($details as $detail)
                                                {     
                                        ?>
                                            <tr>
                                                <td><?= $detail['bookedDate'] ?></td>
                                                <td><?= $detail['bookedTime'] ?></td>
                                            </tr>
                                            <tr>
                                                <td><?= $detail['petOwner'] ?></td>
                                                <td><?= $detail['slotDate'] ?></td>
                                                <td><?= $detail['timeSlot'] ?></td>
                                                <td><?= $detail['service'] ?></td>
                                                <td><?= $detail['contactNumber'] ?></td>
                                                <td>
                                                    <form method="post" action="<?=ROOT?>/Salon">
                                                        <input type="hidden" name="bookingID" value="<?= $detail['groomingID'] ?>">
                                                        <button class="complete" type="submit" name="markComplete">Complete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php
                                                }
                                            }
                                            else
                                            {
                                                ?>
                                                    <tr>
                                                        <td colspan="6" style="align-items: center;">No appointmets today yet .............../complete</td>
                                                    </tr>
                                                <?php
                                            }
                                        ?>  
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                </div>

            </div>
        </div> 

        <div>
            <?php
                // require "../../../app/views"; footer 
            ?>
        </div> 
    </div> 
</body>
    <script src="<?= ROOT?>/assets/js/salon/salonpopup.js"></script>
    <script src="<?= ROOT?>/assets/js/navbar/salonnav.js"></script>

</html>