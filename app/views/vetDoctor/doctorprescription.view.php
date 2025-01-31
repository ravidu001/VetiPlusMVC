<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veterinary Prescription</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/doctornav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/vetDoctor/prescription.css">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<?php require_once '../app/views/navbar/doctornav.php'; ?>
<div class="home">
    <div class="prescription-wrapper">
        <div class="prescription-header">
            <img src="<?= ROOT ?>/assets/images/common/dogProfileimage.jpg" alt="Patient Avatar" class="patient-avatar">
            <div class="patient-info">
                <h1>Roky</h1>
                <p>Patient ID: #10011</p>
                <p>Breed: Golden Retriever | Age: 2 years 6 months</p>
            </div>
        </div>

        <form action="#" method="post">
            <table class="prescription-table">
                <tr>
                    <th colspan="2">Patient Information</th>
                </tr>
                <tr>
                    <td>Weight (kg)</td>
                    <td><input type="number" class="form-input" placeholder="Enter weight (kg)"></td>
                </tr>
                <tr>
                    <td>Symptoms</td>
                    <td><textarea class="form-input" rows="4" placeholder="Describe patient's symptoms"></textarea></td>
                </tr>
                <tr>
                    <th colspan="2">Medical Treatements</th>
                </tr>
                <tr>
                    <td>Vaccinated Details </td>
                    <td><input type="text" class="form-input" placeholder="Previous vaccinations"></td>
                </tr>
                <tr>
                    <td>Did a Surgical? </td>
                    <td>
                        <div class="radio-group">
                            <label>
                                <input type="radio" name="surgical" id="surgical-no" checked>
                                No 
                            </label>
                            <label>
                                <input type="radio" name="surgical" id="surgical-yes">
                                Yes
                            </label>
                        </div>
                        <input type="text" class="form-input" id="surgicalname-container" placeholder="Surgical details (if applicable)">
                    </td>
                </tr>
                <tr>
                    <td>Allergies</td>
                    <td>
                        <div class="radio-group">
                            <label>
                                <input type="radio" name="allergies" id="allergies-no" checked>
                                No Allergies
                            </label>
                            <label>
                                <input type="radio" name="allergies" id="allergies-yes">
                                Has Allergies
                            </label>
                        </div>
                        <input type="text" class="form-input" id="allergyname-container" placeholder="Allergy details (if applicable)">
                    </td>
                </tr>
                <tr>
                    <td>Prescription</td>
                    <td><textarea class="form-input" rows="4" placeholder="Enter medical prescription"></textarea></td>
                </tr>
                <tr>
                    <th colspan="2">Next Vaccination Details</th>
                </tr>
                <tr>
                    <td>Vacine Name</td>
                    <td><input type="text" class="form-input" placeholder="Next vaccination"></td>
                </tr>
                <tr>
                    <td>Vaccination Date</td>
                    <td><input type="date" class="form-input" id="vaccineDate"></td>
                </tr>
                <tr>
                    <td class="prescription-actions">
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </td>
                    <td class="prescription-actions">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
    <script src="<?= ROOT ?>/assets/js/vetDoctor/prescription.js"></script>
</body>
</html>