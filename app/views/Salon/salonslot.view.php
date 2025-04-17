<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time Slot View</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/salon/salonslot.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/salon/salontimeslot.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>

<?php
   if(isset ($data['WeekdayDetails']))
   {
        $weekdays = $data['WeekdayDetails'];
   }
   else
   {
        $weekdays = [];
   }

   if(isset($data ['ConfigDetails']))
   {
        $ConfigDetails = $data['ConfigDetails'][0];
   }
   else
   {
        $ConfigDetails  = [];
   }
?>

<body>
        <div>
            <?php
                 include __DIR__ . '/../navbar/salonnav.php';
            ?>
        </div>

    <div class="timeslotdetails">
        <h1>Salon Time Slot Details</h1>
        <div class="buttons">
            <button style="background-color:darkorchid">
                <a href="<?=ROOT?>/SalonSlot">
                    Create Slots
                </a> 
            </button>
            <button>
                <a href="<?=ROOT?>/SalonTimeSlot">
                   View Slots
                </a> 
            </button>
            <button>
                <a href="<?=ROOT?>/SalonHolidayView">
                    Holidays
                </a>    
            </button>
        </div>
        <button>
            <a href="<?= ROOT?>/SalonSlotCreate">Create</a>
        </button>
        <div class="selecttime">
        <?php if (!empty($ConfigDetails)) : ?>
                
            <h2>Time Slot Details</h2>
            <div class="timeslots" style="display: flex;">
                <div class="duration">
                    <h4>Time Duration per Slot (minutes):</h4>
                    <p><?= $ConfigDetails->slot_duration_minutes?></p>
                </div>
               <div class="appointment" >
                    <h4>Appointments per Slot:</h4>
                    <p><?= $ConfigDetails->appointments_per_slot?></p>
               </div>
               <p>Create time slots for: <span class="highlight"><?= $ConfigDetails->slot_creation_frequency?></span></p>
            </div>
        </div>    
        <?php else : ?>
                <p>Create time slots for: <span class="highlight">Not yet</span></p>
            </div>
            <div class="timeslots">
                <h2>Time Slot Details</h2>
                <h4>Time Duration per Slot (minutes):</h4>
                <p>Not yet</p>
                <h4>Appointments per Slot:</h4>
                <p>Not yet</p>
            </div> 
        <?php endif; ?>  
        <!-- <div class="daysdetails" > -->
            <div class="days">
                <h2>Weekly Schedule</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Day</th>
                                <th>Start Time</th>
                                <th>Close Time</th>
                                <th>Closed</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($weekdays)) : ?>
                            <?php foreach ($weekdays as $weekday) : ?>
                            <tr>
                                <td><?= ucfirst($weekday->day_of_week); ?></td>
                                <td><?= ($weekday->is_closed == 0) ? date("h:i A", strtotime($weekday->start_time)) : '________'; ?></td>
                                <td><?= ($weekday->is_closed == 0) ? date("h:i A", strtotime($weekday->end_time)) : '________'; ?></td>
                                <td><?= ($weekday->is_closed == 1) ? 'Yes' : 'No'; ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4">Not yet added any holidays</td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
            </div>
           
        <!-- </div> -->
       
    </div>
</body>
</html>
