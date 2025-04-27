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
    <style>
    /* Error Alert Container */
    .alert {
        padding: 15px 20px;
        background-color: #f44336; /* Red background for errors */
        color: white;
        border-radius: 8px;
        margin-bottom: 20px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* List inside the alert */
    .alert ul {
        margin: 0;
        padding-left: 20px;
    }

    /* List items inside the alert */
    .alert ul li {
        list-style-type: disc;
        margin-bottom: 5px;
        font-size: 16px;
    }

    /* Success Alert (optional if you want to show success too) */
    .alert-success {
        background-color: #4CAF50; /* Green background */
    }

    /* Error Alert specifically */
    .alert-danger {
        background-color: #f44336; /* Red background */
    }
    </style>

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
            <?php if (isset($_SESSION['errors'])): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($_SESSION['errors'] as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php unset($_SESSION['errors']); ?>
            <?php endif; ?>


            <!-- Personal Information -->
            <div class="form-section active" id="personalInfo">
                <h3>Personal Information</h3>
                <div class="form-group">
                    <label for="name">Full Name <div style="color:red; padding-left:5px;">*</div></label>
                    <input type="text" id="name" class="form-input" name="name" placeholder="Enter your full name">
                </div>
                <div class="form-group">
                    <label for="address">Permanent Address <div style="color:red; padding-left:5px;">*</div></label>
                    <input type="text" id="address" class="form-input" name="address" placeholder="Enter your permanent address">
                </div>
                <div class="form-group">
                    <label for="DOB">Date of Birth <div style="color:red; padding-left:5px;">*</div></label>
                    <input type="date" id="DOB" class="form-input" name="DOB">
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile Number <div style="color:red; padding-left:5px;">*</div></label>
                    <input type="text" id="mobile" class="form-input" name="mobile" placeholder="Enter your 10-digit mobile number">
                </div>
                <div class="form-group">
                    <label for="gender">Gender <div style="color:red; padding-left:5px;">*</div></label>
                    <select id="gender" class="form-input" name="gender">
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="bio">Bio <div style="color:red; padding-left:5px;">*</div></label>
                    <textarea id="bio" class="form-input" name="bio" placeholder="Enter a short biography"></textarea>
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
                    <input type="text" id="lnumber" class="form-input" name="lnumber" placeholder="Eg. VC/xxxx or TVC/xxxx">
                </div>
                <div class="form-group">
                    <label for="special">Specialization <div style="color:red; padding-left:5px;">*</div></label>
                    <select id="special" class="form-input" name="special">
                        <option value="">Select Specialization</option>
                        <option value="Small Animal Care">Small Animal Care</option>
                        <option value="Large Animal Medicine">Large Animal Medicine</option>
                        <option value="Exotic Pet Care">Exotic Pet Care</option>
                        <option value="Wildlife Conservation">Wildlife Conservation</option>
                        <option value="Veterinary Surgery">Veterinary Surgery</option>
                        <option value="Veterinary Dermatology">Veterinary Dermatology</option>
                        <option value="Veterinary Dentistry">Veterinary Dentistry</option>
                        <option value="Veterinary Oncology">Veterinary Oncology (Cancer Treatment)</option>
                        <option value="Animal Reproduction and Fertility">Animal Reproduction and Fertility</option>
                        <option value="Veterinary Cardiology">Veterinary Cardiology (Heart Care)</option>
                        <option value="Veterinary Neurology">Veterinary Neurology (Brain & Nerve Care)</option>
                        <option value="Animal Behavior and Training">Animal Behavior and Training</option>
                        <option value="Veterinary Ophthalmology">Veterinary Ophthalmology (Eye Care)</option>
                        <option value="Equine Medicine">Equine Medicine (Horse Care)</option>
                        <option value="Poultry Medicine">Poultry Medicine</option>
                        <option value="Food Animal Medicine">Food Animal Medicine (Cattle, Sheep, Goats)</option>
                        <option value="Veterinary Public Health">Veterinary Public Health (Zoonotic Disease Control)</option>
                        <option value="Aquatic Animal Health">Aquatic Animal Health (Fish and Marine Animals)</option>
                    </select>

                </div>
                <div class="form-group">
                    <label for="experience">Years of Experience <div style="color:red; padding-left:5px;">*</div></label>
                    <input type="number" id="experience" class="form-input" name="experience" min="0" max="50" placeholder="Enter your years of experience">
                </div>
                <div class="form-group">
                    <label for="timeSlot">Time Taken for a Treatment (minutes) <div style="color:red; padding-left:5px;">*</div></label>
                    <input type="number" id="timeSlot" class="form-input" name="timeSlot" min="1" placeholder="Enter time in minutes">
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
                    <label for="doctorCertificate">Upload Professional Certificate - Rename the file name as VC_1234 <span style="color:red; padding-left:5px;">*</span><br>
                    
                </label>
                    <input type="file" id="doctorCertificate" name="doctorCertificate" accept=".pdf,.jpg,.png">
                </div>
                <div class="navigation-buttons">
                    <button type="button" class="btn btn-secondary previous-step">Previous</button>
                    <button type="submit" class="btn btn-primary">Complete Registration</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const dobInput = document.getElementById('DOB'); // or whatever ID you gave to the DOB input

            if (dobInput) {
                const today = new Date();
                const year = today.getFullYear() - 18;
                const month = String(today.getMonth() + 1).padStart(2, '0');
                const day = String(today.getDate()).padStart(2, '0');

                const maxDate = `${year}-${month}-${day}`;
                dobInput.setAttribute('max', maxDate);
            }
        });
    </script>
    <script src="<?= ROOT ?>/assets/js/vetDoctor/registration.js"></script>
</body>
</html>
