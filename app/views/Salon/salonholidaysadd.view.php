<?php
    $notification = new Notification;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salon Holidays Add</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/salon/salonholidayadd.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/common/notification.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
<?= $notification->display(); ?>
    <div class="holidays">
        <a href="<?=ROOT?>/SalonHolidayView"><i class="fa-solid fa-circle-xmark pageclose"></i></a>
            <form action="<?=ROOT?>/SalonHolidays" method="post">
                <p>Add holidays:</p>
                <input type="date" id="holidayDate" />
                <button type="button" onclick="addHoliday()"></button>
                <ul id="holidayList"></ul>

                <!-- Hidden input to store holidays array -->
                <div id="hiddenInputs"></div>

                <button type="submit" name="saveholidays">Save Holidays</button>
            </form>
    </div>
</body>

<script src="<?=ROOT?>/assets/js/salon/holidayadd.js"></script>

</html>