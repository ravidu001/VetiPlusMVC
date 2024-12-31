<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <title>VetiPlus - Appointments Dashboard</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/adminnav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/appointment.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
 
</head>
<body>
<?php require_once '../app/views/navbar/adminnav.php'; ?>

    <section class="home">
        <div class="main-container">
        <div class="appointment-stats">
            <div class="stat-card">
                <h3>Daily Appointments</h3>
                <div class="stat-number">345</div>
            </div>
            <div class="stat-card">
                <h3>Canceled Appointments</h3>
                <div class="stat-number">23</div>
            </div>
            <div class="stat-card">
                <h3>Total Appointments</h3>
                <div class="stat-number">2,356</div>
            </div>
        </div>

        <div class="appointment-search">
            <form class="search-form"  action="<?= ROOT ?>/AdminAppointment/appointmentlist" method="post" >
                <div class="search-inputs">
                    <input type="text" placeholder="Enter User ID">
                    <input type="text" placeholder="Enter Pet ID">
                    <input type="date">
                </div>
                <button type="submit" class="search-btn">Search Appointments</button>
            </form>
        </div>

        <div class="appointments-list">
            <table class="appointments-table">
                <thead>
                    <tr>
                        <th>Appointment ID</th>
                        <th>Pet Name</th>
                        <th>Owner</th>
                        <th>Date</th>
                        <th>Time</th>
                         <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>001</td>
                        <td>Buddy</td>
                        <td>John Doe</td>
                        <td>2023-10-01</td>
                        <td>10:00 AM</td>
                        <td><span class="status-badge status-confirmed">Confirmed</span></td>
                      
                    </tr>
                    <tr>
                        <td>002</td>
                        <td>Max</td>
                        <td>Jane Smith</td>
                        <td>2023-10-01</td>
                        <td>11:00 AM</td>
                        <td><span class="status-badge status-pending">Pending</span></td>
                      
                    </tr>
                    <tr>
                        <td>003</td>
                        <td>Charlie</td>
                        <td>Emily Johnson</td>
                        <td>2023-10-01</td>
                        <td>01:00 PM</td>
                        <td><span class="status-badge status-cancelled">Cancelled</span></td>
                        
                    </tr>
                    <tr>
                        <td>004</td>
                        <td>Lucy</td>
                        <td>Michael Brown</td>
                        <td>2023-10-02</td>
                        <td>09:00 AM</td>
                        <td><span class="status-badge status-confirmed">Confirmed</span></td>
                       
                    </tr>
                    <tr>
                        <td>005</td>
                        <td>Rocky</td>
                        <td>Sarah Wilson</td>
                        <td>2023-10-02</td>
                        <td>02:00 PM</td>
                        <td><span class="status-badge status-pending">Pending</span></td>
                       
                    </tr>
                </tbody>
            </table>
        </div>
        </div>
    </section>
</body>
</html>