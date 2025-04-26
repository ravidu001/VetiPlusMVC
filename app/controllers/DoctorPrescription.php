<?php

class DoctorPrescription extends Controller {
    public function index() {
        // Check if the user is logged in
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . ROOT . '/login');
            exit();
        }
        if(!isset($_SESSION['popupShown']) || !isset($_GET['petID'])){
        $_SESSION['popupShown'] = true;
        }
        else{
            $_SESSION['popupShown'] = false;
        }
        $doctorID = $_SESSION['user_id'];
        $sessionModel = new DoctorSessionModel();
        $sessionData = $sessionModel->getsession($doctorID);
        // show($sessionData);
    
        // Initialize an array to hold appointment and pet data
        $appointmentsWithPets = [];
        $petsBySession = []; // New array to hold pets by session
    
        if (is_array($sessionData)) {
            foreach ($sessionData as $sessionItem) {
                if ($sessionItem->completeStatus == 0) {
                    $appointmentModel = new AppointmentModel();
                    $appointmentData = $appointmentModel->getAppointmentBySessionwithEmpty($sessionItem->sessionID);
        
                    foreach ($appointmentData as $appointmentItem) {
                        $petModel = new Pet();
                        $petData = $petModel->findPetDetailsByID($appointmentItem->petID);
        
                        // Store the appointment and pet data in the array
                        $appointmentsWithPets[] = [
                            'session' => $sessionItem,
                            'appointment' => $appointmentItem,
                            'pet' => $petData
                        ];
        
                        // Group pets by session
                        if (!isset($petsBySession[$sessionItem->sessionID])) {
                            $petsBySession[$sessionItem->sessionID] = [];
                        }
                        $petsBySession[$sessionItem->sessionID][] = $petData;
                    }
                }
            }
        }
        // show($appointmentsWithPets);

        $vaccine = new VaccineDataModel();
        $vaccineData = $vaccine->getvaccine(); // all vaccine data
    
        // Pass the combined data to the view
        $this->view('vetDoctor/doctorprescription', [
            'appointmentsWithPets' => $appointmentsWithPets,
            'petsBySession' => $petsBySession,
            'vaccineData' => $vaccineData,
            'selectedPetID' => $_GET['petID'] ?? null, // Pass the selected pet ID if available
            'selectedSessionID' => $_GET['sessionID'] ?? null // Pass the selected session ID if available
        ]);
    }

    public function getpetdetails() {
        // Check if the user is logged in
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . ROOT . '/login');
            exit();
        }
    
        // Get the raw POST data
        $data = json_decode(file_get_contents('php://input'), true);
    
        // Check if data is received
        if ($data) {
            // Extract the values
            $petID = $data['petID'] ?? null;
            $sessionID = $data['sessionID'] ?? null;
            $appointmentID = $data['appointmentID'] ?? null;
    
            $petModel = new Pet();
            $petData = $petModel->findPetDetailsByID($petID);
   
            if ($petData) {
                // Set a session variable to indicate that the popup should not be shown
                $_SESSION['popupShown'] = false;

                // Return the pet data along with a success message
                echo json_encode(['status' => 'success', 'message' => 'Data received successfully', 'petData' => $petData]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Pet not found']);
            }
        } else {
            // Handle the case where no data is received
            echo json_encode(['status' => 'error', 'message' => 'No data received']);
        }
    }

    public function saveData() {
        $sessionID = $_GET['sessionID'];
        $petID = $_GET['petID'];
        $doctorID = $_SESSION['user_id'];

        $appointment = new AppointmentModel();
        $appointmentData = $appointment->getAppointmentBySessionwithEmpty($sessionID);

        if (is_array($appointmentData)) {
            foreach($appointmentData as $appointmentItem) {
                if($appointmentItem->petID == $petID && $appointmentItem->sessionID == $sessionID){
                    $appointmentID = $appointmentItem->appointmentID;
                }
            }
        }
        // echo "<script>console.log('hello ' + " . json_encode($appointmentID) . ");</script>";

        // check POST request
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
            exit;
        }
        // Validate and sanitize input data// Fetch data from the POST request
        $data['weight'] = isset($_POST['weight']) ? trim($_POST['weight']) : null;
        $data['symptoms'] = isset($_POST['symptoms']) ? trim($_POST['symptoms']) : null;
        $data['vaccine'] = isset($_POST['vaccine']) ? trim($_POST['vaccine']) : null;
        $data['surgical'] = isset($_POST['surgical']) ? trim($_POST['surgical']) : null;
        $data['surgicalName'] = isset($_POST['surgicalName']) ? trim($_POST['surgicalName']) : null;
        $data['surgicalDetail'] = isset($_POST['surgicalDetail']) ? trim($_POST['surgicalDetail']) : null;
        $data['allergies'] = isset($_POST['allergies']) ? trim($_POST['allergies']) : null;
        $data['alleryType'] = isset($_POST['alleryType']) ? trim($_POST['alleryType']) : null;
        $data['allergyDescription'] = isset($_POST['allergyDescription']) ? trim($_POST['allergyDescription']) : null;
        $data['prescription'] = isset($_POST['prescription']) ? trim($_POST['prescription']) : null;
        $data['nextvaccine'] = isset($_POST['nextvaccine']) ? trim($_POST['nextvaccine']) : null;
        $data['nextvaccineDate'] = isset($_POST['nextvaccineDate']) ? trim($_POST['nextvaccineDate']) : null;

        $notification = new Notification();
        // Validation
        if (empty($data['weight']) || !is_numeric($data['weight']) || $data['weight'] <= 0) {
            $notification->show('Weight is required and must be a positive number.', 'error');
            exit();
        }

        if (empty($data['symptoms'])) {
            $notification->show('Symptoms are required.', 'error');
            exit();
        }

        // if (empty($data['vaccine'])) {
        //     $notification->show('Vaccination selection is required.', 'error', 'false');
        //     exit();
        // }

        if ($data['surgical'] === 'Yes') {
            if (empty($data['surgicalName'])) {
                $notification->show('Name of the surgery is required if surgical was performed.', 'error');
                exit();
            }
            if (empty($data['surgicalDetail'])) {
                $notification->show('Description of the surgery is required if surgical was performed.', 'error');
                exit();
            }
        }

        if ($data['allergies'] === 'Yes') {
            if (empty($data['alleryType'])) {
                $notification->show('Type of allergen is required if there are allergies.', 'error');
                exit();
            }
            if (empty($data['allergyDescription'])) {
                $notification->show('Description of the allergic reaction is required if there are allergies.', 'error');
                exit();
            }
        }

        if (empty($data['prescription'])) {
            $notification->show('Prescription is required.', 'error');
            exit();
        }

        if (!($data['nextvaccine'] == null || $data['nextvaccine'] == '')) {
            if (empty($data['nextvaccineDate'])) {
                $notification->show('Vaccination date is required.', 'error');
                exit();
            }
        }
    
        $medicalRecord = [
            'symptom' => trim($_POST['symptoms']) ?? null,
            'doctorID' => $doctorID,
            'petID' => $petID,
            'appointmentID' => $appointmentID
        ];

        $medicalData = new MedicalRecordModel();
        $result = $medicalData->insertData($medicalRecord);

        if (!$result) {
            echo "<script>console.log('Medical record added successfully');</script>";
        } else {
            echo "<script>console.log('Error, Medical record not added successfully');</script>";
            exit();
        }

        $conditions = [
            'appointmentID' => $appointmentID,
            'petID' => $petID
        ];

        $recordData = $medicalData->getMedicalID($conditions);
        // show($recordData);

        // Process the result
        if (($recordData)) {
            echo "<script>console.log('RecordID assigned successfully: " . json_encode($recordData[0]->recordID) . "');</script>"; 
            //echo $recordData[0]->recordID;
            $recordID = $recordData[0]->recordID;
        } else {
            echo "<script>console.log('Error, Record ID not assign successfully');</script>";
            // echo $recordData[0]->recordID;
            exit;
        }

        $currentDateTime = date('Y-m-d H:i'); // Format: YYYY-MM-DD HH:MM
        $currentDate = date('Y-m-d');
        if ($data['surgical'] === 'Yes') {
            $surgeryData = [
                'surgeryName' => trim($_POST['surgicalName']) ?? null,
                'description' =>trim($_POST['surgicalDetail']) ?? null,
                'datePerformed' => $currentDateTime,
                'recordID' => $recordID,
            ];

            $surgery = new SurgeryModel();
            $result = $surgery->insertData($surgeryData);

            if (!$result) {
                echo "<script>console.log('Surgery added successfully');</script>";
            } else {
                echo "<script>console.log('Error, Surgery not added successfully');</script>";
                exit();
            }
        }

        if (!($data['vaccine'] == null || $data['vaccine'] == '')) {
            $vaccinetable = new VaccineModel();
            $vacdata = [
                'vaccineID' => trim($_POST['vaccine']) ?? null,
                'petID' => $petID,
            ];
            $vaccineData = $vaccinetable->getVaccineBypetID($vacdata['petID']);
            if (!empty($vaccineData)) {
                $found = false;  // flag to track if update was done
                foreach ($vaccineData as $vaccineItem) {
                    if ($vaccineItem->vaccineID == $vacdata['vaccineID'] && $vaccineItem->status == 0) {
                        $vaccine = [
                            'status' => 1,
                            // 'nextDate' => 
                            'vaccinatedDate' => $currentDate,
                            // 'recordID' => null,
                            'newRecordID' => $recordID,
                            // 'vaccineID' => trim($_POST['vaccine']) ?? null
                        ];

                        $vaccinationID = $vaccineItem->vaccinationID;
                        $result = $vaccinetable->updatevaccine($vaccinationID, $vaccine);

                        if (empty($result)) {
                            echo "<script>console.log('Update vaccination data successfully');</script>";
                        } else {
                            echo "<script>console.log('Update Error');</script>";
                        }
                        $found = true;
                        break;  // no need to loop further
                    }  
                }
                if (!$found) {
                    $vaccine = [
                        'status' => 1,
                        'nextDate' => $currentDate,
                        'vaccinatedDate' => $currentDate,
                        'recordID' => $recordID,
                        'newRecordID' => $recordID,
                        'vaccineID' => trim($_POST['vaccine']) ?? null,
                        'petID' => $vacdata['petID'],
                    ];

                    $result = $vaccinetable->insertData($vaccine);

                    if (!$result) {
                        echo "<script>console.log('Vaccination added successfully');</script>";
                    } else {
                        echo "<script>console.log('Error, Vaccination not added successfully');</script>";
                        exit();
                    }
                }
            } else {
                if (empty($vacdata['petID'])) {
                    echo "<script>console.log('Error: petID is missing');</script>";
                    exit();
                }
                
                $vaccine = [
                    'status' => 1,
                    'nextDate' => $currentDate,
                    'vaccinatedDate' => $currentDate,
                    'recordID' => $recordID,
                    'newRecordID' => $recordID,
                    'vaccineID' => trim($_POST['vaccine']) ?? null,
                    'petID' => $vacdata['petID'],
                ];
                // show($vaccine);

                $result = $vaccinetable->insertData($vaccine);

                if (!$result) {
                    echo "<script>console.log('New vaccination added successfully');</script>";
                } else {
                    echo "<script>console.log('Error, New Vaccination not added successfully');</script>";
                    exit();
                }
            }

        }

        if (!($data['nextvaccine'] == null || $data['nextvaccine'] == '')) {
            if (!empty($data['nextvaccine'])) {
                $vaccinetable = new VaccineModel();
                $nextvaccination = [
                    'status' => 0,
                    'nextDate' => $data['nextvaccineDate'],
                    // 'vaccinatedDate' => $currentDate,
                    'recordID' => $recordID,
                    // 'newRecordID' => null,
                    'vaccineID' => trim($_POST['nextvaccine']) ?? null,
                    'petID' => $petID,
                ];

                show($nextvaccination);

                $result = $vaccinetable->insertData($nextvaccination);

                if (!$result) {
                    echo "<script>console.log('Next vaccination data successfully');</script>";
                } else {
                    echo "<script>console.log('Error, Next Vaccination data not added successfully');</script>";
                    exit();
                }
            }
        }

        
        if ($data['allergies'] === 'Yes') {
            $allergyData = [
                'allergenType' => trim($_POST['alleryType']) ?? null,
                'reactionDescription' => trim($_POST['allergyDescription']) ?? null,
                'dateIdentified' => $currentDateTime,
                'recordID' => $recordID
            ];

            $allergy = new AllergiesModel();
            $result = $allergy->insertData($allergyData);
            
            if (!$result) {
                echo "<script>console.log('Allergy added successfully');</script>";
            } else {
                echo "<script>console.log('Error, Allergy not added successfully');</script>";
                exit();
            }
        }

        $prescription = [
            'prescriptionName' => null,
            'description' => trim($_POST['prescription']) ?? null,
            'recordID' => $recordID
        ];

        $prescriptionModel = new PrescriptionModel();
        $result = $prescriptionModel->insertData($prescription);
        if (!$result) {
            echo "<script>console.log('Prescription added successfully');</script>";
        } else {
            echo "<script>console.log('Error, Prescription not added successfully');</script>";
            exit();
        }

        $petWeightModel = new PetWeightModel();
        $petWeight = [
            'petID' => $petID,
            'appointmentID' => $appointmentID,
            'weight' => $data['weight']
        ];

        $result = $petWeightModel->insertData($petWeight);
        if (!$result) {
            echo "<script>console.log('Pet weight added successfully');</script>";
        } else {
            echo "<script>console.log('Error, Pet weight not added successfully');</script>";
            exit();
        }

        $notification->show('Data saved successfully', 'success');
        
        

    }
}