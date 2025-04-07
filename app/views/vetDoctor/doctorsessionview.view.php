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
                    </div>
                </div>
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
                    <tr data-owner="John Doe" data-pet-img="<?= ROOT ?>/assets/images/common/dogProfileimage.jpg" data-pet-name="Roky" data-pet-type="Labrador" data-pet-age="2 years" data-contact="0771234567" data-session="15:00"> 
                        <td>John Doe</td>
                        <td>
                            <div class="pet-profile">
                                <img src="<?= ROOT ?>/assets/images/common/dogProfileimage.jpg" alt="Pet">
                            </div>
                        </td>
                        <td>
                            <p>Roky</p>
                            <p>Labrador</p>
                            <p>2 years</p>
                        </td>
                        <td>0771234567</td>
                        <td>15:00</td>
                        <td class="table-actions">
                            <button class="table-btn btn-complete">Completed</button>
                            <button class="table-btn btn-cancel">Cancelled</button>
                        </td>
                    </tr>
                    <tr data-owner="Jane Doe" data-pet-img="<?= ROOT ?>/assets/images/common/dogProfileimage.jpg" data-pet-name="Tom" data-pet-type="Persian" data-pet-age="1 year" data-contact="0777654321" data-session="16:30">
                        <td>Jane Doe</td>
                        <td>
                            <div class="pet-profile">
                                <img src="<?= ROOT ?>/assets/images/common/dogProfileimage.jpg" alt="Pet">
                            </div>
                        </td>
                        <td>
                            <p>Tom</p>
                            <p>Persian</p>
                            <p>1 year</p>
                        </td>
                        <td>0777654321</td>
                        <td>15:30</td>
                        <td class="table-actions">
                            <button class="table-btn btn-complete">Completed</button>
                            <button class="table-btn btn-cancel">Cancelled</button>
                        </td>
                    </tr>
                    <tr data-owner="Jane Doe" data-pet-img="<?= ROOT ?>/assets/images/common/dogProfileimage.jpg" data-pet-name="Tom" data-pet-type="Persian" data-pet-age="1 year" data-contact="0777654321" data-session="16:30">
                        <td>Jane Doe</td>
                        <td>
                            <div class="pet-profile">
                                <img src="<?= ROOT ?>/assets/images/common/dogProfileimage.jpg" alt="Pet">
                            </div>
                        </td>
                        <td>
                            <p>Tom</p>
                            <p>Persian</p>
                            <p>1 year</p>
                        </td>
                        <td>0777654321</td>
                        <td>16:00</td>
                        <td class="table-actions">
                            <button class="table-btn btn-complete">Completed</button>
                            <button class="table-btn btn-cancel">Cancelled</button>
                        </td>
                    </tr>
                    <tr data-owner="Jane Doe" data-pet-img="<?= ROOT ?>/assets/images/common/dogProfileimage.jpg" data-pet-name="Tom" data-pet-type="Persian" data-pet-age="1 year" data-contact="0777654321" data-session="16:30">
                        <td>Jane Doe</td>
                        <td>
                            <div class="pet-profile">
                                <img src="<?= ROOT ?>/assets/images/common/dogProfileimage.jpg" alt="Pet">
                            </div>
                        </td>
                        <td>
                            <p>Tom</p>
                            <p>Persian</p>
                            <p>1 year</p>
                        </td>
                        <td>0777654321</td>
                        <td>16:30</td>
                        <td class="table-actions">
                            <button class="table-btn btn-complete">Completed</button>
                            <button class="table-btn btn-cancel">Cancelled</button>
                        </td>
                    </tr>
                    <tr data-owner="Jane Doe" data-pet-img="<?= ROOT ?>/assets/images/common/dogProfileimage.jpg" data-pet-name="Tom" data-pet-type="Persian" data-pet-age="1 year" data-contact="0777654321" data-session="16:30">
                        <td>Jane Doe</td>
                        <td>
                            <div class="pet-profile">
                                <img src="<?= ROOT ?>/assets/images/common/dogProfileimage.jpg" alt="Pet">
                            </div>
                        </td>
                        <td>
                            <p>Tom</p>
                            <p>Persian</p>
                            <p>1 year</p>
                        </td>
                        <td>0777654321</td>
                        <td>17:00</td>
                        <td class="table-actions">
                            <button class="table-btn btn-complete">Completed</button>
                            <button class="table-btn btn-cancel">Cancelled</button>
                        </td>
                    </tr>
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
                </tbody>
            </table>
        </div>
    </div>
</div>

    <script src="<?= ROOT ?>/assets/js/vetDoctor/sessionview.js"></script>
</body>
</html>