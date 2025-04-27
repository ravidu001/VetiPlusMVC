<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Veterinary Session Management</title>
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/doctornav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/calendar/calendar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/vetDoctor/sessionview.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

</head>
<body>
<?php require_once '../app/views/navbar/doctornav.php'; ?>
<div class="home">
    <div class="session-container">
        <a href="<?= ROOT ?>/DoctorViewSession/index" class="view-btn" title="Back">
            <i class='bx bx-left-arrow-circle'></i>
        </a>
        <div class="session-header">
            <h2>Veterinary Session Details</h2>
        </div>

        
        <?php
            $startTime = new DateTime($sessionsDetails[0]['session']->startTime);
            $endTime = new DateTime($sessionsDetails[0]['session']->endTime);
        ?>
        

        <div class="session-details">
            <div class="detail-item">
                <div class="detail-label">Start Date and Time</div>
                <div class="detail-value"><?= htmlspecialchars($sessionsDetails[0]['session']->selectedDate) ?>, <?= $startTime->format('H:i') ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">End Date and Time</div>
                <div class="detail-value"><?= htmlspecialchars($sessionsDetails[0]['session']->selectedDate) ?>, <?= $endTime->format('H:i') ?></div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Address</div>
                <div class="detail-value"><?= htmlspecialchars($sessionsDetails[0]['session']->clinicLocation) ?></div>
            </div>
        </div>

        <div class="detail-item" style="margin-top: 20px; margin-bottom: 10px;">
            <div class="detail-label">Assistant Details</div>
        </div>
        <?php if (!empty($sessionsDetails[0]['assistants'])): ?>
            <?php $n=0; ?>
            <?php foreach($sessionsDetails[0]['assistants'] as $assistant): ?>
                <div class="assistant-profile">
                    <div class="assistant-avatar">
                        <img src="<?= ROOT ?>/assets/images/vetAssistant/<?= htmlspecialchars($assistant->profilePicture) ?>" alt="Assistant">
                    </div>
                    <div class="assistant-info">
                        <h3><?= htmlspecialchars($assistant->fullName) ?></h3>
                        <p><?= htmlspecialchars($assistant->expertise) ?> | <?= htmlspecialchars($assistant->experience) ?> Years Experience</p>
                        <div id="assistant-rating"></div>
                        <div>Hourly Rate: $<?= htmlspecialchars($assistant->chargePerHour) ?>/hr</div>
                        <div> Request Status: <?= ucfirst(htmlspecialchars($actionArray[$n])) ?></div>
                    </div>
                </div>
                <?php $n++; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="assistant-profile">
                <span>No Assistant Assigned</span>
            </div>
        <?php endif; ?>

        <div class="session-container">
        <div class="status-buttons">
            <button class="btn btn-queue active" data-target="queue">Queue</button>
            <button class="btn btn-queue" data-target="completed">Completed</button>
            <button class="btn btn-queue" data-target="cancelled">Cancelled</button>
        </div>

        <div id="queue" class="animated-section">
            <table class="appointment-table">
                <thead>
                    <tr>
                        <th>Owner Name</th>
                        <th>Pet Profile</th>
                        <th>Pet Details</th>
                        <th>Contact</th>
                        <th>Session Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($appointmentsDetails as $session) : ?>
                        <?php 
                            // check the status of the appointment
                            if ($session['appointment']->status == 'completed' || $session['appointment']->status == 'cancelled') {
                                continue; // Skip completed appointments
                            }
                        ?>
                            <?php
                                // Calculate the age in years and months
                                $dob = date_create($session['pet']->DOB);
                                $now = date_create('now');
                                $ageDiff = date_diff($dob, $now);
                                $years = $ageDiff->y;
                                $months = $ageDiff->m;

                                // Format the age as "Nyr Mmons"
                                $ageFormatted = "{$years}yr " . ($months > 0 ? "{$months}mons" : "");
                            ?>
                            
                            <tr data-appointment-id="<?= htmlspecialchars($session['appointment']->appointmentID) ?>"
                                data-owner="<?= htmlspecialchars($session['petOwner']->fullName) ?>" 
                                data-pet-img="<?= ROOT ?>/assets/images/common/<?= htmlspecialchars($session['pet']->profilePicture) ?>" 
                                data-pet-name="<?= htmlspecialchars($session['pet']->name) ?>" 
                                data-pet-type="<?= htmlspecialchars($session['pet']->breed) ?>" 
                                data-pet-age="<?= $ageFormatted ?>" 
                                data-contact="<?= htmlspecialchars($session['petOwner']->contactNumber) ?>" 
                                data-session="<?= htmlspecialchars($session['appointment']->visitTime) ?>"> 
                                <td><?= htmlspecialchars($session['petOwner']->fullName) ?></td>
                                <td>
                                    <div class="pet-profile">
                                        <img src="<?= ROOT ?>/assets/images/common/<?= htmlspecialchars($session['pet']->profilePicture) ?>" alt="Pet">
                                    </div>
                                </td>
                                <td>
                                    <p><?= htmlspecialchars($session['pet']->name) ?></p>
                                    <p><?= htmlspecialchars($session['pet']->breed) ?></p>
                                    <p><?= $ageFormatted ?></p>
                                </td>
                                <td><?= htmlspecialchars($session['petOwner']->contactNumber) ?></td>
                                <td><?= htmlspecialchars($session['appointment']->visitTime) ?></td>
                                <td class="table-actions">
                                    <button class="table-btn btn-complete">Completed</button>
                                    <button class="table-btn btn-cancel">Cancelled</button>
                                </td>
                            </tr>
                    <?php endforeach; ?>      
                </tbody>
            </table>
        </div>

        <div id="completed" class="animated-section" style="display:none;">
            <table class="appointment-table">
                <thead>
                    <tr>
                        <th>Owner Name</th>
                        <th>Pet Profile</th>
                        <th>Pet Details</th>
                        <th>Contact</th>
                        <th>Session Time</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Completed appointments will be dynamically added here -->
                    <?php foreach ($appointmentsDetails as $session) : ?>
                        <?php 
                            // check the status of the appointment
                            if ($session['appointment']->status != 'completed') {
                                continue; // Skip non-completed appointments
                            }
                        ?>
                        <?php
                            // Calculate the age in years and months
                            $dob = date_create($session['pet']->DOB);
                            $now = date_create('now');
                            $ageDiff = date_diff($dob, $now);
                            $years = $ageDiff->y;
                            $months = $ageDiff->m;

                            // Format the age as "Nyr Mmons"
                            $ageFormatted = "{$years}yr " . ($months > 0 ? "{$months}mons" : "");
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($session['petOwner']->fullName) ?></td>
                            <td>
                                <div class="pet-profile">
                                    <img src="<?= ROOT ?>/assets/images/common/<?= htmlspecialchars($session['pet']->profilePicture) ?>" alt="Pet">
                                </div>
                            </td>
                            <td>
                            <p><?= htmlspecialchars($session['pet']->name) ?></p>
                                <p><?= htmlspecialchars($session['pet']->breed) ?></p>
                                <p><?= $ageFormatted ?></p>
                            </td>
                            <td><?= htmlspecialchars($session['petOwner']->contactNumber) ?></td>
                            <td><?= htmlspecialchars($session['appointment']->visitTime) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div id="cancelled" class="animated-section" style="display:none;">
            <table class="appointment-table">
                <thead>
                    <tr>
                        <th>Owner Name</th> <th>Pet Profile</th>
                        <th>Pet Details</th>
                        <th>Contact</th>
                        <th>Session Time</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Cancelled appointments will be dynamically added here -->
                    <?php foreach ($appointmentsDetails as $session) : ?>
                        <?php 
                            // check the status of the appointment
                            if ($session['appointment']->status != 'cancelled') {
                                continue; // Skip non-completed appointments
                            }
                        ?>
                        <?php
                            // Calculate the age in years and months
                            $dob = date_create($session['pet']->DOB);
                            $now = date_create('now');
                            $ageDiff = date_diff($dob, $now);
                            $years = $ageDiff->y;
                            $months = $ageDiff->m;

                            // Format the age as "Nyr Mmons"
                            $ageFormatted = "{$years}yr " . ($months > 0 ? "{$months}mons" : "");
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($session['petOwner']->fullName) ?></td>
                            <td>
                                <div class="pet-profile">
                                    <img src="<?= ROOT ?>/assets/images/common/<?= htmlspecialchars($session['pet']->profilePicture) ?>" alt="Pet">
                                </div>
                            </td>
                            <td>
                            <p><?= htmlspecialchars($session['pet']->name) ?></p>
                                <p><?= htmlspecialchars($session['pet']->breed) ?></p>
                                <p><?= $ageFormatted ?></p>
                            </td>
                            <td><?= htmlspecialchars($session['petOwner']->contactNumber) ?></td>
                            <td><?= htmlspecialchars($session['appointment']->visitTime) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

    <script src="<?= ROOT ?>/assets/js/vetDoctor/sessionview.js"></script>
</body>
</html>