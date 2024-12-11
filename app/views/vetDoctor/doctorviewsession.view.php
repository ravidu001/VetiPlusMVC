<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vet Sessions Scheduler</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/calendar/calendar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/doctornav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/vetDoctor/">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        /* Root Variables */
        :root {
            --body-color: #E4E9F7;
            --sidebar-color: #FFF;
            --primary-color: #6a0dad;
            --secondary-color: #9c27b0;
            --text-color: #707070;
            --background-light: #f4f4f8;
            --white: #ffffff;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            /* display: flex;
            justify-content: center;
            align-items: center; */
            min-height: 100vh;
            padding: 20px;
        }
           
        .container {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
            margin-bottom: 20px;
            padding: 0px;
            background: var(--white);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        /*
        .calendar-section {
            background: linear-gradient(145deg, var(--primary-color), var(--secondary-color));
            border-radius: 15px;
            padding: 30px;
            color: var(--white);
            margin-bottom: 30px;
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 10px;
            text-align: center;
        }

        .calendar-day {
            padding: 12px;
            border-radius: 10px;
            cursor: pointer;
            transition: var(--transition);
        }

        .calendar-day.current-date {
            background-color: rgba(255,255,255,0.2);
            font-weight: bold;
        }

        .calendar-day.session-date {
            background-color: var(--white);
            color: var(--primary-color);
            font-weight: bold;
        }

        .calendar-day.future-date:hover {
            background-color: rgba(255,255,255,0.3);
            transform: scale(1.05);
        } */

        .session-heading {
            font-size: 1.5em;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 20px;
            margin-left: 20px;
            margin-top: 20px;
        }
        /* Enhanced Sessions Table Styling */
.sessions-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 10px;
    margin: 0 auto;
    padding-left: 10px;
    padding-right: 10px;
    border-radius: 15px;
}

.sessions-table thead {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: var(--white);
}

.sessions-table th {
    padding: 15px;
    text-align: left;
    text-transform: uppercase;
    font-weight: 600;
    letter-spacing: 1px;
}

.sessions-table tbody tr {
    background-color: var(--white);
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
    transition: var(--transition);
    position: relative;
    overflow: hidden;
}

.sessions-table tbody tr::before {
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 5px;
    background: var(--primary-color);
    transition: var(--transition);
}

.sessions-table tbody tr:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.12);
}

.sessions-table tbody tr:hover::before {
    width: 8px;
}

.sessions-table td {
    padding: 15px;
    vertical-align: middle;
    color: var(--text-color);
}

/* Status and Badge Styling */
.session-status {
    display: inline-flex;
    align-items: center;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 0.8em;
    font-weight: 600;
}

.status-confirmed {
    background-color: rgba(40, 167, 69, 0.1);
    color: #28a745;
}

.status-pending {
    background-color: rgba(255, 193, 7, 0.1);
    color: #ffc107;
}

/* Action Buttons */
.session-actions {
    display: flex;
    gap: 10px;
    justify-content: center;
}

.view-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: var(--background-light);
    color: var(--primary-color);
    transition: var(--transition);
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
}

.view-btn:hover {
    background-color: var(--primary-color);
    color: var(--white);
    transform: scale(1.1) rotate(360deg);
}

/* Veterinarian Info */
.vet-info {
    display: flex;
    align-items: center;
}

.vet-avatar {
    border-radius: 50%;
    border: 2px solid var(--primary-color);
    height: 50px;
    width: 50px;
    overflow: hidden;
    margin-right: 10px;
}

.vet-avatar img{
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}

.vet-details {
    display: flex;
    flex-direction: column;
}

.vet-name {
    font-weight: 600;
    color: var(--text-color);
}

.vet-specialization {
    font-size: 0.8em;
    color: var(--secondary-color);
}
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
                <a href="#" class="view-btn">
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
                <a href="#" class="view-btn">
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