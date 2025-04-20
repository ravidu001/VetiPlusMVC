<?php
// Create an instance of the Notification controller
$notification = new Notification();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Accepted Requests</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/vetAssistant/request.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/doctornav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/common/notification.css">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
<?php require_once '../app/views/navbar/assistantnav.php'; ?>
<div class="home">
    <?php echo $notification->display(); ?>
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
            <?php if (!empty($data['consolidatedData'])): ?>
                    <?php foreach ($data['consolidatedData'] as $request): ?>
                        <tr>
                            <td>
                                <img src="<?= ROOT ?>/assets/images/vetDoctor/<?= htmlspecialchars($request['doctor']->profilePicture) ?>" alt="Profile Picture" class="doctor-profile"><br>
                                <?= htmlspecialchars($request['doctor']->fullName) ?><br>
                                Gender: <?= htmlspecialchars($request['doctor']->gender) ?><br>
                                <?php
                                    $dob = new DateTime($request['doctor']->DOB); // Create a DateTime object for the DOB
                                    $currentDate = new DateTime(); // Get the current date
                                    $age = $currentDate->diff($dob)->y; // Calculate the difference in years
                                ?>
                                Age: <?= htmlspecialchars($age) ?>
                            </td>
                            <td>
                                <?= htmlspecialchars($request['session']->selectedDate) ?><br>
                                <?php
                                    $startTime = new DateTime($request['session']->startTime);
                                    $endTime = new DateTime($request['session']->endTime);
                                ?>
                                <?= htmlspecialchars($startTime->format('H:i')) ?> - <?= htmlspecialchars($endTime->format('H:i')) ?>
                            </td>
                            <td><?= htmlspecialchars($request['session']->clinicLocation) ?></td>
                            <td><?= htmlspecialchars($request['doctor']->contactNumber) ?></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-reject">
                                        <a href="<?= ROOT ?>/assisaccepted/reject?sessionID=<?= urlencode($request['session']->sessionID) ?>&assistantID=<?= urlencode($request['assisSession']->assistantID) ?>&selectedDate=<?= urlencode($request['session']->selectedDate) ?>" class="btn-reject">Reject</a>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No accepted appointments available.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

    
</body>
</html>