<?php
    $notification = new Notification;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Holidays</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/salon/salonholiday.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/salon/salontimeslot.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/common/notification.css">
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
?>

<body>
<?= $notification->display(); ?>
        <div>
            <?php
                include __DIR__ . '/../navbar/salonnav.php';
             ?>
            <!-- <php code for navbar here> -->
        </div>

        <h2>Salon Time Slot Details</h2>

        <div class="buttons">
            <button style="background-color:darkorchid">
                <a href="<?=ROOT?>/SalonHolidayView">
                    Holidays
                </a>    
            </button>
            <button>
                <a href="<?=ROOT?>/SalonSlot">
                    Create Slots
                </a> 
            </button>
            <button>
                <a href="<?=ROOT?>/SalonTimeSlot">
                   View Slots
                </a> 
            </button>
        </div>

    <div class="holiday">
        <a href="<?=ROOT?>/SalonTimeSlot"><i class="fa-solid fa-circle-xmark pageclose"></i></a>
        <h2>Holidays</h2>
        <button class="addbutton">
            <a href="<?=ROOT?>/SalonHolidays">Add</a>
        </button>
        <form method="POST" action="<?= ROOT ?>/SalonHolidayView/removeHoliday">    
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
</body>
</html>