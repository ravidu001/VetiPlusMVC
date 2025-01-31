<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Accepted Requests</title>
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
            <h1>Accepted Requests</h1>
            <!-- <div class="nav-buttons">
                <a href="appointment-requests.html" class="nav-btn">Appointment Requests</a>
                <a href="request-history.html" class="nav-btn">Request History</a>
            </div> -->
        </div>

        <table class="request-table">
            <thead>
                <tr>
                    <th>Doctor</th>
                    <th>Date & Time</th>
                    <th>Location</th>
                    <th>Contact</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="acceptedRequestsTableBody">
                <!-- Rows will be dynamically populated -->
            </tbody>
        </table>
    </div>
</div>

    <script src="<?= ROOT ?>/assets/js/vetAssistant/request.js"></script>
    <script>
        function renderAcceptedRequestsTable() {
            const tableBody = document.getElementById('acceptedRequestsTableBody');
            tableBody.innerHTML = ''; // Clear existing rows
            // window.alert('Accepted Requests Table');
            // Check and move expired requests
            // window.appointmentManager.moveExpiredRequests();

            window.appointmentManager.acceptedRequests.forEach(request => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>
                        <img src="${request.profileImage}" alt="${request.doctor}" class="doctor-profile">
                        ${request.doctor}
                    </td>
                    <td>${request.date}<br>${request.startTime} - ${request.endTime}</td>
                    <td>${request.location}</td>
                    <td>${request.contact}</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-view">View</button>
                        </div>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }

        // Initial render
        renderAcceptedRequestsTable();
    </script>
</body>
</html>