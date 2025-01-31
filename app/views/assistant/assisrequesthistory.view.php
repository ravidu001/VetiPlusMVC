<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Request History</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/vetAssistant/request.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/doctornav.css">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
<?php require_once '../app/views/navbar/assistantnav.php'; ?>
<div class="home">
    <div class="container">
        <div class="page-header">
            <h1>Request History</h1>
            <!-- <div class="nav-buttons">
                <a href="appointment-requests.html" class="nav-btn">Appointment Requests</a>
                <a href="accepted-requests.html" class="nav-btn">Accepted Requests</a>
            </div> -->
        </div>

        <table class="request-table">
            <thead>
                <tr>
                    <th>Doctor</th>
                    <th>Date & Time</th>
                    <th>Location</th>
                    <th>Contact</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="historyTableBody">
                <!-- Rows will be dynamically populated -->
            </tbody>
        </table>
    </div>
</div>

    <script src="<?= ROOT ?>/assets/js/vetAssistant/request.js"></script>
    <script>
        function renderHistoryTable() {
            const tableBody = document.getElementById('historyTableBody');
            tableBody.innerHTML = ''; // Clear existing rows

            window.appointmentManager.historyRequests.forEach(request => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>
                        <img src="${request.profileImage}" alt="${request.doctor}" class="doctor-profile">
                        ${request.doctor}
                    </td>
                    <td>${request.date}<br>${request.startTime} - ${request.endTime}</td>
                    <td>${request.location}</td>
                    <td>${request.contact}</td>
                    <td class="${request.status === 'Rejected' ? 'status-rejected' : 'status-completed'}">${request.status}</td>
                `;
                tableBody.appendChild(row);
            });
        }

        // Initial render
        renderHistoryTable();
    </script>
</body>
</html>