<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salon Profile Edit Form</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/salon/salononetimeallocation.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="form-wrapper">
            <a href="<?=ROOT ?>/SalonTimeSlot" class="pageclose">
                <i class="fa-solid fa-circle-xmark"></i>
            </a>
            <h1 class="form-title">Salon Time Management</h1>
            
            <form id="profileForm" class="profile-form">
                <div class="form-group">
                    <label for="salonOpenTime">
                        <i class="fa-solid fa-clock"></i> Salon Open Time (Usually) <span class="required">*</span>
                    </label>
                    <select id="salonOpenTime" name="salonOpenTime" required>
                        <option value="">Select Open Time</option>
                        <option value="12:00 AM">12:00 AM</option>
                        <option value="1:00 AM">1:00 AM</option>
                        <option value="2:00 AM">2:00 AM</option>
                        <option value="3:00 AM">3:00 AM</option>
                        <option value="4:00 AM">4:00 AM</option>
                        <option value="5:00 AM">5:00 AM</option>
                        <option value="6:00 AM">6:00 AM</option>
                        <option value="7:00 AM">7:00 AM</option>
                        <option value="8:00 AM">8:00 AM</option>
                        <option value="9:00 AM">9:00 AM</option>
                        <option value="10:00 AM">10:00 AM</option>
                        <option value="11:00 AM">11:00 AM</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="salonCloseTime">
                         Salon Close Time (Usually) <span class="required">*</span>
                    </label>
                    <select id="salonCloseTime" name="salonCloseTime" required>
                        <option value="">Select Close Time</option>
                        <option value="12:00 PM">12:00 PM</option>
                        <option value="1:00 PM">1:00 PM</option>
                        <option value="2:00 PM">2:00 PM</option>
                        <option value="3:00 PM">3:00 PM</option>
                        <option value="4:00 PM">4:00 PM</option>
                        <option value="5:00 PM">5:00 PM</option>
                        <option value="6:00 PM">6:00 PM</option>
                        <option value="7:00 PM">7:00 PM</option>
                        <option value="8:00 PM">8:00 PM</option>
                        <option value="9:00 PM">9:00 PM</option>
                        <option value="10:00 PM">10:00 PM</option>
                        <option value="11:00 PM">11:00 PM</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="appointmentDuration">
                        <i class="fa-solid fa-clock"></i> Appointment Duration (Minutes) <span class="required">*</span>
                    </label>
                    <div class="appointment-container">
                        <select id="appointment-duration" name="appointment-duration">
                            <option value="10">10 minutes</option>
                            <option value="20">20 minutes</option>
                            <option value="30">30 minutes</option>
                            <option value="40">40 minutes</option>
                            <option value="50">50 minutes</option>
                            <option value="60">60 minutes</option>
                        </select>
                    </div>

                <div class="form-group">
                <label for="appointmentDuration">
                    <i class="fa-solid fa-clock"></i> Do you have any closing dates ?<span class="required">*</span>
                </label>
                <div class="appointment-container">
                    <select id="appointment-duration" name="appointment-duration">
                        <option value="10">Yes</option>
                        <option value="20">No</option>
                    </select>

                     <!-- yes I want to add the date for it and want to create the add more, delete , edit for this -->
                </div>



                <button type="submit" class="submit-button">
                    <i class="fa-solid fa-save"></i> Save Changes
                </button>
            </form>
        </div>
    </div>
</body>
</html>
