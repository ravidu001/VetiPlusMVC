<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Pet Medical History</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/navbar/doctornav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/vetDoctor/medicalhistory.css">
    <link rel="icon" href="<?= ROOT ?>/assets/images/common/logo.png" type="image/png">
</head>

<body>
    <?php require_once '../app/views/navbar/doctornav.php'; ?>
    <div class="home">
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

                <div class="button-container">
                    <button id="okButton" class="btn btn-primary">OK</button>
                </div>
            </div>
        </div>
        
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
        <?php if($selectedPetID != null && $selectedSessionID != null): ?>
            <button type="button" class="btn btn-primary" onclick="openPopup()">Select Pet</button>
        <div class="medical-history-container">
            <div class="profile-header">
                <?php 
            // Use the initialized $selectedPetID variable
            foreach ($appointmentsWithPets as $item): 
                if ($item['pet']->petID == $selectedPetID&& $item['appointment']->sessionID == $selectedSessionID): // Use $selectedPetID instead of $petID
                    // Calculate the age in years and months
                    $dob = date_create($item['pet']->DOB);
                    $now = date_create('now');
                    $ageDiff = date_diff($dob, $now);
                    $years = $ageDiff->y;
                    $months = $ageDiff->m;

                    // Format the age as "Nyr Mmons"
                    $ageFormatted = "{$years}yr " . ($months > 0 ? "{$months}mons" : "");
            ?>
                <img src="<?= ROOT ?>/assets/images/petowner/profilePictures/pet/<?= htmlspecialchars($item['pet']->profilePicture) ?>"
                    alt="Patient Avatar" class="pet-avatar">
                <div class="profile-details">
                    <h1><?= htmlspecialchars($item['pet']->name) ?></h1>
                    <p>Patient ID: #<?= htmlspecialchars($item['pet']->petID) ?></p>
                    <p>Breed: <?= htmlspecialchars($item['pet']->breed) ?> | Age: <?= $ageFormatted ?></p>
                </div>
                <?php 
                endif; 
            endforeach; 
            ?>
            </div>
            <?php
                $today = new DateTime(); // Current date (Y-m-d)
            ?>

            <div class="medical-section medical-section-collapsed">
                <h2>Yet To Complete Vaccination</h2>
                <div class="medical-section-scrollable">
                    <?php foreach ($medicalrecordData as $record): ?>
                        <?php foreach ($vaccineData as $vaccine): ?>
                            <?php if ($record->recordID == $vaccine['vaccinationData']->recordID && $vaccine['vaccinationData']->status == 0): ?>
                                <?php
                                $nextDate = new DateTime($vaccine['vaccinationData']->nextDate);
                                $interval = $today->diff($nextDate);
                                $daysDiff = (int)$interval->format('%r%a'); // Relative days difference

                                // Generate description
                                if ($daysDiff > 30) {
                                    $description = "Due in " . floor($daysDiff / 30) . " months";
                                } elseif ($daysDiff > 7) {
                                    $description = "Due in " . floor($daysDiff / 7) . " weeks";
                                } elseif ($daysDiff > 0) {
                                    $description = "Due in $daysDiff days";
                                } elseif ($daysDiff === 0) {
                                    $description = "Due today!";
                                } else {
                                    $description = "Overdue by " . abs($daysDiff) . " days";
                                }
                                ?>
                                
                                <div class="medical-entry">
                                    <div class="medical-entry-details">
                                        <h3><?= htmlspecialchars($vaccine['vaccineInfo']->name); ?></h3>
                                        <p><?= htmlspecialchars($vaccine['vaccineInfo']->description); ?></p>
                                    </div>
                                    <div class="medical-entry-date">
                                        <div style="justify-content:right;">
                                            <?= htmlspecialchars($vaccine['vaccinationData']->nextDate); ?>
                                        </div>
                                        <p style="color: <?= $daysDiff < 0 ? 'red' : 'green'; ?>; align: center;">
                                            <?= $description; ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </div>
                <div class="view-all-btn" onclick="toggleSection(this)">View All (<?= count($vaccineData); ?>)</div>
            </div>

            <div class="medical-section medical-section-collapsed">
                <h2>Vaccination History</h2>
                <div class="medical-section-scrollable">
                    <?php foreach($medicalrecordData as $record): ?>
                        <?php foreach($vaccineData as $vaccine): ?>
                            <?php if ($record->recordID == $vaccine['vaccinationData']->newRecordID): ?>
                                <div class="medical-entry">
                                    <div class="medical-entry-details">
                                        <h3> <?= htmlspecialchars($vaccine['vaccineInfo']->name); ?></h3>
                                        <p><?= htmlspecialchars($vaccine['vaccineInfo']->description); ?></p>
                                    </div>
                                    <div class="medical-entry-date">
                                        <?php
                                        $vaccinatedDate = date_create($vaccine['vaccinationData']->vaccinatedDate);
                                        echo "<script>console.log('Vaccinated Date: " . $vaccine['vaccinationData']->vaccinatedDate . "');</script>";
                                        $now = date_create('now');
                                        $dateDiff = date_diff($vaccinatedDate, $now);

                                        // Calculate total months
                                        $totalMonths = $dateDiff->y * 12 + $dateDiff->m;

                                        if ($totalMonths < 12) {
                                            echo $totalMonths . " months ago";
                                        } else {
                                            $years = floor($totalMonths / 12);
                                            $remainingMonths = $totalMonths % 12;
                                            echo $years . "yr" . ($remainingMonths > 0 ? " " . $remainingMonths . "mons" : "") . " ago";
                                        }
                                        ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach;?>
                    <?php endforeach; ?>
                </div>
                <div class="view-all-btn" onclick="toggleSection(this)">View All (5)</div>
            </div>
            <div class="medical-section medical-section-collapsed">
                <h2>Surgical History</h2>
                <div class="medical-section-scrollable">
                    <?php foreach($medicalrecordData as $record): ?>
                        <?php foreach($surgeryData as $surgery): ?>
                            <?php if ($record->recordID == $surgery->recordID): ?>
                                <div class="medical-entry">
                                    <div class="medical-entry-details">
                                        <h3><?= htmlspecialchars($surgery->surgeryName); ?></h3>
                                        <p><?= htmlspecialchars($surgery->description); ?></p>
                                    </div>
                                    <div class="medical-entry-date">
                                        <?php
                                            $surgeryDate = date_create($surgery->datePerformed);
                                            $now = date_create('now');
                                            $dateDiff = date_diff($surgeryDate, $now);

                                            // Calculate total months
                                            $totalMonths = $dateDiff->y * 12 + $dateDiff->m;

                                            if ($totalMonths < 12) {
                                                echo $totalMonths . " months ago";
                                            } else {
                                                $years = floor($totalMonths / 12);
                                                $remainingMonths = $totalMonths % 12;
                                                echo $years . "yr" . ($remainingMonths > 0 ? " " . $remainingMonths . "mons" : "") . " ago";
                                            }
                                        ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach;?>
                    <?php endforeach; ?>
                </div>
                <div class="view-all-btn" onclick="toggleSection(this)">View All (4)</div>
            </div>

            <div class="medical-section medical-section-collapsed">
                <h2>Prescription History</h2>
                <div class="medical-section-scrollable">
                    <?php foreach($medicalrecordData as $record): ?>
                        <?php foreach($prescriptionData as $prescription): ?>
                            <?php if ($record->recordID == $prescription->recordID): ?>
                                <div class="medical-entry">
                                    <div class="medical-entry-details">
                                        <h3><?= htmlspecialchars($prescription->prescriptionName); ?></h3>
                                        <p>
                                            <ul>
                                                <?php 
                                                $symptoms = explode(',', $record->symptom); // Split the string by commas
                                                foreach ($symptoms as $symptom): 
                                                ?>
                                                    <li><?= htmlspecialchars(trim($symptom)); ?></li> <!-- Trim and escape each symptom -->
                                                <?php endforeach; ?>
                                            </ul>
                                        </p>
                                    </div>
                                    <div class="medical-entry-date">
                                        <?php
                                            $prescriptionDate = date_create($prescription->datePrescribed);
                                            $now = date_create('now');
                                            $dateDiff = date_diff($prescriptionDate, $now);

                                            // Calculate total months
                                            $totalMonths = $dateDiff->y * 12 + $dateDiff->m;

                                            if ($totalMonths < 12) {
                                                echo $totalMonths . " months ago";
                                            } else {
                                                $years = floor($totalMonths / 12);
                                                $remainingMonths = $totalMonths % 12;
                                                echo $years . "yr" . ($remainingMonths > 0 ? " " . $remainingMonths . "mons" : "") . " ago";
                                            }
                                        ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach;?>
                    <?php endforeach; ?>
                    
                    <div class="view-all-btn" onclick="toggleSection(this)">View All (5)</div>
                </div>
            </div>

            <div class="medical-section medical-section-collapsed">
                <h2>Allergies & Sensitivities</h2>
                <div class="medical-section-scrollable">
                <?php foreach($medicalrecordData as $record): ?>
                        <?php foreach($allergyData as $allergy): ?>
                            <?php if ($record->recordID == $allergy->recordID): ?>
                                <div class="medical-entry">
                                    <div class="medical-entry-details">
                                        <h3><?= htmlspecialchars($allergy->allergenType); ?></h3>
                                        <p><?= htmlspecialchars($allergy->reactionDescription); ?></p>
                                    </div>
                                    <div class="medical-entry-date">
                                        <?php
                                            $surgeryDate = date_create($allergy->dateIdentified);
                                            $now = date_create('now');
                                            $dateDiff = date_diff($surgeryDate, $now);

                                            // Calculate total months
                                            $totalMonths = $dateDiff->y * 12 + $dateDiff->m;

                                            if ($totalMonths < 12) {
                                                echo $totalMonths . " months ago";
                                            } else {
                                                $years = floor($totalMonths / 12);
                                                $remainingMonths = $totalMonths % 12;
                                                echo $years . "yr" . ($remainingMonths > 0 ? " " . $remainingMonths . "mons" : "") . " ago";
                                            }
                                        ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach;?>
                    <?php endforeach; ?>
                </div>
                <div class="view-all-btn" onclick="toggleSection(this)">View All (3)</div>
            </div>

            <?php if (is_array($weightData) && !empty($weightData)): ?>
                <?php
                // Sort weight data by measuredDate DESC
                usort($weightData, function ($a, $b) {
                    return strtotime($b->measuredDate) - strtotime($a->measuredDate);
                });
                ?>

                <div class="medical-section medical-section-collapsed">
                    <h2>Weight Tracking</h2>
                    <div class="medical-section-scrollable">
                    <?php
                        $now = new DateTime();
                        $lastIndex = count($weightData) - 1;

                        foreach ($weightData as $index => $record) {
                            $measuredDate = new DateTime($record->measuredDate);
                            $interval = $measuredDate->diff($now);
                            $months = $interval->y * 12 + $interval->m;

                            // Format label: "2 months ago" or "1yr 2mon ago"
                            $label = ($months < 12)
                                ? "$months months ago"
                                : floor($months / 12) . "yr" . (($months % 12 > 0) ? " " . ($months % 12) . "mon" : "") . " ago";

                            // Title
                            if ($index === 0) {
                                $title = "Current Weight";
                                $description = "Healthy weight range";
                            } elseif ($index === $lastIndex) {
                                $title = "Weight " . $label;
                                $description = "Initial weight check"; // Special label for first recorded weight
                            } else {
                                $prevWeight = $weightData[$index - 1]->weight;
                                $diff = $record->weight - $prevWeight;

                                if ($diff > 0.3) $description = "Slight weight gain";
                                elseif ($diff < -0.3) $description = "Slight weight loss";
                                else $description = "Stable weight";

                                $title = "Weight " . $label;
                            }
                        ?>
                        <div class="medical-entry">
                            <div class="medical-entry-details">
                                <h3><?= $title ?></h3>
                                <p><?= $description ?></p>
                            </div>
                            <div class="medical-entry-date"><?= $record->weight ?> kg</div>
                        </div>
                    <?php } ?>

                    </div>
                    <div class="view-all-btn" onclick="toggleSection(this)">View All (<?= count($weightData) ?>)</div>
                </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>


    <script>
    const petsBySession = <?= json_encode($petsBySession) ?>; // Pass pets data to JavaScript
    document.addEventListener('DOMContentLoaded', function() {
        // Popup functionality
        const petPopup = document.getElementById("petPopup");
        const closeBtn = document.querySelector(".close-btn");

        // Check if the popup should be shown
        const shouldShowPopup =
            <?= isset($_SESSION['popupShown']) ? json_encode($_SESSION['popupShown']) : 'false' ?>;

        console.log(<?= json_encode($_SESSION); ?>)

        if (shouldShowPopup) {
            openPopup(); // Automatically open the popup on page load
        }

        // Function to open the popup
        function openPopup() {
            petPopup.style.display = "block";
        }

        // Function to close the popup
        function closePopup() {
            petPopup.style.display = "none";
        }

        // Close the popup when clicking the close button
        closeBtn.onclick = closePopup;

        // Close the popup when clicking outside of the popup content
        window.onclick = function(event) {
            if (event.target === petPopup) {
                closePopup();
            }
        };

    });
    // Popup functionality for selecting pet name by petID
    document.getElementById("sessionID").addEventListener("change", function() {
        const sessionID = this.value;
        const petSelect = document.getElementById("petID");
        petSelect.innerHTML = '<option value="">Select Pet</option>'; // Reset pet options

        if (sessionID && petsBySession[sessionID]) {
            petsBySession[sessionID].forEach((pet) => {
                const option = document.createElement("option");
                option.value = pet.petID;
                option.textContent = `#${pet.petID} - ${pet.name}`; // Display pet ID and the name
                option.dataset.name = pet.name;
                petSelect.appendChild(option);
            });
            petSelect.disabled = false; // Enable pet select
        } else {
            petSelect.disabled = true; // Disable if no session selected
        }
    });

    const petIDSelect = document.getElementById("petID");
    const petNameInput = document.getElementById("petName");
    // Close the popup when the OK button is clicked
    document.getElementById("okButton").onclick = function() {
        const petID = petIDSelect.value;
        const sessionID = document.getElementById("sessionID").value;
        // const appointmentID = document.getElementById("appointmentID").value;

        if (petID && sessionID) {
            const data = {
                petID: petID,
                sessionID: sessionID,
            };

            fetch("/VetiPlusMVC/public/doctormedicalhistory/getpetdetails", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify(data),
                })
                .then((response) => response.json())
                .then((result) => {
                    if (result.status === "success") {
                        // Redirect to the index method to show the updated UI without showing the popup
                        window.location.href =
                            "/VetiPlusMVC/public/doctormedicalhistory/getpetMedicalhistory?petID=" +
                            petID +
                            "&sessionID=" +
                            sessionID;
                    } else {
                        alert(result.message);
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        } else {
            alert("Please select a Pet and Session before proceeding.");
        }
    };

    document.addEventListener('DOMContentLoaded', () => {
        const medicalSections = document.querySelectorAll('.medical-section');

        medicalSections.forEach(section => {
            const viewAllBtn = section.querySelector('.view-all-btn');
            const entries = section.querySelectorAll('.medical-entry');
            const totalEntries = entries.length;

            // Initial setup
            viewAllBtn.textContent = `View All (${totalEntries})`;

            // Accessibility improvements
            viewAllBtn.setAttribute('role', 'button');
            viewAllBtn.setAttribute('tabindex', '0');

            // Keyboard accessibility
            viewAllBtn.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    viewAllBtn.click();
                }
            });

            viewAllBtn.addEventListener('click', () => {
                const isCollapsed = section.classList.toggle('medical-section-collapsed');

                // Animate entries
                entries.forEach((entry, index) => {
                    if (index >= 3) {
                        entry.style.transition = 'opacity 0.3s ease';
                        entry.style.opacity = isCollapsed ? '0' : '1';
                    }
                });

                // Update button text
                viewAllBtn.textContent = isCollapsed ?
                    `View All (${totalEntries})` :
                    'Show Less';

                // Accessibility attributes
                section.setAttribute('aria-expanded', !isCollapsed);
                viewAllBtn.setAttribute('aria-label',
                    isCollapsed ? `Expand to see all ${totalEntries} entries` :
                    'Collapse entries'
                );
            });
        });
    });

    const petPopup = document.getElementById("petPopup");
    const closeBtn = document.querySelector(".close-btn");
    // Function to open the popup
    function openPopup() {
        petPopup.style.display = "block";
    }
    </script>
    <script src="<?= ROOT ?>/assets/js/vetDoctor/medicalhistory.js"></script>
</body>

</html>