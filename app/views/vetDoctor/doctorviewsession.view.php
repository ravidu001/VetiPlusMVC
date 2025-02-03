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

            <h2 class="session-heading">Upcoming Sessions</h2>
            <table class="sessions-table">
                <thead>
                    <tr>
                        <th>Session</th>
                        <th>Assistant</th>
                        <th>Date & Time</th>
                        <th>Location</th>
                        <th>Appointments</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($sessions as $data): ?>
<tr>
    <td><?= htmlspecialchars($data['session']->sessionID) ?></td>
    <td>
        <?php if (!empty($data['assistants'])): ?>
            <?php if (count($data['assistants']) === 1): ?>
                <!-- Single assistant display -->
                <div class="vet-info">
                    <div class="vet-avatar">
                        <img src="<?= ROOT ?>/assets/images/vetAssistant/<?= htmlspecialchars($data['assistants'][0]->profilePicture) ?>" alt="assistant">
                    </div>
                    <div class="vet-details">
                        <span class="vet-name"><?= htmlspecialchars($data['assistants'][0]->fullName) ?></span>
                        <span class="vet-specialization"><?= htmlspecialchars($data['assistants'][0]->expertise) ?></span>
                    </div>
                </div>
            <?php else: ?>
                <!-- Multiple assistants display -->
                <div class="multiple-assistants">
                    <?php foreach($data['assistants'] as $assistant): ?>
                        <div class="assistant-avatar" title="<?= htmlspecialchars($assistant->fullName) ?> - <?= htmlspecialchars($assistant->expertise) ?>">
                            <img src="<?= ROOT ?>/assets/images/vetAssistant/<?= htmlspecialchars($assistant->profilePicture) ?>" alt="assistant">
                            <div class="assistant-info">
                                <div class="assistant-avatar-large">
                                    <img src="<?= ROOT ?>/assets/images/vetAssistant/<?= htmlspecialchars($assistant->profilePicture) ?>" alt="assistant">
                                </div>
                                <span class="assistant-header"><?= htmlspecialchars($assistant->fullName) ?></span>
                                <span class="assistant-expertise"><?= htmlspecialchars($assistant->expertise) ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <span>No Assistant Assigned</span>
        <?php endif; ?>
    </td>
    <td>
        <?= htmlspecialchars($data['session']->selectedDate) ?><br>
        <?php
        $startTime = new DateTime($data['session']->startTime);
        $endTime = new DateTime($data['session']->endTime);
        ?>
        <?= $startTime->format('H:i') ?> - <?= $endTime->format('H:i') ?>
    </td>
    <td><?= htmlspecialchars($data['session']->clinicLocation) ?></td>
    <td>10</td>
    <td>
        <a href="<?= ROOT ?>/DoctorViewSession/session" class="view-btn">
            <i class='bx bx-right-arrow-circle'></i>
        </a>
    </td>
</tr>
<?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="<?= ROOT ?>/assets/js/calendar/calendar.js"></script>
    <script>
    const sessionDates = ['2024-11-15', '2024-12-16', '2025-01-20'];
    const isActiveDate = true;
    </script>
</body>

</html>