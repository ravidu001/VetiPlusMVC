<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time Slot View Page</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/salon/salontimeslotview.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>

<!-- get the all data in the salsession table in to array  -->
<?php
    if(isset($data['slot_details']))
    {
        $days = $data['slot_details'];
    }
    else
    {
        $days = [];
    }
?>

<body>
    <div class="content">
        <a href="<?=ROOT?>/SalonTimeSlot"><i class="fa-solid fa-circle-xmark pageclose"></i></a>
        <h2>Time Slot Details </h2>
        <div class="search">
            <div class="month">
                <select name="month" id="month">
                    <option value="janu">Janu</option>
                    <option value="feb">Feb</option>
                    <option value="march">March</option>
                    <option value="april">April</option>
                    <option value="april">May</option>
                    <option value="april">June</option>
                    <option value="april">July</option>
                    <option value="april">August</option>
                    <option value="april">September</option>
                    <option value="april">Octomber</option>
                    <option value="april">November</option>
                    <option value="april">December</option>

                    <!-- include all months -->
                </select>
            </div>
            <div class="year">
                <select name="year" id="year">
                    <!-- enter the years to select the years -->
                </select>
            </div>
        </div>

        <div class="selsectcontent">
            <button class="opendays" id="opendays">
                Open Days
            </button>
            <button class="holidaywithbooked" id="holidaywithbooked">
                Holidays With Booking Slots
            </button>
        </div>

        <div class="opendays">
            <h3>Open Days............</h3>
           
            <table>
                <thead>
                    <tr>
                        <th>Day</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        //use the array_unique key in the PHP function to get the unique(not duplicate) data in the array
                        $unique_days = array_unique(array_column($days, 'openday')); // Extract unique dates
                        foreach ($unique_days as $day) : ?>
                    <tr>
                        <td><?= $day?></td>
                        <td>
                            <!-- if click this button then remove this day with the time slot in the salSssion table  -->
                            <form action="<?= ROOT ?>/SalonTimeSlotView" method="POST">
                                <input type="hidden" name="markholiday" value="<?= htmlspecialchars($day) ?>">
                                <button type="submit" name="AddtoHoliday">Mark as Holiday</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php endforeach; ?> 

        <div class="holidays">
            <h3>Holidays with the Booked Time Slots</h3>

            <table>
                <thead>
                    <tr>
                        <th>Day</th>
                        <th>Time Slot</th>
                        <th>Pet Owner</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tbody>
            </table>
        </div>
       
    </div>
</body>
    <script src="<?=ROOT?>/assets/js/salon/salontimeslotview.js"></script> 

</html>