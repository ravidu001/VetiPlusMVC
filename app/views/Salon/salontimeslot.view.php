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

                        <div>
                            <div class="container">
                                <h2>Time Details</h2>
                                <button type="button">
                                    <a href='<?= ROOT ?>/SalonTimeSlotEdit'>Edit</a> 
                                </button>
                                <div class="times" style="display: flex;">
                                    <?php
                                         if(isset($data['salondetails']))
                                         { 
                                    ?>
                                        <h4 class="opentime">
                                            Salon Open :-
                                        </h4>
                                        <p>
                                            <?= date("H:i", strtotime($salondetails->open_time)) ?>
                                        </p>
                                        <h4 class="closetime">
                                            Salon Close :-
                                        </h4>
                                        <p>
                                            <?= date("H:i", strtotime($salondetails->close_time)) ?>
                                        </p>
                                        <h4 class="closetime">
                                            Slot Duration :-
                                        </h4>
                                        <p>
                                            <?= $salondetails->slot_duration ?> min
                                        </p>
                                    <?php
                                         }
                                    ?>
                                    
                                </div>
                                <div>
                                    <button type="button">
                                        <a href='<?= ROOT ?>/SalonTimeSlotView'>View</a> 
                                    </button>
                                    <h3>Select the one day</h3>
                                    <form action="<?= ROOT ?>/SalonTimeSlot" method="POST">
                                        <label for="one-date">Date :</label>
                                        <input type="date" name="date" required>

                                        <button type="submit" class="edit-btn" name="onedate" style="margin-right:20px">
                                            Add Slots
                                        </button>
                                    </form>

                                    <h3>Select the date range</h3>
                                    <form action="<?= ROOT ?>/SalonTimeSlot" method="POST">
                                        <label for="start-date">Start Date:</label>
                                        <input type="date" id="start-date" name="startDate" required>

                                        <label for="end-date">End Date:</label>
                                        <input type="date" id="end-date" name="endDate" required>

                                        <label for="holidays">Holidays:</label>
                                        <div id="holiday-container">
                                            <input type="date" name="holidays[]" class="holiday-input">
                                            <button type="button" class="remove-holiday-btn" onclick="removeHoliday(this)">Remove</button>
                                        </div>
                                        <button type="button" onclick="addHoliday()">Add Holidays</button>

                                        <button type="submit" class="edit-btn" name="date_range" style="margin-right:20px">
                                            Add Slots
                                        </button>
                                    </form>

                                    <div id="saveSection" style="display:none; margin-top: 15px;">
                                        <button class="save-btn" onclick="saveChanges()">Save Changes</button>
                                        <button class="cancel-btn" onclick="cancelEdit()">Cancel</button>
                                    </div>
                                </div>
                            </div>      
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </div>

    <script>
        function addHoliday() {
            let container = document.getElementById("holiday-container");
            let input = document.createElement("input");
            input.type = "date";
            input.name = "holidays[]";
            input.classList.add("holiday-input");

            let removeButton = document.createElement("button");
            removeButton.type = "button";
            removeButton.classList.add("remove-holiday-btn");
            removeButton.textContent = "Remove";
            removeButton.setAttribute("onclick", "removeHoliday(this)");

            container.appendChild(input);
            container.appendChild(removeButton);
        }

        function removeHoliday(button) {
            let container = document.getElementById("holiday-container");
            container.removeChild(button.previousElementSibling); // Remove the input
            container.removeChild(button); // Remove the button
        }

        
    </script>

    <script src="<?=ROOT?>/assets/js/salon/salonavailabletime.js"></script>
</body>
</html>





