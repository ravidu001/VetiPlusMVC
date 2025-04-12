<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time Slot View</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>

<?php
   if (isset($data['holidays'])) 
   {
       $holidays = $data['holidays'];
   }
    else 
   {
       $holidays = [];
   }

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
        <button><a href="<?= ROOT?>/SalonSlotCreate">Create</a></button>
        <div class="selecttime">
        <?php if (!empty($ConfigDetails)) : ?>
                <p>Create time slots for: <span class="highlight"><?= $ConfigDetails->slot_creation_frequency?></span></p>
            </div>
            <div class="timeslots">
                <h2>Time Slot Details</h2>
                <h4>Time Duration per Slot (minutes):</h4>
                <p><?= $ConfigDetails->slot_duration_minutes?></p>
                <h4>Appointments per Slot:</h4>
                <p><?= $ConfigDetails->appointments_per_slot?></p>
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
                            <td><?= date("h:i A", strtotime($weekday->start_time)); ?></td>
                            <td><?= date("h:i A", strtotime($weekday->end_time)); ?></td>
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
        <div class="holidays">
            <h2>Holidays</h2>
            <button>
                <a href="<?=ROOT?>/SalonHolidays">Add</a>
            </button>
            <form method="POST" action="<?= ROOT ?>/SalonSlot/removeHoliday">    
                <table>
                    <thead>
                        <tr>
                            <th>Day</th>
                            <th>Status</th>
                        </tr>
                            </thead>
                    <tbody>
                        <?php
                            if (!empty($holidays)) : 
                        ?>
                        <?php 
                            foreach ($holidays as $holiday) : 
                        ?> 
                            <tr>
                                <td><?= $holiday ?></td>
                                <td>
                                    <button class="remove-btn" type="submit" name="remove" value="<?= $holiday ?>">
                                        Remove
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="2">Not yet added any holidays</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </form>    
        </div>
    </div>
</body>
</html>

<style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
    background-color: #f4f4f9;
}

.timeslotdetails {
    display: grid;
    gap: 20px;
    max-width: 800px;
    margin: auto;
}

.timeslots, .days, .selecttime, .holidays {
    border: 1px solid #ccc;
    border-radius: 8px;
    padding: 16px;
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

h2 {
    margin-top: 0;
    color: #333;
}

h4 {
    margin: 8px 0 4px;
}

p {
    margin: 4px 0;
    font-size: 16px;
    color: #555;
}

.selecttime .highlight {
    font-weight: bold;
    color: #007BFF;
}

button.remove-btn {
    padding: 6px 12px;
    border: none;
    border-radius: 4px;
    background-color: #dc3545;
    color: white;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button.remove-btn:hover {
    background-color: #c82333;
}

/* Table Styles */

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 8px;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
}

th {
    background-color: #007BFF;
    color: white;
}

td {
    color: #333;
}

/* Responsive Design */

@media (max-width: 600px) {
    .timeslotdetails {
        display: block;
    }

    table {
        font-size: 14px;
    }
}

</style>

