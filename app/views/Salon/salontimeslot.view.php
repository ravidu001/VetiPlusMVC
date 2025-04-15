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
        <div class="calendar" data-backend-url="<?=ROOT ?>/SalonTimeSlot/RetriveTimeSlotsDataByDate">
            <?php
                require __DIR__ .'/saloncalander.view.php';
            ?>
        </div>
        <div class="SelectDateAndSlot">
            <h1>Salon Time Slot Schedules</h1>
            <div class="DateAndScedule">
                <div class="timeSlotsContainer">
                    
                </div>
            </div>    
        </div>
    </div>
    <style>
        .time-slot {
            display: inline-block;
            padding: 10px;
            margin: 5px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            width: 120px;
        }

        .available {
            background-color: #4CAF50; /* Green for available */
            color: white;
        }

        .blocked {
            background-color: #FF9800; /* Orange for blocked */
            color: white;
        }

        .booked {
            background-color: #F44336; /* Red for booked */
            color: white;
        }

    </style>

    <script src="<?=ROOT?>/assets/js/salon/salonavailabletime.js"></script>
    <script src="<?=ROOT?>/assets/js/salon/saloncalendar.js"></script>
    <script src="<?=ROOT?>/assets/js/salon/salonavailabletime.js"></script>
</body>
</html>





