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
        
        <form class="registration-form" id="vetRegistrationForm" action="<?= ROOT ?>/doctorRegistration/updatedoctordata" method="POST" enctype="multipart/form-data">
            <div class="form-steps">
                <div class="step active">1</div>
                <div class="step">2</div>
                <div class="step">3</div>
            </div>

            <!-- Personal Information -->
            <div class="form-section active" id="personalInfo">
                <h3>Personal Information</h3>
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" class="form-input" name="name" required placeholder="Enter your full name" value="<?= isset($doctorDetails->fullName) ? htmlspecialchars($doctorDetails->fullName) : '' ?>">
                </div>
                <div class="form-group">
                    <label for="address">Permanent Address</label>
                    <input type="text" id="address" class="form-input" name="address" required placeholder="Enter your permanent address" value="<?= isset($doctorDetails->address) ? htmlspecialchars($doctorDetails->address) : '' ?>">
                </div>
                <div class="form-group">
                    <label for="DOB">Date of Birth</label>
                    <input type="date" id="DOB" class="form-input" name="DOB" required value="<?= isset($doctorDetails->DOB) ? htmlspecialchars($doctorDetails->DOB) : '' ?>">
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile Number</label>
                    <input type="text" id="mobile" class="form-input" name="mobile" required placeholder="Enter your 10-digit mobile number" value="<?= isset($doctorDetails->contactNumber) ? htmlspecialchars($doctorDetails->contactNumber) : '' ?>">
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select id="gender" class="form-input" name="gender" required>
                        <option value="">Select Gender</option>
                        <option value="Male" <?= isset($doctorDetails->gender) && $doctorDetails->gender == 'Male' ? 'selected' : '' ?>>Male</option>
                        <option value="Female" <?= isset($doctorDetails->gender) && $doctorDetails->gender == 'Female' ? 'selected' : '' ?>>Female</option>
                        <option value="Other" <?= isset($doctorDetails->gender) && $doctorDetails->gender == 'Other' ? 'selected' : '' ?>>Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="bio">Bio</label>
                    <textarea id="bio" class="form-input" name="bio" required placeholder="Enter a short biography"> 
                        <?= isset($doctorDetails->bio) ? htmlspecialchars(trim($doctorDetails->bio)) : '' ?>
                    </textarea>
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
                    <label for="lnumber">License Number</label>
                    <input type="text" id="lnumber" class="form-input" name="lnumber" required placeholder="Enter your license number" value="<?= isset($doctorDetails->lnumber) ? htmlspecialchars($doctorDetails->lnumber) : '' ?>">
                </div>
                <div class="form-group">
                    <label for="special">Specialization</label>
                    <select id="special" class="form-input" name="special" required>
                        <option value="">Select Specialization</option>
                        <option value="Small Animal Care" <?= isset($doctorDetails->specialization) && $doctorDetails->specialization == 'Small Animal Care' ? 'selected' : '' ?>>Small Animal Care</option>
                        <option value="Large Animal Medicine" <?= isset($doctorDetails->specialization) && $doctorDetails->specialization == 'Large Animal Medicine' ? 'selected' : '' ?>>Large Animal Medicine</option>
                        <option value="Exotic Pet Care" <?= isset($doctorDetails->specialization) && $doctorDetails->specialization == 'Exotic Pet Care' ? 'selected' : '' ?>>Exotic Pet Care</option>
                        <option value="Wildlife Conservation" <?= isset($doctorDetails->specialization) && $doctorDetails->specialization == 'Wildlife Conservation' ? 'selected' : '' ?>>Wildlife Conservation</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="experience">Years of Experience</label>
                    <input type="number" id="experience" class="form-input" name="experience" min="0" max="50" required placeholder="Enter your years of experience" value="<?= isset($doctorDetails->experience) ? htmlspecialchars($doctorDetails->experience) : '' ?>">
                </div>
                <div class="form-group">
                    <label for="timeSlot">Time Taken for a Treatment (minutes)</label>
                    <input type="number" id="timeSlot" class="form-input" name="timeSlot" min="1" required placeholder="Enter time in minutes" value="<?= isset($doctorDetails->timeSlot) ? htmlspecialchars($doctorDetails->timeSlot) : '' ?>">
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
                    <label for="doctorCertificate"><u>Upload Professional Certificate</u></label>
                    
                    <!-- Display the already uploaded image if it exists -->
                    <?php if (isset($doctorDetails->doctorCertificate) && !empty($doctorDetails->doctorCertificate)): ?>
                        <div class="uploaded-file-preview">
                            <p>Current Certificate:</p>
                            <?php if (pathinfo($doctorDetails->doctorCertificate, PATHINFO_EXTENSION) === 'pdf'): ?>
                                <a href="<?= ROOT ?>/assets/images/vetDoctor/<?= htmlspecialchars($doctorDetails->doctorCertificate) ?>" target="_blank">View PDF</a>
                            <?php else: ?>
                                <div class="certificate-container">
                                    <div class="certificate-wrapper">
                                        <img src="<?= ROOT ?>/assets/images/vetDoctor/<?= htmlspecialchars($doctorDetails->doctorCertificate) ?>" alt="Uploaded Certificate" class="certificate-image">
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <!-- File input to replace the existing certificate -->
                    <input type="file" id="doctorCertificate" name="doctorCertificate" accept=".pdf,.jpg,.png">
                    <small class="form-text">Leave this empty if you don't want to replace the current certificate.</small>
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
