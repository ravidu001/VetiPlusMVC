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
        <!-- add the go to date sector -->
        <div class="date-selector">
            <input type="date" id="datePicker" class="selectdate">
            <button onclick="goToSelectedDate()" class="date-button">Go to Date</button>
        </div>

        <div class="calendar-header">
            <h2 id="current-month">August 2024</h2>
            <div>
                <button onclick="previousMonth()">←</button>
                <button onclick="nextMonth()">→</button>
            </div>
        </div>
        <div class="status-indicators">
            <div class="status-indicator">
                <div class="status-dot dot-available"></div>
                <span>Available</span>
            </div>
            <div class="status-indicator">
                <div class="status-dot dot-blocked"></div>
                <span>Blocked</span>
            </div>
            <div class="status-indicator">
                <div class="status-dot dot-closed"></div>
                <span>Closed</span>
            </div>
        </div>
        <div class="calendar-grid" id="calendar"></div>
        <div class="time-slots" id="time-slots"></div>
    </div>

   
</body>
<script>
    const BASE_URL = "<?= ROOT ?>";
</script>
<!-- <script src="<?=ROOT?>/assets/js/salon/saloncalendar.js"></script> -->
</html>
