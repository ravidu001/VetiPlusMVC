<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Veterinary Session Scheduler</title>
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/doctornav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/calendar/calendar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/vetDoctor/newsession.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body>
<?php require_once '../app/views/navbar/doctornav.php'; ?>
<div class="home">
    <div class="session-scheduler">
        <?php require_once '../app/views/calendar.view.php'; ?>

        <div class="session-form-section"> <h2>Create Session</h2>
            <div class="form-group">
                <label>Selected Date</label>
                <input type="text" id="selected-date" class="form-input" readonly>
            </div>
            <form id="session-form">
                <div class="form-group">
                    <label>Start Time</label>
                    <input type="time" class="form-input" required>
                </div>
                <div class="form-group">
                    <label>End Time</label>
                    <input type="time" class="form-input" required>
                </div>
                <div class="form-group">
                    <label>Need Assistant?</label>
                    <div class="assistant-toggle">
                        <input type="radio" name="assistant" value="no" checked onclick="toggleAssistantSection()"> No
                        <input type="radio" name="assistant" value="yes" onclick="toggleAssistantSection()"> Yes
                    </div>
                </div>
                <div id="assistant-select" class="assistant-section">
                    <div class="assistant-filter">
                        <label for="filterDistrict">Filter by district:</label>
                        <input type="text" id="filterDistrict" class="form-input">
                    </div>
                    <div class="assistant-grid">
                        <div class="assistant-card">
                            <div class="assistant-avatar">
                                <img src="<?= ROOT ?>/assets/images/vetAssistant/assistant.jpg" alt="assistant">
                            </div>
                            <div class="assistant-details">
                                <div class="details-header">
                                    <h4>John Doe</h4>
                                    <div class="hourly-rate">
                                        <span>$50</span>
                                        <small>/hr</small>
                                    </div>
                                </div>
                                <div class="rating">
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-half-line"></i>
                                    4.5
                                </div>
                                <div class="assistant-badges">
                                    <span class="badge">Age: 28</span>
                                    <span class="badge">Exp: 3 Yrs</span>
                                </div>
                            </div>
                            <label class="custom-checkbox">
                                <input type="checkbox" name="assistant-select">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="assistant-card">
                            <div class="assistant-avatar">
                                <img src="<?= ROOT ?>/assets/images/vetAssistant/assistantprofile.avif" alt="assistant">
                            </div>
                            <div class="assistant-details">
                                <div class="details-header">
                                    <h4>John Doe</h4>
                                    <div class="hourly-rate">
                                        <span>$50</span>
                                        <small>/hr</small>
                                    </div>
                                </div>
                                <div class="rating">
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-half-line"></i>
                                    4.5
                                </div>
                                <div class="assistant-badges">
                                    <span class="badge">Age: 28</span>
                                    <span class="badge">Exp: 3 Yrs</span>
                                </div>
                            </div>
                            <label class="custom-checkbox">
                                <input type="checkbox" name="assistant-select">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <!-- Repeat similar structure for other assistants -->
                    </div>
                </div>
                <div class="submit-section">
                    <button type="button" class="btn btn-secondary" onclick="resetForm()">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Session</button>
                </div>
            </form>
        </div>
    </div>
</div>
    <script src="<?= ROOT ?>/assets/js/vetDoctor/newsession.js"></script>
    <script src="<?= ROOT ?>/assets/js/calendar/calendar.js"></script>
    <script>
        const sessionDates = [''];
    </script>
</body>
</html>