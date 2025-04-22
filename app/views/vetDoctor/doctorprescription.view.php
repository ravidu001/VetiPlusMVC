<?php
// Create an instance of the Notification controller
$notification = new Notification();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veterinary Prescription</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/doctornav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/vetDoctor/prescription.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/common/notification.css">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<?php require_once '../app/views/navbar/doctornav.php'; ?>
<div class="home">
    <?php echo $notification->display(); ?>
    <div id="petPopup" class="popup">
        <div class="popup-content">
            <span class="close-btn">&times;</span>
            <h2>Select Pet</h2>
            
            <label for="sessionID">Session ID:</label>
            <select id="sessionID" class="form-input">
                <option value="">Select Session</option>
                <?php 
                $uniqueSessionIDs = []; // Array to track unique session IDs
                foreach ($appointmentsWithPets as $item): 
                    if (!in_array($item['session']->sessionID, $uniqueSessionIDs)): 
                        $uniqueSessionIDs[] = $item['session']->sessionID; // Add to unique list
                ?>
                    <option value="<?= $item['session']->sessionID ?>"><?= $item['session']->sessionID ?></option>
                <?php 
                    endif; 
                endforeach; 
                ?>
            </select>
            
            <label for="petID">Pet ID with Name:</label>
            <select id="petID" class="form-input" disabled>
                <option value="">Select Pet</option>
            </select>

            <input type="hidden" id="appointmentID" value="<?= $item['appointment']->appointmentID; ?>"> 
            
            <div class="button-container">
                <button id="okButton" class="btn btn-primary">OK</button>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-primary" onclick="openPopup()">Select Pet</button>
    <?php
    // Initialize $petID to avoid undefined variable warning
    $petID = null;

    // prescription.php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if petID is set
        if (isset($_POST['petID'])) {
            $petID = $_POST['petID']; // Set $petID from POST data
            // Now you can use $petID in your PHP code
            echo "Received Pet ID: " . htmlspecialchars($petID);
            exit; // Make sure to exit after handling the request
        }
    }
    ?>
    <div class="prescription-wrapper">
        <div class="prescription-header">
            <?php 
            // Use the initialized $selectedPetID variable
            foreach ($appointmentsWithPets as $item): 
                if ($item['appointment']->petID == $selectedPetID && $item['appointment']->sessionID == $selectedSessionID): // Use $selectedPetID instead of $petID
                    // Calculate the age in years and months
                    $dob = date_create($item['pet']->DOB);
                    $now = date_create('now');
                    $ageDiff = date_diff($dob, $now);
                    $years = $ageDiff->y;
                    $months = $ageDiff->m;
                    $selectedPetType = htmlspecialchars($item['pet']->species);
                    // Format the age as "Nyr Mmons"
                    $ageFormatted = "{$years}yr " . ($months > 0 ? "{$months}mons" : "");
            ?>
                    <img src="<?= ROOT ?>/assets/images/common/<?= htmlspecialchars($item['pet']->profilePicture) ?>" alt="Patient Avatar" class="patient-avatar">
                    <div class="patient-info">
                        <h1><?= htmlspecialchars($item['pet']->name) ?></h1>
                        <p>Patient ID: #<?= htmlspecialchars($item['pet']->petID) ?></p>
                        <p>Breed: <?= htmlspecialchars($item['pet']->breed) ?> | Age: <?= $ageFormatted ?></p>
                    </div>
                    
            <?php 
                endif; 
            endforeach; 
            ?>
        </div>

        <form action="<?= ROOT ?>/doctorprescription/saveData?petID=<?= urlencode($selectedPetID) ?>&sessionID=<?= urlencode($selectedSessionID) ?>" method="post">
            <table class="prescription-table">
                <tr>
                    <th colspan="2">Patient Information</th>
                </tr>
                <tr>
                    <td>Weight (kg)</td>
                    <td><input type="number" name="weight" class="form-input" placeholder="Enter weight (kg)"></td>
                </tr>
                <tr>
                    <td>Symptoms</td>
                    <td><textarea class="form-input" name="symptoms" rows="4" placeholder="Describe patient's symptoms"></textarea></td>
                </tr>
                <tr>
                    <th colspan="2">Medical Treatements</th>
                </tr>
                <tr>
                    <td>Vaccination</td>
                    <td>
                        <select class="form-input" name="vaccine" id="vaccineSelect1">
                            <option value="">Select Vaccination</option>
                            <?php foreach ($vaccineData as $vaccine): ?>
                                <?php if ($vaccine->petType == $selectedPetType): // Filter by pet type ?>
                                    <option value="<?= htmlspecialchars($vaccine->vaccineID) ?>">
                                        <?= htmlspecialchars($vaccine->name) ?>
                                    </option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </td>
                <tr>
                    <td>Did a Surgical? </td>
                    <td>
                        <div class="radio-group">
                            <label>
                                <input type="radio" name="surgical" value="No" id="surgical-no" checked>
                                No 
                            </label>
                            <label>
                                <input type="radio" name="surgical" value="Yes" id="surgical-yes">
                                Yes
                            </label>
                        </div>
                            <input type="text" class="form-input" name="surgicalName" id="surgicalname-container" placeholder="Name of the surgery">
                            <input type="text" class="form-input" name="surgicalDetail" id="surgicaldetail-container" placeholder="Description of the surgery">
                    </td>
                </tr>
                <tr>
                    <td>Allergies</td>
                    <td>
                        <div class="radio-group">
                            <label>
                                <input type="radio" name="allergies" value="No" id="allergies-no" checked>
                                No Allergies
                            </label>
                            <label>
                                <input type="radio" name="allergies" value="Yes" id="allergies-yes">
                                Has Allergies
                            </label>
                        </div>
                        <input type="text" class="form-input" name="alleryType" id="allergyname-container" placeholder="Type of allergen (e.g., Food, Pollen)">
                        <input type="text" class="form-input" name="allergyDescription" id="allergydetail-container" placeholder="Description of the allergic reaction)">
                    </td>
                </tr>
                <tr>
                    <td>Prescription</td>
                    <td><textarea class="form-input" name="prescription" rows="4" placeholder="Enter medical prescription using comma separation"></textarea></td>
                </tr>
                <tr>
                    <th colspan="2">Next Vaccination Details</th>
                </tr>
                <tr>
                    <td>Vacine Name</td>
                    <td>
                        <select class="form-input" name="nextvaccine" id="vaccineSelect2">
                            <option value="">Select Vaccination</option>
                            <?php foreach ($vaccineData as $vaccine): ?>
                                <?php if ($vaccine->petType == $selectedPetType): // Filter by pet type ?>
                                    <option value="<?= htmlspecialchars($vaccine->vaccineID) ?>">
                                        <?= htmlspecialchars($vaccine->name) ?>
                                    </option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Vaccination Date</td>
                    <td><input type="date" name="nextvaccineDate" class="form-input" id="vaccineDate"></td>
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
    <script>
        const petsBySession = <?= json_encode($petsBySession) ?>; // Pass pets data to JavaScript
        document.addEventListener('DOMContentLoaded', function() {
            // Check if the popup should be shown
            const shouldShowPopup = <?= isset($_SESSION['popupShown']) ? json_encode($_SESSION['popupShown']) : 'false' ?>;
            
            console.log(<?= json_encode($_SESSION); ?>)

            if (shouldShowPopup) {
                openPopup(); // Automatically open the popup on page load
            }
        });
    </script>
    <script src="<?= ROOT ?>/assets/js/vetDoctor/prescription.js"></script>

</body>
</html>