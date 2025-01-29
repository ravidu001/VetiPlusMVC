<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Veterinary Assistant Registration</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/vetDoctor/registration.css">
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
    <div class="registration-container">
        <div class="registration-illustration">
            <img src="<?= ROOT ?>/assets/images/vetAssistant/assistantReg.png" alt="Veterinary Assistant Illustration">
            <h2>Veterinary Assistant Registration</h2>
            <p>Join our professional network and support animal healthcare</p>
        </div>
        
        <form class="registration-form" id="vetAssistantRegistrationForm" action="<?= ROOT ?>/assisRegistration/home" method="POST">
            <div class="form-steps">
                <div class="step active">1</div>
                <div class="step">2</div>
                <div class="step">3</div>
            </div>

            <!-- Personal Information Section -->
            <div class="form-section active" id="personalInfo">
                <h3>Personal Information</h3>
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" class="form-input" name="name" required 
                        placeholder="Enter Full Name">
                </div>
                <div class="form-group">
                    <label>Date of Birth</label>
                    <input type="date" class="form-input" name="DOB" required>
                </div>
                <div class="form-group">
                    <label>Mobile Number</label>
                    <input type="number" class="form-input" name="mobile" required
                            placeholder="Enter Mobile Number">
                </div>
                <div class="form-group">
                    <label>Gender</label>
                    <select class="form-input" name="gender" required>
                        <option value="">Select Gender</option>
                        <option>Male</option>
                        <option>Female</option>
                        <option>Other</option>
                    </select>
                </div>
                <div class="form-group full-width">
                    <label>Address</label>
                    <input type="text" class="form-input" name="street_address" required
                        placeholder="Street Address">
                </div>
                <div class="form-group">
                    <label>City</label>
                    <input type="text" class="form-input" name="city" required
                        placeholder="City">
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
                    <label>Certification Number</label>
                    <input type="text" class="form-input" name="certNumber" required 
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
                    <label>Years of Experience</label>
                    <input type="number" class="form-input" 
                        min="0" max="50" name="exp" required 
                        placeholder="Enter Experience">
                </div>
                <div class="form-group">
                    <label>Charge per Hour</label>
                    <input type="number" class="form-input" 
                        min="0" step="0.01" name="hourly_rate" required 
                        placeholder="Enter Hourly Rate">
                </div>
                <div class="form-group">
                    <label>Languages</label>
                    <div class="language-checkboxes">
                        <label class="checkbox-container">
                            <input type="checkbox" name="languages[]" value="English"> English
                            <span class="checkmark"></span>
                        </label>
                        <label class="checkbox-container">
                            <input type="checkbox" name="languages[]" value="Sinhala"> Sinhala
                            <span class="checkmark"></span>
                        </label>
                        <label class="checkbox-container">
                            <input type="checkbox" name="languages[]" value="Tamil"> Tamil
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
                    <label for="certificateFile">Upload Professional Certificate</label>
                    <input type="file" id="certificateFile" name="certificate" accept=".pdf,.jpg,.png" required>
                    <label for="certificateFile" class="file-upload-label">Choose File</label>
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