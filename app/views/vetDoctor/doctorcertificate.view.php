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

        <form class="certificate-form" id="certificateForm" method="post">
            <div class="form-section">
                <div class="form-section-title">Pet Information</div>
                <div class="form-group">
                    <label>Pet ID</label>
                    <input type="text" id="petId" placeholder="Enter Pet ID" required>
                </div>
                <div class="form-group">
                    <label>Pet Name</label>
                    <input type="text" id="petName" placeholder="Pet Name" readonly>
                </div>
                <div class="form-group">
                    <label>Breed</label>
                    <input type="text" id="petBreed" placeholder="Pet Breed" readonly>
                </div>
                <div class="form-group">
                    <label>Species</label>
                    <input type="text" id="petSpecies" placeholder="Pet Species" readonly>
                </div>
                <div class="form-group">
                    <label>Gender</label>
                    <input type="text" id="petGender" placeholder="Pet Gender" readonly>
                </div>
                <div class="form-group">
                    <label>Age</label>
                    <input type="number" id="petAge" placeholder="Pet Age" readonly>
                </div>
            </div>

            <div class="form-section">
                <div class="form-section-title">Owner Details</div>
                <div class="form-group">
                    <label>Owner Name</label>
                    <input type="text" id="ownerName" placeholder="Owner's Full Name" readonly>
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" id="ownerAddress" placeholder="Address" readonly>
                </div>
                <div class="form-group">
                    <label>Contact Number</label>
                    <input type="tel" id="ownerContact" placeholder="Phone Number" readonly>
                </div>
            </div>

            <div class="form-section">
                <div class="form-section-title">Medical Assessment</div>
                <div class="form-group">
                    <label>Examination Date</label>
                    <input type="date" id="examinationDate" required>
                </div>
                <div class="form-group">
                    <label>Health Status</label>
                    <select id="healthStatus">
                        <option value="Excellent">Excellent</option>
                        <option value="Good">Good</option>
                        <option value="Average">Average</option>
                        <option value="Poor">Poor</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Vaccination Status</label>
                    <select id="vaccinationStatus">
                        <option value="Excellent">Excellent</option>
                        <option value="Good">Good</option>
                        <option value="Average">Average</option>
                        <option value="Poor">Poor</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Follow-up Appointments</label>
                    <select id="followUpAppointments">
                        <option value="Excellent">Excellent</option>
                        <option value="Good">Good</option>
                        <option value="Average">Average</option>
                        <option value="Poor">Poor</option>
                    </select>
                </div>
                <div class="form-group">
                    < <label>Recommendations</label>
                    <textarea id="recommendations" rows="4" placeholder="Veterinarian's Notes" readonly></textarea>
                </div>
            </div>

            <div class="form-actions">
                <button type="reset" class="btn btn-secondary">Reset</button>
                <button type="submit" class="btn btn-primary">Generate Certificate</button>
            </div>
        </form>
    </div>
</div>
<script>
    $.ajax({
    url: '<?= ROOT ?>/doctorcertificate/getPetData', // Adjusted URL
    type: 'GET',
    data: { petId: petId },
    success: function(data) {
        var petData = JSON.parse(data);
                        $('#petName').val(petData.name);
                        $('#petBreed').val(petData.breed);
                        $('#petSpecies').val(petData.species);
                        $('#petGender').val(petData.gender);
                        $('#petAge').val(petData.age);
                        $('#ownerName').val(petData.ownerName);
                        $('#ownerAddress').val(petData.ownerAddress);
                        $('#ownerContact').val(petData.ownerContact);
                        // Populate other field
    },
    error: function() {
        alert('Error retrieving pet data. Please try again.');
    }
});
</script>
</body>
</html>