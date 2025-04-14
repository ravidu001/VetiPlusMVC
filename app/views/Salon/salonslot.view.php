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
               <div class="appointment">
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
        <div class="daysdetails" >
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
       
    </div>
</body>
</html>

<style>
    /* Base Styles */
:root {
    --primary-color: #6A0DAD;
    --primary-light: #ab5fe1;
    --primary-dark: #5c0b94;
    --primary-lighter: #f8f3fb;
    --white: #ffffff;
    --black: #212121;
    --gray-100: #f9f9f9;
    --gray-200: #f0f0f0;
    --gray-300: #e0e0e0; 
    --gray-400: #bdbdbd;
    --gray-500: #9e9e9e;
    --gray-600: #757575;
    --gray-700: #4a5568;
    --gray-800: #333333;
    --danger: #9c27b0;
    --danger-dark: #7b1fa2;
    --box-shadow: 0 4px 12px rgba(106, 13, 173, 0.15);
    --border-radius: 8px;
    --transition: all 0.3s ease;
}

body {
    font-family: "Inter", sans-serif;
    margin: 0;
    background: linear-gradient(135deg, #fff6ff 0%, #ffecff 100%);
    color: var(--gray-800);
    min-height: 100vh;
}

/* Time Slot Layout */
.timeslotdetails {
    display: grid;
    gap: 24px;
    max-width: 1100px;
    margin: 2rem auto;
    padding: 0 20px;
}

/* Top create button styling */
.timeslotdetails > button {
    justify-self: flex-start;
    margin-bottom: 8px;
}

.timeslotdetails > button a::before {
    content: "\f067"; /* Font Awesome plus icon */
}

.selecttime, .timeslots, .days, .holidays, .daysdetails {
    border: 1px solid var(--gray-300);
    border-radius: var(--border-radius);
    padding: 20px;
    background-color: var(--white);
    box-shadow: var(--box-shadow);
    transition: var(--transition);
}

.selecttime:hover, .timeslots:hover, .days:hover, .holidays:hover {
    box-shadow: 0 6px 16px rgba(106, 13, 173, 0.2);
}

/* Time slots flex layout */
.timeslots {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 20px;
    padding: 24px;
}

.timeslots .duration, 
.timeslots .appointment {
    flex: 1;
    min-width: 200px;
    margin-bottom: 0;
    padding-bottom: 0;
    border-bottom: none;
}

.timeslots p {
    flex-basis: 100%;
    margin-top: 16px;
    padding-top: 16px;
    border-top: 1px solid var(--gray-200);
}

/* Days and Holidays layout */
.daysdetails {
    display: flex;
    gap: 24px;
    padding: 0;
    border: none;
    box-shadow: none;
    background: transparent;
}

.days, .holidays {
    flex: 1;
    min-width: 300px;
}

/* Typography */
h2 {
    margin-top: 0;
    color: var(--primary-color);
    font-weight: 600;
    border-bottom: 2px solid var(--gray-200);
    padding-bottom: 10px;
    margin-bottom: 16px;
}

h4 {
    margin: 12px 0 6px;
    color: var(--gray-700);
    font-weight: 500;
}

p {
    margin: 6px 0 12px;
    font-size: 16px;
    color: var(--gray-700);
}

.selecttime .highlight,
.timeslots .highlight {
    font-weight: 600;
    color: var(--primary-color);
}

/* Button Styles */
button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin: 0;
    padding: 10px 18px;
    min-width: 70px;
    font-size: 15px;
    font-weight: 500;
    background-color: var(--primary-color);
    color: var(--white);
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: var(--transition);
    box-shadow: 0 2px 4px rgba(106, 13, 173, 0.2);
}

button:hover {
    background-color: var(--primary-dark);
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(106, 13, 173, 0.3);
}

button:active {
    transform: translateY(0);
}

button a {
    text-decoration: none;
    color: var(--white);
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
}

button.remove-btn {
    background-color: var(--danger);
    color: var(--white);
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: var(--transition);
    min-width: 80px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

button.remove-btn:hover {
    background-color: var(--danger-dark);
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
}

/* Add icons using Font Awesome */
button a::before {
    font-family: "Font Awesome 6 Free";
    font-weight: 900;
    margin-right: 8px;
}

.holidays button a::before {
    content: "\f067"; /* Font Awesome plus icon */
}

button.remove-btn::before {
    content: "\f1f8"; /* Font Awesome trash icon */
    font-family: "Font Awesome 6 Free";
    font-weight: 900;
    margin-right: 8px;
}

/* Table Styles */
table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    margin-top: 12px;
    margin-bottom: 24px;
    font-size: 15px;
    text-align: left;
    border-radius: var(--border-radius);
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

th {
    background-color: var(--primary-lighter);
    color: var(--black);
    padding: 14px 16px;
    font-weight: 600;
    text-align: left;
    border-bottom: 2px solid var(--primary-color);
    position: sticky;
    top: 0;
}

th:first-child {
    border-top-left-radius: var(--border-radius);
}

th:last-child {
    border-top-right-radius: var(--border-radius);
    text-align: center;
}

td {
    padding: 12px 16px;
    border-bottom: 1px solid var(--gray-300);
    font-size: 15px;
    color: var(--gray-700);
    vertical-align: middle;
}

tbody tr:last-child td {
    border-bottom: none;
}

tbody tr:hover {
    background-color: var(--gray-100);
}

/* Status indicators and specific cells */
td:last-child {
    text-align: center;
}

/* Add a bit of extra styling for the duration and appointment divs */
.duration h4, .appointment h4 {
    margin-top: 0;
}

.holidays h2 {
    display: inline-block;
    margin-right: 20px;
}

.holidays button {
    margin-bottom: 16px;
}

/* Scrollbar Styling */
::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

::-webkit-scrollbar-track {
    background: var(--gray-200);
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    background: var(--primary-light);
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: var(--primary-color);
}

/* Animations */
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.timeslotdetails {
    animation: fadeIn 0.5s ease;
}

/* Empty state styling */
table tbody tr td[colspan] {
    text-align: center;
    padding: 40px 0;
    color: var(--gray-500);
}

/* Responsive Design */
@media screen and (max-width: 1200px) {
    .timeslotdetails {
        width: 95%;
    }
}

@media screen and (max-width: 992px) {
    table {
        font-size: 14px;
    }
    
    th, td {
        padding: 10px 12px;
    }
    
    .timeslots {
        flex-direction: column;
    }
    
    .timeslots .duration,
    .timeslots .appointment,
    .timeslots p {
        margin-bottom: 16px;
    }
}

@media screen and (max-width: 768px) {
    .timeslotdetails {
        padding: 0 10px;
    }
    
    .timeslots, .days, .selecttime, .holidays {
        padding: 16px;
    }
    
    .daysdetails {
        flex-direction: column;
    }
    
    .days, .holidays {
        width: 100%;
    }
    
    button {
        padding: 8px 12px;
    }
}

@media screen and (max-width: 576px) {
    table {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }
    
    h2 {
        font-size: 20px;
    }
    
    button {
        width: 100%;
        margin-bottom: 10px;
    }
    
    td:last-child {
        min-width: 100px;
    }
}
</style>