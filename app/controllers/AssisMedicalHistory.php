<?php

class AssisMedicalHistory extends Controller {
    public function index() {
        if (!isset($_SESSION['assis_id'])) {
            header('Location: ' . ROOT . '/login');
            exit();
        }
        if(!isset($_SESSION['popupShown']) || !isset($_GET['petID'])){
        $_SESSION['popupShown'] = true;
        }
        else{
            $_SESSION['popupShown'] = false;
        }
        $assisID = $_SESSION['assis_id'];
        echo "<script>console.log('ID " . json_encode($assisID) . "');</script>";
        $assissessionModel = new AssistantSessionModel();
        $assissessionData = $assissessionModel->getSessionByAssistant($assisID);

        $sessionModel = new DoctorSessionModel();
        $sessionData = [];

        if(is_array($assissessionData)) {
            foreach ($assissessionData as $assissessionItem) {
                $sessionModel = new DoctorSessionModel();
                if ($assissessionItem->action == 'accept') { 
                    echo "<script>console.log('ID " . json_encode($assissessionItem->sessionID) . "');</script>";
                    $session = $sessionModel->getsessionBySession($assissessionItem->sessionID);
                    if ($session) { 
                        foreach ($session as $s) {
                            $sessionData[] = [
                                'sessionID' => $s->sessionID,
                                'selectedDate' => $s->selectedDate,
                                'startTime' => $s->startTime,
                                'endTime' => $s->endTime,
                                'noOfAppointments' => $s->noOfAppointments,
                                'publishedTime' => $s->publishedTime,
                                'clinicLocation' => $s->clinicLocation,
                                'district' => $s->district,
                                'doctorID' => $s->doctorID,
                                'note' => $s->note,
                                'completeStatus' => $s->completeStatus,
                            ];
                        }
                        
                    }
                }
            }

        }
    
        $appointmentsWithPets = [];
        $petsBySession = []; 
        foreach ($sessionData as $sessionItem) {
            if ($sessionItem['completeStatus'] == 0) {
                $appointmentModel = new AppointmentModel();
                echo "<script>console.log('IDAPP " . json_encode($sessionItem['sessionID']) . "');</script>";
                $appointmentData = $appointmentModel->getAppointmentBySession($sessionItem['sessionID']);
                if ($appointmentData && is_array($appointmentData)) {
                    foreach ($appointmentData as $appointmentItem) {
                        $petModel = new Pet();
                        $petData = $petModel->findPetDetailsByID($appointmentItem->petID);
                
                        $appointmentsWithPets[] = [
                            'session' => $sessionItem,
                            'appointment' => $appointmentItem,
                            'pet' => $petData
                        ];
                
                        if (!isset($petsBySession[$sessionItem['sessionID']])) {
                            $petsBySession[$sessionItem['sessionID']] = [];
                        }
                        $petsBySession[$sessionItem['sessionID']][] = $petData;
                    }
                }
            }
        }
        $this->view('assistant/assismedicalhistory', [
            'appointmentsWithPets' => $appointmentsWithPets,
            'petsBySession' => $petsBySession,
             'selectedPetID' => $_GET['petID'] ?? null, 
             'selectedSessionID' => $_GET['sessionID'] ?? null 
        ]);
    }

    public function getpetdetails() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . ROOT . '/login');
            exit();
        }
    
        $data = json_decode(file_get_contents('php://input'), true);
    
        if ($data) {
            $petID = $data['petID'] ?? null;
            $sessionID = $data['sessionID'] ?? null;
            $appointmentID = $data['appointmentID'] ?? null;
    
            $petModel = new Pet();
            $petData = $petModel->findPetDetailsByID($petID);
   
            if ($petData) {
                $_SESSION['popupShown'] = false;

                echo json_encode(['status' => 'success', 'message' => 'Data received successfully', 'petData' => $petData]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Pet not found']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No data received']);
        }
    }

    public function getpetMedicalhistory(){
        $assisID = $_SESSION['assis_id'];
        echo "<script>console.log('ID " . json_encode($assisID) . "');</script>";
        $assissessionModel = new AssistantSessionModel();
        $assissessionData = $assissessionModel->getSessionByAssistant($assisID);

        $sessionModel = new DoctorSessionModel();
        $sessionData = [];

        
        foreach ($assissessionData as $assissessionItem) {
            $sessionModel = new DoctorSessionModel();
            if ($assissessionItem->action == 'accept') { 
                echo "<script>console.log('ID " . json_encode($assissessionItem->sessionID) . "');</script>";
                $session = $sessionModel->getsessionBySession($assissessionItem->sessionID);
                if ($session) { 
                    foreach ($session as $s) {
                        $sessionData[] = [
                            'sessionID' => $s->sessionID,
                            'selectedDate' => $s->selectedDate,
                            'startTime' => $s->startTime,
                            'endTime' => $s->endTime,
                            'noOfAppointments' => $s->noOfAppointments,
                            'publishedTime' => $s->publishedTime,
                            'clinicLocation' => $s->clinicLocation,
                            'district' => $s->district,
                            'doctorID' => $s->doctorID,
                            'note' => $s->note,
                            'completeStatus' => $s->completeStatus,
                        ];
                    }
                    
                }
            }
        }
    
        $appointmentsWithPets = [];
        $petsBySession = []; 
        foreach ($sessionData as $sessionItem) {
            if ($sessionItem['completeStatus'] == 0) {
                $appointmentModel = new AppointmentModel();
                echo "<script>console.log('IDAPP " . json_encode($sessionItem['sessionID']) . "');</script>";
                $appointmentData = $appointmentModel->getAppointmentBySession($sessionItem['sessionID']);
                if ($appointmentData && is_array($appointmentData)) {
                    foreach ($appointmentData as $appointmentItem) {
                        $petModel = new Pet();
                        $petData = $petModel->findPetDetailsByID($appointmentItem->petID);
                
                        $appointmentsWithPets[] = [
                            'session' => $sessionItem,
                            'appointment' => $appointmentItem,
                            'pet' => $petData
                        ];
                
                        if (!isset($petsBySession[$sessionItem['sessionID']])) {
                            $petsBySession[$sessionItem['sessionID']] = [];
                        }
                        $petsBySession[$sessionItem['sessionID']][] = $petData;
                    }
                }
            }
        }

        if ($_GET['petID'] ?? null && $_GET['sessionID'] ?? null) {
            $selectedPetID = $_GET['petID'];
            $selectedSessionID = $_GET['sessionID'];
        } else {
            $selectedPetID = null;
            $selectedSessionID = null;
        }
        if ($selectedPetID != null && $selectedSessionID != null) {
            $medicalRecordModel = new MedicalRecordModel();
            $medicalrecordData = $medicalRecordModel->getMedicalbypetID($selectedPetID);

            $vaccine = new VaccineModel;
            $vaccineData = $vaccine->getVaccineBypetIDDECS($selectedPetID);
            if (!is_array($vaccineData)) {
                $vaccineData = [];
            }

            $consolidateData = [];

            foreach ($vaccineData as $vaccineItem) {
                $vaccineInfo = new VaccineDataModel();
                $vaccineInfoData = $vaccineInfo->getVaccineByID($vaccineItem->vaccineID);
                $vaccineInfoData = $vaccineInfoData[0];
                $consolidateData[] = [
                    'vaccinationData' => $vaccineItem,
                    'vaccineInfo' => $vaccineInfoData
                ];
            }

            $surgery = new SurgeryModel();
            $surgeryData = $surgery->getSurgeryData();

            $prescription = new PrescriptionModel();
            $prescriptionData = $prescription->getPrescriptionData();

            $allergy = new AllergiesModel();
            $allergyData = $allergy->getAllergyData();

            $weight = new PetWeightModel();
            $weightData = $weight->getPetWeightData($selectedPetID);

            $this->view('assistant/assismedicalhistory', [
                'appointmentsWithPets' => $appointmentsWithPets,
                'petsBySession' => $petsBySession,
                'medicalrecordData' => $medicalrecordData,
                'vaccineData' => $consolidateData,
                'surgeryData' => $surgeryData,
                'prescriptionData' => $prescriptionData,
                'allergyData' => $allergyData,
                'weightData' => $weightData,
                'selectedPetID' => $selectedPetID,
                'selectedSessionID' => $selectedSessionID
            ]);
        }

    }
}