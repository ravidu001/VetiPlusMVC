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
        <form id="session-form" method="post" action="<?= ROOT ?>/doctorNewSession/createSession" enctype="multipart/form-data">
            <div class="form-group">
                <label>Selected Date</label>
                <input type="text" id="selected-date" name="selectedDate" class="form-input" placeholder="select date from calendar" readonly>
            </div>
            
                <div class="form-group">
                    <label>Start Time</label>
                    <input type="time" name="startTime" class="form-input" required>
                </div>
                <div class="form-group">
                    <label>End Time</label>
                    <input type="time" name="endTime" class="form-input" required>
                </div>
                <div class="form-group">
                    <label>Clinic Location</label>
                    <input type="text" name="clinicLocation" class="form-input" placeholder="Enter Google Map Location" required>
                </div>
                <div class="form-group">
                    <label for="district">District</label>
                    <select id="district" name="district" class="form-input" required>
                        <option value="" disabled selected>Select a district</option>
                        <option value="Ampara">Ampara</option>
                        <option value="Anuradhapura">Anuradhapura</option>
                        <option value="Badulla">Badulla</option>
                        <option value="Batticaloa">Batticaloa</option>
                        <option value="Colombo">Colombo</option>
                        <option value="Galle">Galle</option>
                        <option value="Gampaha">Gampaha</option>
                        <option value="Hambantota">Hambantota</option>
                        <option value="Jaffna">Jaffna</option>
                        <option value="Kalutara">Kalutara</option>
                        <option value="Kandy">Kandy</option>
                        <option value="Kegalle">Kegalle</option>
                        <option value="Kilinochchi">Kilinochchi</option>
                        <option value="Kurunegala">Kurunegala</option>
                        <option value="Mannar">Mannar</option>
                        <option value="Matale">Matale</option>
                        <option value="Matara">Matara</option>
                        <option value="Monaragala">Monaragala</option>
                        <option value="Nuwara Eliya">Nuwara Eliya</option>
                        <option value="Polonnaruwa">Polonnaruwa</option>
                        <option value="Puttalam">Puttalam</option>
                        <option value="Ratnapura">Ratnapura</option>
                        <option value="Trincomalee">Trincomalee</option>
                        <option value="Vavuniya">Vavuniya</option>
                    </select>
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
                        <select name="filterDistrict" id="filterDistrict" class="form-input" required>
                            <option value="" disabled selected>Select a district</option>
                            <option value="Ampara">Ampara</option>
                            <option value="Anuradhapura">Anuradhapura</option>
                            <option value="Badulla">Badulla</option>
                            <option value="Batticaloa">Batticaloa</option>
                            <option value="Colombo">Colombo</option>
                            <option value="Galle">Galle</option>
                            <option value="Gampaha">Gampaha</option>
                            <option value="Hambantota">Hambantota</option>
                            <option value="Jaffna">Jaffna</option>
                            <option value="Kalutara">Kalutara</option>
                            <option value="Kandy">Kandy</option>
                            <option value="Kegalle">Kegalle</option>
                            <option value="Kilinochchi">Kilinochchi</option>
                            <option value="Kurunegala">Kurunegala</option>
                            <option value="Mannar">Mannar</option>
                            <option value="Matale">Matale</option>
                            <option value="Matara">Matara</option>
                            <option value="Monaragala">Monaragala</option>
                            <option value="Nuwara Eliya">Nuwara Eliya</option>
                            <option value="Polonnaruwa">Polonnaruwa</option>
                            <option value="Puttalam">Puttalam</option>
                            <option value="Ratnapura">Ratnapura</option>
                            <option value="Trincomalee">Trincomalee</option>
                            <option value="Vavuniya">Vavuniya</option>
                        </select>
                    </div>
                    <div class="assistant-grid" id="assistantList">
                        <!-- <div class="assistant-card">
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
                        </div> -->
                        <!-- Repeat similar structure for other assistants -->
                    </div>
                </div>
                <div class="submit-section">
                    <button type="button" class="btn btn-secondary" onclick="resetForm()">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="submit-button">Create Session</button>
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