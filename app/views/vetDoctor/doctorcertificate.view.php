<?php
// Create an instance of the Notification controller
$notification = new Notification();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Veterinary Certificate Generator</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/vetDoctor/certificateform.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/doctornav.css"><link rel="stylesheet" href="<?= ROOT ?>/assets/css/common/notification.css">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
</head>
<body>
<?php require_once '../app/views/navbar/doctornav.php'; ?>
<div class="home">
<?php echo $notification->display(); ?>
    <div class="certificate-container">
        <div class="certificate-header">
            <h1>Veterinary Certificate Generator</h1>
        </div>

        <form action="<?= ROOT ?>/doctorcertificate/getPetData" class="certificate-form" id="certificateForm" method="GET">
            <div class="form-section">
                <div class="form-section-title">Pet Information</div>
                <div class="form-group">
                    <label>Pet ID <span style="color:red;">*</span></label>
                    <input type="text" name="petId" id="petId" placeholder="Enter Pet ID" required>
                </div>
                <button type= "submit" class="btn btn-primary">Fetch Pet Details</button>
            </div>
        </form>
        <div class="certificate-form" id="certificateForm">
            <div class="form-section">
                <div class="form-group">
                    <label>Pet Name</label>
                    <input type="text" id="petName" placeholder="Auto Fill" value="<?= htmlspecialchars($petData->name ?? '', ENT_QUOTES, 'UTF-8'); ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Breed</label>
                    <input type="text" id="petBreed" placeholder="Auto Fill" value="<?= htmlspecialchars($petData->breed ?? '', ENT_QUOTES, 'UTF-8'); ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Species</label>
                    <input type="text" id="petSpecies" placeholder="Auto Fills" value="<?= htmlspecialchars($petData->species ?? '', ENT_QUOTES, 'UTF-8'); ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Gender</label>
                    <input type="text" id="petGender" placeholder="Auto Fill" value="<?= htmlspecialchars($petData->gender ?? '', ENT_QUOTES, 'UTF-8'); ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Age</label>
                    <input type="number" id="petAge" placeholder="Auto Fill" value="<?= htmlspecialchars($age ?? '', ENT_QUOTES, 'UTF-8'); ?>" readonly>
                </div>
            </div>

            <div class="form-section">
                <div class="form-section-title">Owner Details</div>
                <div class="form-group">
                    <label>Owner Name</label>
                    <input type="text" id="ownerName" placeholder="Owner's Full Name" value="<?= htmlspecialchars($petOwnerData->fullName ?? '', ENT_QUOTES, 'UTF-8'); ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" id="ownerAddress" placeholder="Address" 
                        value="<?= htmlspecialchars($petOwnerData->houseNo ?? '', ENT_QUOTES, 'UTF-8'); ?>,
                        <?= trim(htmlspecialchars($petOwnerData->streetName ?? '', ENT_QUOTES, 'UTF-8')); ?>,
                        <?= trim(htmlspecialchars($petOwnerData->city ?? '', ENT_QUOTES, 'UTF-8')); ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Contact Number</label>
                    <input type="tel" id="ownerContact" placeholder="Phone Number" value="<?= htmlspecialchars($petOwnerData->contactNumber ?? '', ENT_QUOTES, 'UTF-8'); ?>" readonly>
                </div>
            </div>
        </div>

        <form action="<?= ROOT ?>/doctorcertificate/insertData" class="certificate-form" id="certificateForm" method="POST">
            <div class="form-section">
                <div class="form-section-title">Medical Assessment</div>
                <input type="hidden" name="petID" id="petID" value="<?= htmlspecialchars($petData->petID ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                <div class="form-group">
                    <label>Health Status <span style="color:red;">*</span></label>
                    <select name="healthStatus" id="healthStatus" required>
                        <option value="Excellent">Excellent</option>
                        <option value="Good">Good</option>
                        <option value="Average">Average</option>
                        <option value="Poor">Poor</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Vaccination Status <span style="color:red;">*</span></label>
                    <select name="vaccinationStatus" id="vaccinationStatus" required>
                        <option value="Excellent">Excellent</option>
                        <option value="Good">Good</option>
                        <option value="Average">Average</option>
                        <option value="Poor">Poor</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Follow-up Appointments <span style="color:red;">*</span></label>
                    <select name="followUpAppointments" id="followUpAppointments" required>
                        <option value="Excellent">Excellent</option>
                        <option value="Good">Good</option>
                        <option value="Average">Average</option>
                        <option value="Poor">Poor</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Recommendations <span style="color:red;">*</span></label>
                    <textarea name="recommendations" id="recommendations" rows="4" placeholder="Veterinarian's Notes" required></textarea>
                </div>
                <div class="form-group">
                    <label>Date of Expiry Certificate <span style="color:red;">*</span></label>
                    <input type="date" name="expiryDate" id="expiryDate" required>
                </div>
            </div>

            <div class="form-actions">
                <button type="reset" class="btn btn-secondary">Reset</button>
                <button type="submit" class="btn btn-primary">Generate Certificate</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>