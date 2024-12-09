<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Veterinary Certificate Generator</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/vetDoctor/certificateform.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/doctornav.css">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
</head>
<body>
<?php require_once '../app/views/navbar/doctornav.php'; ?>
<div class="home">
    <div class="certificate-container">
        <div class="certificate-header">
            <h1>Veterinary Certificate Generator</h1>
        </div>

        <form class="certificate-form" action="<?= ROOT ?>/doctorcertificate/certificate" method="post">
            <div class="form-section">
                <div class="form-section-title">Pet Information</div>
                <div class="form-group">
                    <label>Pet ID</label>
                    <input type="text" placeholder="Enter Pet ID" required>
                </div>
                <div class="form-group">
                    <label>Pet Name</label>
                    <input type="text" placeholder="Pet Name">
                </div>
                <div class="form-group">
                    <label>Breed</label>
                    <input type="text" placeholder="Pet Breed">
                </div>
                <div class="form-group">
                    <label>Species</label>
                    <input type="text" placeholder="Pet Species">
                </div>
                <div class="form-group">
                    <label>Gender</label>
                    <input type="text" placeholder="Pet Gender">
                </div>
                <div class="form-group">
                    <label>Age</label>
                    <input type="number" placeholder="Pet Age">
                </div>
            </div>

            <div class="form-section">
                <div class="form-section-title">Owner Details</div>
                <div class="form-group">
                    <label>Owner Name</label>
                    <input type="text" placeholder="Owner's Full Name">
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" placeholder="Address">
                </div>
                <div class="form-group">
                    <label>Contact Number</label>
                    <input type="tel" placeholder="Phone Number">
                </div>
            </div>

            <div class="form-section">
                <div class="form-section-title">Medical Assessment</div>
                <div class="form-group">
                    <label>Examination Date</label>
                    <input type="date" required>
                </div>
                <div class="form-group">
                    <label>Health Status</label>
                    <select>
                        <option>Excellent</option>
                        <option>Good</option>
                        <option>Average</option>
                        <option>Poor</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Vacination Status</label>
                    <select>
                        <option>Excellent</option>
                        <option>Good</option>
                        <option>Average</option>
                        <option>Poor</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Follow-up Appointments</label>
                    <select>
                        <option>Excellent</option>
                        <option>Good</option>
                        <option>Average</option>
                        <option>Poor</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Recommendations</label>
                    <textarea rows="4" placeholder="Veterinarian's Notes"></textarea>
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