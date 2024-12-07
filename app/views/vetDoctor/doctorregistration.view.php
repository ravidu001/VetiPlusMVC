<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Veterinarian Registration</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/vetDoctor/registration.css">
</head>
<body>
    <div class="registration-container">
        <div class="registration-illustration">
            <img src="<?= ROOT ?>/assets/images/vetDoctor/vetreg.png" alt="Veterinarian Illustration">
            <h2>Veterinarian Registration</h2>
            <p>Join our professional network and expand your veterinary practice</p>
        </div>
        
        <form class="registration-form" id="vetRegistrationForm" action="<?= ROOT ?>/doctorRegistration/register" method="POST">
            <div class="form-steps">
                <div class="step active">1</div>
                <div class="step">2</div>
                <div class="step">3</div>
            </div>

            <!-- Personal Information -->
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
                            placeholder= "Enter Mobile Number">
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
                <div class="navigation-buttons">
                    <button type="button" class="btn btn-secondary" disabled>Previous</button>
                    <button type="button" class="btn btn-primary next-step">Next</button>
                </div>
            </div>

            <!-- Professional Details -->
            <div class="form-section" id="professionalInfo">
                <h3>Professional Details</h3>
                <div class="form-group">
                    <label>License Number</label>
                    <input type="text" class="form-input" name="lnumber" required 
                           placeholder="Professional License">
                </div>
                <div class="form-group">
                    <label>Specialization</label>
                    <select class="form-input" name="special" required>
                        <option value="">Select Specialization</option>
                        <option>Small Animal Care</option>
                        <option>Large Animal Medicine</option>
                        <option>Exotic Pet Care</option>
                        <option>Wildlife Conservation</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Years of Experience</label>
                    <input type="number" class="form-input" 
                           min="0" max="50" name="exp" required 
                           placeholder="Enter Experience">
                </div>
                <div class=" navigation-buttons">
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

    <script src="<?= ROOT ?>/assets/js/vetDoctor/registration.js"></script>
</body>
</html>