<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vet Sessions Scheduler</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/calendar/calendar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/doctornav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/vetDoctor/viewsession.css">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        
    </style>
</head>
<body>
<?php require_once '../app/views/navbar/doctornav.php'; ?>
<div class="home">
    <div class="container">
        <?php require_once '../app/views/calendar.view.php'; ?>
        <!-- <div class="calendar-section">
            <div class="calendar-header">
                <h2 id="current-month">August 2024</h2>
                <div class="calendar-navigation">
                    <button>←</button>
                    <button>→</button>
                </div>
            </div>
            <div id="calendar-grid" class="calendar-grid">
                Calendar Days Generated Here
            </div>
        </div> -->

        <h2 class="session-heading">Upcoming Sessions</h2>
        <table class="sessions-table">
    <thead>
        <tr>
            <th>Session</th>
            <th>Assistant</th>
            <th>Date & Time</th>
            <th>Location</th>
            <th>Appointments</th>
            <!-- <th>Status</th> -->
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>001</td>
            <td>
                <div class="vet-info">
                    <div class="vet-avatar">
                        <img src="<?= ROOT ?>/assets/images/vetAssistant/assistant.jpg" alt="assistant">
                    </div>
                    <div class="vet-details">
                        <span class="vet-name">Kasun Perera</span>
                        <span class="vet-specialization">Small Animal Care</span>
                    </div>
                </div>
            </td>
            <td>
                2025/01/15<br>
                15:00 - 17:00
            </td>
            <td>147, Galthude, Panadura</td>
            <td>10</td>
            <!-- <td>
                <span class="session-status status-confirmed">Confirmed</span>
            </td> -->
            <td>
                <a href="<?= ROOT ?>/DoctorViewSession/session" class="view-btn">
                    <i class='bx bx-right-arrow-circle'></i>
                </a>
            </td>
        </tr>
        <tr>
            <td>002</td>
            <td>
                <div class="vet-info">
                    <div class="vet-avatar">
                        <img src="<?= ROOT ?>/assets/images/vetAssistant/assistantprofile.avif" alt="assistant">
                    </div>
                    <div class="vet-details">
                        <span class="vet-name">Dr. Emily Wong</span>
                        <span class="vet-specialization">Exotic Pets</span>
                    </div>
                </div>
            </td>
            <td>
                2025/01/16<br>
                15:00 - 17:00
            </td>
            <td>22, Main Street, Colombo</td>
            <td>8</td>
            <!-- <td>
                <span class="session-status status-pending">Pending</span>
            </td> -->
            <td>
                <a href="<?= ROOT ?>/DoctorViewSession/session" class="view-btn">
                    <i class='bx bx-right-arrow-circle'></i>
                </a>
            </td>
        </tr>
    </tbody>
</table>
    </div>
</div>
    <script src="<?= ROOT ?>/assets/js/calendar/calendar.js"></script>
    <script>
        const sessionDates = ['2024-11-15', '2024-12-16', '2025-01-20'];
        // this will pass the session dates to calendar for highlighting relevant dates

        const isActiveDate = true;
    
    </script>
        
</body>
</html>