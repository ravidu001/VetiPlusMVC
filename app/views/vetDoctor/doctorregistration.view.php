<?php
// Create an instance of the Notification controller
$notification = new Notification();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veterinarian Registration</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/common/notification.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/vetDoctor/registration.css">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
</head>
<body>
    <?php echo $notification->display(); ?>
    <div class="registration-container">
        <div class="registration-illustration">
            <img src="<?= ROOT ?>/assets/images/vetDoctor/vetreg.png" alt="Veterinarian Illustration">
            <h2>Veterinarian Registration</h2>
            <p>Join our professional network and expand your veterinary practice.</p>
        </div>
        
        <form class="registration-form" id="vetRegistrationForm" action="<?= ROOT ?>/doctorRegistration/register" method="POST" enctype="multipart/form-data">
            <div class="form-steps">
                <div class="step active">1</div>
                <div class="step">2</div>
                <div class="step">3</div>
            </div>

            <!-- Personal Information -->
            <div class="form-section active" id="personalInfo">
                <h3>Personal Information</h3>
                <div class="form-group">
                    <label for="name">Full Name <div style="color:red; padding-left:5px;">*</div></label>
                    <input type="text" id="name" class="form-input" name="name" required placeholder="Enter your full name">
                </div>
                <div class="form-group">
                    <label for="address">Permanent Address <div style="color:red; padding-left:5px;">*</div></label>
                    <input type="text" id="address" class="form-input" name="address" required placeholder="Enter your permanent address">
                </div>
                <div class="form-group">
                    <label for="DOB">Date of Birth <div style="color:red; padding-left:5px;">*</div></label>
                    <input type="date" id="DOB" class="form-input" name="DOB" required>
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile Number <div style="color:red; padding-left:5px;">*</div></label>
                    <input type="text" id="mobile" class="form-input" name="mobile" required placeholder="Enter your 10-digit mobile number">
                </div>
                <div class="form-group">
                    <label for="gender">Gender <div style="color:red; padding-left:5px;">*</div></label>
                    <select id="gender" class="form-input" name="gender" required>
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="bio">Bio <div style="color:red; padding-left:5px;">*</div></label>
                    <textarea id="bio" class="form-input" name="bio" required placeholder="Enter a short biography"></textarea>
                </div>
                <div class="navigation-buttons">
                    <button type="button" class="btn btn-secondary" disabled>Previous</button>
                    <button type="button" class="btn btn-primary next-step">Next</button>
                </div>
            </div>

            <!-- Professional Details -->
            <div class="form-section" id="professionalInfo">
                <h3>Professional Details</h3>
                <div class="form-group">
                    <label for="lnumber">License Number <div style="color:red; padding-left:5px;">*</div></label>
                    <input type="text" id="lnumber" class="form-input" name="lnumber" required placeholder="Enter your license number">
                </div>
                <div class="form-group">
                    <label for="special">Specialization <div style="color:red; padding-left:5px;">*</div></label>
                    <select id="special" class="form-input" name="special" required>
                        <option value="">Select Specialization</option>
                        <option value="Small Animal Care">Small Animal Care</option>
                        <option value="Large Animal Medicine">Large Animal Medicine</option>
                        <option value="Exotic Pet Care">Exotic Pet Care</option>
                        <option value="Wildlife Conservation">Wildlife Conservation</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="experience">Years of Experience <div style="color:red; padding-left:5px;">*</div></label>
                    <input type="number" id="experience" class="form-input" name="experience" min="0" max="50" required placeholder="Enter your years of experience">
                </div>
                <div class="form-group">
                    <label for="timeSlot">Time Taken for a Treatment (minutes) <div style="color:red; padding-left:5px;">*</div></label>
                    <input type="number" id="timeSlot" class="form-input" name="timeSlot" min="1" required placeholder="Enter time in minutes">
                </div>
                <div class="navigation-buttons">
                    <button type="button" class="btn btn-secondary previous-step">Previous</button>
                    <button type="button" class="btn btn-primary next-step">Next</button>
                </div>
            </div>

            <!-- Certification Upload -->
            <div class="form-section" id="uploadInfo">
                <h3>Upload Certification</h3>
                <div class="form-group file-upload">
                    <label for="doctorCertificate">Upload Professional Certificate <div style="color:red; padding-left:5px;">*</div></label>
                    <input type="file" id="doctorCertificate" name="doctorCertificate" accept=".pdf,.jpg,.png" required>
                </div>
                <div class="navigation-buttons">
                    <button type="button" class="btn btn-secondary previous-step">Previous</button>
                    <button type="submit" class="btn btn-primary">Complete Registration</button>
                </div>
            </div>
        </form>
    </div>

    <script src="<?= ROOT ?>/assets/js/vetDoctor/registration.js"></script>
</body>
</html>
