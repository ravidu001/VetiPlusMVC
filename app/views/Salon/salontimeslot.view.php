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

<body>
    <div class="pagecontent">
        <div>
            <?php
                include __DIR__ . '/../navbar/salonnav.php';
             ?>
        </div>
       
        <h1>Salon Time Slot Schedules</h1>
        <div class="buttons">
            <button style="background-color:darkorchid">
                <a href="<?=ROOT?>/SalonTimeSlot">
                   View Slots
                </a> 
            </button>
            <button>
                <a href="<?=ROOT?>/SalonHolidayView">
                    Holidays
                </a>    
            </button>
            <button>
                <a href="<?=ROOT?>/SalonSlot">
                    Create Slots
                </a> 
            </button>
        </div>

        <div class="pagecontent" style="display: flex;">
            <div class="calendar" data-backend-url="<?=ROOT ?>/SalonTimeSlot/RetriveTimeSlotsDataByDate">
                <div class="calandercolrs" style="display: flex;">
                    <!-- <p class="closedays">Close Days</p>
                    <p class="opendays">Open Days</p>
                    <p class="pastdays">Past Days</p>
                    <p class="holidays">Holidays</p> -->
                </div>
                <?php
                    require __DIR__ .'/saloncalander.view.php';
                ?>
            </div>
            <div class="SelectDateAndSlot">
                <div class="DateAndScedule">
                    <div class="timeSlotsContainer">
                        <div class="shedule">
                            <h4>Schedule</h4>
                            <p class="start">Start: </p><p id="start"></p>
                            <p class="close">End: </p><p id="end"></p>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Salon Time Slot</th>
                                    <th>Bookings</th>
                                    <th>Available Bookings</th>
                                </tr>
                            </thead>
                            <tbody class="tablebody" id="slotTableBody">
                            </tbody>
                        </table>
                    </div>
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

    <script src="<?=ROOT?>/assets/js/salon/salontimeslotview.js"></script>
    <script>
        const salonEmail = "<?php echo $_SESSION['SALON_USER']; ?>";
    </script>
    <script src="<?=ROOT?>/assets/js/salon/saloncalendar.js"></script>
</body>
</html>





