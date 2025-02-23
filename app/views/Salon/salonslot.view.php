<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time Slot View</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>
<body>
        <div>
            <?php include __DIR__ . '/../navbar/salonnav.php'; ?>
        </div>
    <div class="timeslotdetails">
        <div class="selecttime">
            <p>Create time slots for: <span class="highlight">Week</span></p>
        </div>
        <div class="timeslots">
            <h2>Time Slot Details</h2>
            <h4>Time Duration per Slot (minutes):</h4>
            <p>20</p>
            <h4>Appointments per Slot:</h4>
            <p>3</p>
        </div>
        <div class="days">
            <h2>Weekly Schedule</h2>
            <table>
                <thead>
                    <tr>
                        <th>Day</th>
                        <th>Start Time</th>
                        <th>Close Time</th>
                        <th>Closed</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Sunday</td>
                        <td>10:00 AM</td>
                        <td>12:00 PM</td>
                        <td>Yes</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="holidays">
            <h2>Holidays</h2>
            <table>
                <thead>
                    <tr>
                        <th>Day</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2024-05-02</td>
                        <td>
                            <button class="remove-btn">Remove</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
    background-color: #f4f4f9;
}

.timeslotdetails {
    display: grid;
    gap: 20px;
    max-width: 800px;
    margin: auto;
}

.timeslots, .days, .selecttime, .holidays {
    border: 1px solid #ccc;
    border-radius: 8px;
    padding: 16px;
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

h2 {
    margin-top: 0;
    color: #333;
}

h4 {
    margin: 8px 0 4px;
}

p {
    margin: 4px 0;
    font-size: 16px;
    color: #555;
}

.selecttime .highlight {
    font-weight: bold;
    color: #007BFF;
}

button.remove-btn {
    padding: 6px 12px;
    border: none;
    border-radius: 4px;
    background-color: #dc3545;
    color: white;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button.remove-btn:hover {
    background-color: #c82333;
}

/* Table Styles */

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 8px;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
}

th {
    background-color: #007BFF;
    color: white;
}

td {
    color: #333;
}

/* Responsive Design */

@media (max-width: 600px) {
    .timeslotdetails {
        display: block;
    }

    table {
        font-size: 14px;
    }
}

</style>

