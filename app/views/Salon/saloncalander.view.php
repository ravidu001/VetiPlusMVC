<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Calendar</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/salon/saloncalander.css">
</head>
<body>
    <div class="calendar-container">
        <div class="current-month-display">
            <button class="prev-month-btn" onclick="previousMonth()">←</button>
            <h2 id="current-month"></h2>
            <button class="next-month-btn" onclick="nextMonth()">→</button>
        </div>
        <div class="calendar-grid" id="calendar"></div>
        <div class="time-slots" id="slotContainer"></div>
    </div>

   
</body>
<script>
    const BASE_URL = "<?= ROOT ?>";
</script>
<script src="<?=ROOT?>/assets/js/salon/saloncalendar.js"></script>
</html>
