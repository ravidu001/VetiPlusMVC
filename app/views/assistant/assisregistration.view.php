<?php
// Create an instance of the Notification controller
$notification = new Notification();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Veterinary Assistant Registration</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/vetDoctor/registration.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/common/notification.css">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <!-- <link rel="stylesheet" href="<?= ROOT ?>/assets/css/vetAssistant/registration.css"> -->
    <style>
        /* Add these additional styles for language checkboxes */
        .language-checkboxes {
            display: flex;
            gap: 15px;
            margin-top: 10px;
        }

        .checkbox-container {
            display: block;
            position: relative;
            padding-left: 35px;
            margin-bottom: 12px;
            cursor: pointer;
            user-select: none;
        }

        .checkbox-container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 25px;
            width: 25px;
            background-color: #eee;
            border-radius: 4px;
        }

        .checkbox-container:hover input ~ .checkmark {
            background-color: #ccc;
        }

        .checkbox-container input:checked ~ .checkmark {
            background-color: var(--primary-color);
        }

        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        .checkbox-container input:checked ~ .checkmark:after {
            display: block;
        }

        .checkbox-container .checkmark:after {
            left: 9px;
            top: 5px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 3px 3px 0;
            transform: rotate(45deg);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

    </style>
</head>
<body>
    <?php echo $notification->display(); ?>
    <div class="registration-container">
        <div class="registration-illustration">
            <img src="<?= ROOT ?>/assets/images/vetAssistant/assistantReg.png" alt="Veterinary Assistant Illustration">
            <h2>Veterinary Assistant Registration</h2>
            <p>Join our professional network and support animal healthcare</p>
        </div>
        
        <form class="registration-form" id="vetAssistantRegistrationForm" action="<?= ROOT ?>/assisRegistration/register" method="POST" enctype="multipart/form-data">
            <div class="form-steps">
                <div class="step active">1</div>
                <div class="step">2</div>
                <div class="step">3</div>
            </div>

            <!-- Personal Information Section -->
            <div class="form-section active" id="personalInfo">
                <h3>Personal Information</h3>
                <div class="form-group">
                    <label for="fullName">Full Name</label>
                    <input type="text" id="fullName" class="form-input" name="fullName" required 
                        placeholder="Enter Full Name">
                </div>
                <div class="form-group">
                    <label for="DOB">Date of Birth</label>
                    <input type="date" id="DOB" class="form-input" name="DOB" required>
                </div>
                <div class="form-group">
                    <label id="mobile">Mobile Number</label>
                    <input type="number" id="mobile" class="form-input" name="mobile" required
                            placeholder="Enter Mobile Number">
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select class="form-input" id="gender" name="gender" required>
                        <option value="">Select Gender</option>
                        <option>Male</option>
                        <option>Female</option>
                        <option>Other</option>
                    </select>
                </div>
                <div class="form-group full-width">
                    <label for="address">Address</label>
                    <input type="text" class="form-input" id="address" name="address" required
                        placeholder="Street Address">
                </div>
                <div class="form-group">
                    <label for="district">District</label>
                    <select name="district" class="form-input" required>
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
                <!-- <div class="form-group">
                    <label>Province/State</label>
                    <input type="text" class="form-input" name="province" required
                        placeholder="Province/State">
                </div> -->
                <div class="navigation-buttons">
                    <button type="button" class="btn btn-secondary" disabled>Previous</button>
                    <button type="button" class="btn btn-primary next-step">Next</button>
                </div>
            </div>

            <!-- Professional Details Section -->
            <div class="form-section" id="professionalInfo">
                <h3>Professional Details</h3>
                <div class="form-group">
                    <label for="certificateNumber">Certification Number</label>
                    <input type="text" class="form-input" id="certificateNumber" name="certificateNumber" required 
                        placeholder="Professional Certification">
                </div>
                <div class="form-group">
                    <label>Area of Expertise</label>
                    <select class="form-input" name="expertise" required>
                        <option value="">Select Area of Expertise</option>
                        <option>Small Animal Care</option>
                        <option>Large Animal Assistance</option>
                        <option>Laboratory Support</option>
                        <option>Veterinary Clinic Management</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="experience">Years of Experience</label>
                    <input type="number" class="form-input" id="experience"
                        min="0" max="50" name="experience" required 
                        placeholder="Enter Experience">
                </div>
                <div class="form-group">
                    <label for="bio">Bio</label>
                    <textarea id="bio" class="form-input" name="bio" required placeholder="Enter a short biography"></textarea>
                </div>
                <div class="form-group">
                    <label for="chargePerHour">Charge per Hour</label>
                    <input type="number" class="form-input" id="chargePerHour"
                        min="0" step="0.01" name="chargePerHour" required 
                        placeholder="Enter Hourly Rate">
                </div>
                <div class="form-group">
                    <label>Languages</label>
                    <div class="language-checkboxes">
                        <label for="languageEnglish" class="checkbox-container">
                            <input type="checkbox" id="languageEnglish" name="languageSpoken[]" value="English"> English
                            <span class="checkmark"></span>
                        </label>
                        <label for="languageSinhala" class="checkbox-container">
                            <input type="checkbox" id="languageSinhala" name="languageSpoken[]" value="Sinhala"> Sinhala
                            <span class="checkmark"></span>
                        </label>
                        <label for="languageTamil" class="checkbox-container">
                            <input type="checkbox" id="languageTamil" name="languageSpoken[]" value="Tamil"> Tamil
                            <span class="checkmark"></span>
                        </label>
                    </div>
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
                    <label for="certificate">Upload Professional Certificate</label>
                    <input type="file" id="certificate" name="certificate" accept=".pdf,.jpg,.png" required>
                </div>

                <div class="navigation-buttons">
                    <button type="button" class="btn btn-secondary previous-step">Previous</button>
                    <button type="submit" class="btn btn-primary">Complete Registration</button>
                </div>
            </div>
        </form>
    </div>

    <!-- <script src="<?= ROOT ?>/assets/js/vetAssistant/registration.js"></script> -->

    <script>
        // This will be identical to the veterinarian registration JavaScript
        const nextStepButtons = document.querySelectorAll('.next-step');
        const previousStepButtons = document.querySelectorAll('.previous-step');
        const formSections = document.querySelectorAll('.form-section');
        const steps = document.querySelectorAll('.step');
        let currentStep = 0;

        nextStepButtons.forEach(button => {
            button.addEventListener('click', () => {
                if (currentStep < formSections.length - 1) {
                    formSections[currentStep].classList.remove('active');
                    steps[currentStep].classList.remove('active');
                    currentStep++;
                    formSections[currentStep].classList.add('active');
                    steps[currentStep].classList.add('active');
                }
            });
        });

        previousStepButtons.forEach(button => {
            button.addEventListener('click', () => {
                if (currentStep > 0) {
                    formSections[currentStep].classList.remove('active');
                    steps[currentStep].classList.remove('active');
                    currentStep--;
                    formSections[currentStep].classList.add('active');
                    steps[currentStep].classList.add('active');
                }
            });
        });
    </script>
</body>
</html>