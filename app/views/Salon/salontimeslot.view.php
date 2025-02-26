<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Salon Scheduler</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/salon/salontimeslot.css">
    <!-- <link rel="stylesheet" href="<?=ROOT?>/assets/css/salon/salonavailabletime.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<?php
    if(isset($data['time_slot'])) 
    {
        $time_slots = $data['time_slot'];
    } 
    else 
    {
        $time_slots = [];
    }

    if(isset($data['salondetails']))
    {
        $salondetails = $data['salondetails'];
    }
    else
    {
        $salondetails = [];
    }
?>

<body>
    <div class="pagecontent">
        <div>
            <?php
                include __DIR__ . '/../navbar/salonnav.php';
             ?>
            <!-- <php code for navbar here> -->
        </div>
        <div class="SelectDateAndSlot">
            <h1>Salon Time Slot Schedules</h1>
            <div class="DateAndScedule">
                <div class="DateContent">
                    <div style="display: flex;">
                        <div class="SelectDate">
                            <div class="selectdatebox">
                                <div class="selectdateboxname">
                                    Time Slots 
                                    <div class="enterdate">
                                        <form action="<?= ROOT ?>/SalonTimeSlot" method="POST">
                                            <input 
                                                type="date" 
                                                class="selectdate" 
                                                name="slotDate"
                                                value="hi">
                                            <button type="submit" name="finddate">Find</button>
                                        </form>
                                </div>
                                </div>
                            </div>
                            <div class="legend">
                                <div class="legendcontent">
                                    <div class="legend-item">
                                        <div class="color-box available"></div>
                                        <span>Available</span>
                                    </div>
                                    <div class="legend-item">
                                        <div class="color-box booked"></div>
                                        <span>Booked</span>
                                    </div>
                                    <div class="legend-item">
                                        <div class="color-box blocked"></div>
                                        <span>Blocked</span>
                                    </div>
                                </div>    

                                <?php if(isset( $data['empty']))
                                {
                                    ?> 
                                    <div class="time-slot available">
                                        <div class="time-slot-status">
                                            <span class="status-icon available"></span>
                                           <?= $data['empty'] ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <?php
                                    if(isset($data['time_slot']))
                                    {
                                ?>   

                                    <div class="time-slots">
                                        <?php foreach ($time_slots as $slot): ?>
                                        <?php 
                                            $status = isset($slot->status) ? $slot->status : 'available';
                                        ?>
                                        <div class="time-slot <?= htmlspecialchars($status); ?>">
                                            <div class="time-slot-time">
                                                <?= htmlspecialchars($slot->time_slot); ?>
                                            </div>
                                            <div class="time-slot-status">
                                                <span class="status-icon <?= htmlspecialchars($status); ?>"></span>
                                                <?= ucfirst($status); ?>
                                            </div>
                                            
                                            <?php 
                                                if ($slot->status == 'available') 
                                                { 
                                            ?>
                                                <div class="slotchange">
                                                    <form action="<?= ROOT ?>/SalonTimeSlot" method="POST">
                                                        <input type="hidden" name="salSessionID" value="<?= htmlspecialchars($slot->salSessionID) ?>">
                                                        <button type="submit" name="SlotBlock">Block Slot</button>
                                                    </form>
                                                </div>
                                            <?php 
                                                } elseif ($slot->status == 'blocked') { 
                                            ?>
                                                <div class="slotchange">
                                                    <form action="<?= ROOT ?>/SalonTimeSlot" method="POST">
                                                        <input type="hidden" name="salSessionID" value="<?= htmlspecialchars($slot->salSessionID) ?>">
                                                        <button type="submit" name="SlotAvailable">Available Slot</button>
                                                    </form>
                                                </div>
                                            <?php 
                                                } 
                                            ?>

                                        </div>
                                    
                                        <?php endforeach; ?>

                                <?php    
                                }
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </div>

    <script src="<?=ROOT?>/assets/js/salon/salonavailabletime.js"></script>
</body>
</html>





